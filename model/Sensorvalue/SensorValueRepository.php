<?php

/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 18/04/2017
 * Time: 10:26
 */
class SensorValueRepository extends Repository
{
    const OBJECT_CLASS_NAME = 'SensorValue';



    public function getObjectClassName()
    {
        return self::OBJECT_CLASS_NAME;
    }

    public function searchValues(DateTime $fromDate, DateTime $toDate, Sensor $sensor)
    {
        $getValues = $this -> db -> prepare(
            'SELECT * FROM ' . self::OBJECT_CLASS_NAME
            . ' WHERE datetime BETWEEN :fromDate AND :toDate AND sensor = :sensorId '
        );

        $fromDate = $fromDate -> format(DatabaseEntity::MYSQL_TIMESTAMP_FORMAT);
        $toDate = $toDate -> format(DatabaseEntity::MYSQL_TIMESTAMP_FORMAT);
        $sensorId = $sensor -> getId();

        $getValues -> bindParam(':fromDate' , $fromDate, PDO::PARAM_STR, strlen($fromDate));
        $getValues -> bindParam(':toDate' , $toDate, PDO::PARAM_STR, strlen($toDate));
        $getValues -> bindParam(':sensorId' , $sensorId, PDO::PARAM_INT);

        $getValues -> execute();


        return $this->getResultantObjects( $getValues);

    }

    public function deleteValuesFromSensors($id)
    {
        $request = $db->prepare('DELETE FROM ' . self::OBJECT_CLASS_NAME . ' WHERE sensor = :id');
        $request ->bindParam(':id', $this->$id, PDO::PARAM_INT);
        $request->execute();
        $request->closeCursor();
        return $this;
    }
}