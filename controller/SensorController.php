<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 15/05/2017
 * Time: 09:13
 */
class SensorController extends AccountManagingController
{

    const NUMBER_OF_VALUES_TO_ADD = 2500;
    const DEFAULT_GAP_DIVIDER = 50;
    const BASE_DATETIME = '05/01/2017 00:00:00';
    const BASE_PERIOD = '10 minutes';

    public function addRandomValuesToSensors(){

        $this -> enableApiMode();

        /** @var SensorRepository $sensorRepository */
        $sensorRepository = $GLOBALS['repositories']['sensor'];

        $sensors =  $sensorRepository -> getAll();

        /** @var Sensor $sns */
        foreach ($sensors as $sns){

            $i = 0;



            if($sns -> getSensorType() -> getChart()) {

                $minVal = $sns -> getSensorType() -> getMinVal() ;

                $maxVal = $sns -> getSensorType() -> getMaxVal();

                $fullGap = $maxVal - $minVal;

                $gap = $fullGap / self::DEFAULT_GAP_DIVIDER;

                $actualValue = $fullGap * 0.5;
                $actualDateTimeManipulated = new DateTime(self::BASE_DATETIME);



                for ($i = 0; $i < self::NUMBER_OF_VALUES_TO_ADD; $i++) {
                    $sensorVal = new SensorValue();

                    $sensorVal
                        -> setValue($actualValue)
                        -> setDatetime($actualDateTimeManipulated);

                    $sns -> addSensorValue($sensorVal);

                    if(!$sensorVal -> save($this -> db)){
                        Utils::addWarning('Whoops those datas couldn\'t be saved in the database...');
                    }

                    $actualValue += $gap * ( rand(0, 2) - 1);
                    if($actualValue > $maxVal){
                        $actualValue = $maxVal;
                    }

                    else if($actualValue < $minVal){
                        $actualValue = $minVal;
                    }


                    $actualDateTimeManipulated = date_add
                    (
                        $actualDateTimeManipulated,
                        date_interval_create_from_date_string(self::BASE_PERIOD)
                    );

                }

            }


            else{

                $actualValue = false;
                $actualDateTimeManipulated = new DateTime(self::BASE_DATETIME);


                for ($i = 0; $i < self::NUMBER_OF_VALUES_TO_ADD; $i++) {
                    $sensorVal = new SensorValue();

                    $sensorVal
                        ->setState($actualValue)
                        ->setDatetime($actualDateTimeManipulated);

                    $sns->addSensorValue($sensorVal);

                    if(!$sensorVal -> save($this -> db)){
                        Utils::addWarning('Whoops those datas couldn\'t be saved in the database...');
                    }


                    $rnd = rand(0,25);
                    if($rnd == 0){
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

}