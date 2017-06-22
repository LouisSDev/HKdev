<?php


class SensorController extends AccountManagingController
{

    const NUMBER_OF_VALUES_TO_ADD = 5000;
    const DEFAULT_GAP_DIVIDER = 50;
    const BASE_DATETIME = '05/01/2017 00:00:00';
    const BASE_PERIOD = '30 minutes';
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
            if($sns -> getId() > 9){
                break;
            }

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

                            $numberOfValues = count($sensorValuesFetched);
                            $gapNumber = $numberOfValues / self::NUMBER_OF_VALUES_IN_A_GRAPH;

                            /** @var SensorValue $value */
                            foreach ($sensorValuesFetched as $value) {
                                // We don't select all the dates but only 30 max, therefore we check if
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

                                /*else if($k > $j * $gapNumber){
                                    $j++;

                                    $fakeValue = new SensorValue();
                                    $fakeValue -> setDatetime($lastDateChoosen)
                                        -> setValue(0)
                                        -> setSensor($sensor)
                                        -> setState(false);

                                    $sensorsValuesPerTypes[$type][$i][] = $fakeValue;

                                    // If it does, we increment $j and the set new last date choosen
                                    $lastDateChoosen = new DateTime(date(DatabaseEntity::MYSQL_TIMESTAMP_FORMAT));
                                    $lastDateChoosen = $lastDateChoosen
                                        ->setTimestamp
                                        (
                                            $fromDate->getTimestamp()
                                            + $periodBetweenTwoDates * $j
                                        );
                                } */

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

    public function getFrames(){
        $ch = curl_init();

        curl_setopt(
            $ch,
            CURLOPT_URL,
            "http://projets-tomcat.isep.fr:8080/appService?ACTION=GETLOG&TEAM=" . AccountManagingController::FRAME_GROUP_NAME
        );

        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($ch);
        curl_close($ch);


        $dataTab = str_split($data,33);


        $lastOpenedFile = fopen('bin/framesUpdate.txt', 'rb+');
        $lastUpdate = fgets($lastOpenedFile);


        $lastUpdate = new DateTime($lastUpdate);
        $latestDate = new DateTime($lastUpdate -> format('m/d/Y H:i:s'));

        for($i=0, $size=count($dataTab); $i<$size -1; $i++){


            $frame = $dataTab[$i];


            list($type, $o, $r, $c, $sensorId, $value, $a, $x,
                $year, $month, $day, $hour, $min, $sec) =
                sscanf($frame,"%1s%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");


            $dateToString = $year . '-' . $month . '-' . $day . ' ' . $hour . ':' . $min . ':' . $sec;
            $date = new DateTime($dateToString);
            $value = hexdec($value);

            if($type == 1 && $r == 1 && $lastUpdate < $date) {

                if($date > $latestDate){
                    $latestDate = $date;
                }

                //Utils::addWarning('Sensor n°' . intval($sensorId) . ' has a new value of ' . $value . ' on date ' . $dateToString);

                $sensor = $this -> getSensorRepository() -> findById(intval($sensorId));

                $sensorValue = new SensorValue();
                $sensorValue -> setDatetime($date)
                    -> setSensor($sensor)
                    -> setValue($value);

                $sensorValue -> save($this -> db);

            }
        }

        fseek($lastOpenedFile, 0);

        fwrite($lastOpenedFile, $latestDate->format('m/d/Y H:i:s'));

        fclose($lastOpenedFile);
    }

}