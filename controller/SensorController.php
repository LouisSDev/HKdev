<?php


class SensorController extends AccountManagingController
{

    const NUMBER_OF_VALUES_TO_ADD = 2500;
    const DEFAULT_GAP_DIVIDER = 50;
    const BASE_DATETIME = '05/01/2017 00:00:00';
    const BASE_PERIOD = '10 minutes';
    const NUMBER_OF_VALUES_IN_A_GRAPH = 30;

    public function addRandomValuesToSensors(){


        // To avoid bugs due to standard timeout
        set_time_limit(0);


        $this -> enableApiMode();

        /** @var SensorRepository $sensorRepository */
        $sensorRepository = $GLOBALS['repositories']['sensor'];

        $sensors =  $sensorRepository -> getAll();

        /** @var Sensor $sns */
        foreach ($sensors as $sns) {

            $i = 0;



            if ($sns->getSensorType()->getChart()) {

                $minVal = $sns->getSensorType()->getMinVal();

                $maxVal = $sns->getSensorType()->getMaxVal();

                $fullGap = $maxVal - $minVal;

                $gap = $fullGap / self::DEFAULT_GAP_DIVIDER;

                $actualValue = $fullGap * 0.5;
                $actualDateTimeManipulated = new DateTime(self::BASE_DATETIME);


                for ($i = 0; $i < self::NUMBER_OF_VALUES_TO_ADD; $i++) {
                    $sensorVal = new SensorValue();

                    $sensorVal
                        ->setValue($actualValue)
                        ->setDatetime($actualDateTimeManipulated);

                    $sns->addSensorValue($sensorVal);

                    if (!$sensorVal->save($this->db)) {
                        Utils::addWarning('Whoops those datas couldn\'t be saved in the database...');
                    }

                    $actualValue += $gap * (rand(0, 2) - 1);
                    if ($actualValue > $maxVal) {
                        $actualValue = $maxVal;
                    } else if ($actualValue < $minVal) {
                        $actualValue = $minVal;
                    }


                    $actualDateTimeManipulated = date_add
                    (
                        $actualDateTimeManipulated,
                        date_interval_create_from_date_string(self::BASE_PERIOD)
                    );

                }

            }

            else {

                $actualValue = false;
                $actualDateTimeManipulated = new DateTime(self::BASE_DATETIME);


                for ($i = 0; $i < self::NUMBER_OF_VALUES_TO_ADD; $i++) {
                    $sensorVal = new SensorValue();

                    $sensorVal
                        ->setState($actualValue)
                        ->setDatetime($actualDateTimeManipulated);

                    $sns->addSensorValue($sensorVal);

                    if (!$sensorVal->save($this->db)) {
                        Utils::addWarning('Whoops those datas couldn\'t be saved in the database...');
                    }


                    $rnd = rand(0, 25);
                    if ($rnd === 2) {
                        $actualValue = !$actualValue;
                        Utils::addWarning($rnd . '  value  of the boolean : ' . $actualValue);
                    }

                    $actualDateTimeManipulated = date_add
                    (
                        $actualDateTimeManipulated,
                        date_interval_create_from_date_string(self::BASE_PERIOD)
                    );
                }
            }


        }

        ApiHandler::returnValidResponse(array('message' => 'Values added'));
    }

    public function getSensorValues()
    {
        $this -> enableApiMode();
        $errorMessage = "";

        /// We check if all the datas were correctly submitted
        if(!empty($_POST['fromDate']) && !empty($_POST['toDate'])
        ) {
            $sensorsPerType = [];

            // Then also check if dates are valid
            if (Utils::isDate($_POST['fromDate']) && Utils::isDate($_POST['toDate'])) {

                $fromDate = DateTime::createFromFormat('Y-m-d H:i:s', $_POST['fromDate']);
                $toDate = DateTime::createFromFormat('Y-m-d H:i:s', $_POST['toDate']);

                if ($fromDate < $toDate) {


                    // Now we get all the sensors required either from the room or home id
                    if (!empty($_POST['roomId'])) {
                        $room = $this->findRoomFromIdInUsersRooms($_POST['roomId']);
                        foreach (SensorType::TYPE_ARRAY as $type) {
                            $sensorsPerType[$type] = $room->getSensorsPerType($type);
                        }
                    }

                    else if (!empty($_POST['homeId'])) {
                        $home = $this->findHomeFromId($_POST['homeId']);
                        foreach (SensorType::TYPE_ARRAY as $type) {
                            $sensorsPerType[$type] = $home->getSensorsPerType($type);
                        }
                    }

                    else{

                        foreach (SensorType::TYPE_ARRAY as $type) {
                            $sensorsPerType[$type] = $this -> user -> getAllSensorsPerType($type);
                        }



                    }

                    // We then search for all SensorValue objects from each sensor concerned
                    // And put it into this array
                    $sensorsValuesPerTypes = [];

                    foreach ($sensorsPerType as $type => $sensors) {


                        // It will be stored by sensor type and then each sensor
                        // will store its values in an array
                        $i = 0;
                        /** @var Sensor $sensor */
                        foreach ($sensors as $sensor) {


                            /** @var SensorValueRepository $sensorValuesRepository */
                            $sensorValuesRepository = $GLOBALS['repositories']['sensorValue'];

                            $lastDateChoosen = null;
                            $periodBetweenTwoDates = ($toDate->getTimestamp() - $fromDate->getTimestamp())
                                / self::NUMBER_OF_VALUES_IN_A_GRAPH;

                            $j = 0;
                            $k = 0;


                            // For each of the SensorValue objects resulting of this research in the db
                            $sensorValuesFetched = $sensorValuesRepository->searchValues($fromDate, $toDate, $sensor);

                            if (count($sensorValuesFetched) > 0) {

                                $sensorsValuesPerTypes[$type][$i] = [];
                            }
                            /** @var SensorValue $value */
                            foreach ($sensorValuesFetched as $value) {
                                // We don't select all the dates but only 50 max, therefore we check if
                                // the date of this value is after the next date to set the date to
                                // And if all the values necessary are already in the array
                                if ((!$lastDateChoosen || $lastDateChoosen < $value->getDatetime()
                                        || ($i == count($sensorValuesFetched) - 1))
                                    && count($sensorsValuesPerTypes[$type][$i]) < self::NUMBER_OF_VALUES_IN_A_GRAPH
                                ) {

                                    $j++;

                                    $sensorsValuesPerTypes[$type][$i][] = $value;

                                    // If it does, we increment $j and the set new last date choosen
                                    $lastDateChoosen = new DateTime(date(DatabaseEntity::MYSQL_TIMESTAMP_FORMAT));
                                    $lastDateChoosen = $lastDateChoosen
                                        ->setTimestamp
                                        (
                                            $fromDate->getTimestamp()
                                            + $periodBetweenTwoDates * $j
                                        );
                                }

                                $k++;
                            }

                            $i++;
                        }
                    }


                    // Now we'll need to sort them by computing all their
                    // data together and making a "moyenne" of those values
                    $sortedSensorsValuesPerTypes = [];

                    foreach ($sensorsValuesPerTypes as $type => $sensorsValuesPerSensor) {


                        /** @var SensorTypeRepository $sensorTypeRepository */
                        $sensorTypeRepository = $GLOBALS['repositories']['sensorType'];

                        /** @var SensorType $sensorType */
                        $sensorType = $sensorTypeRepository->getSensorTypePerType($type);

                        $type = str_replace(' ', '_', $type);
                        $type = str_replace('\'', '_', $type);

                        if($sensorType -> getChart()){
                            $sortedSensorsValuesPerTypes[$type] = [
                                'mode' => 'chart',
                                'minVal' => $sensorType -> getMinVal(),
                                'maxVal' => $sensorType -> getMaxVal()
                            ];
                        }else{
                            $sortedSensorsValuesPerTypes[$type] = [
                                'mode' => 'state'
                            ];
                        }

                        for ($i = 0; $i < self::NUMBER_OF_VALUES_IN_A_GRAPH; $i++) {

                            $sortedSensorValues = [];

                            foreach ($sensorsValuesPerSensor as $sensorValues) {
                                $sortedSensorValues[] = $sensorValues[$i];
                            }

                            if (count($sortedSensorValues) > 0) {
                                /** @var SensorValue $baseValue */
                                $baseValue = $sortedSensorValues[0];
                                $sortedSensorsValuesPerTypes[$type]['values'][] = $baseValue->getDataArray($sortedSensorValues);
                            }
                        }
                    }

                    ApiHandler::returnValidResponse($sortedSensorsValuesPerTypes);

                } else {
                    $errorMessage = 'La date de depart ne peut etre apres la date de fin';
                }
            } else {
                $errorMessage = 'Ces dates ne sont pas dans un format valide';
            }
        }
        else{
            $errorMessage = 'Toutes les donnees requises n\'ont pas etes soumises';
        }

        ApiHandler::throwError(400, $errorMessage);
    }

}