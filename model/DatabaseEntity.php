<?php

/**
 * Created by PhpStorm.
 * User: LOUISSTEIMBERG
 * Date: 31/03/2017
 * Time: 13:47
 */
abstract class DatabaseEntity
{

    /**
     * @var integer $id
     */
    protected $id = -1;

    /**
     * @var $error boolean
     */
    protected $error = false;

    /**
     * @var $errorMessage string
     */
    protected $errorMessage;


    /**
     * @param $data array
     * @return DatabaseEntity
     */
    public function createFromResults($data)
    {
        // First of all, we get all the parameters listed in this object
        // Note that if you are in an object whose class extends this one, the parameters will be the parameters
        // of this extended class.
        // For example, in a User object, the parameters will be :  homes, buildings, address, firstName, mail...
        $parameters = $this -> getObjectVars();

        // For each of our raw parameters, we get, $name the name of the parameter and $value its value
        foreach($parameters as $name => $value){

            // If it's a DatabaseEntity, we shall not create an entity from result because it will create an infinite loop
            // Image creating a home from result, you would then create the building from result, and therefore
            // the building would create the same home from result which will in turn create the same building from results
            // And this is an infinite loop...
            if(!($value instanceof DatabaseEntity)){

                // If it's an array
                if(is_array($value)){

                    // Then the repository name is the name of the param but without the 's' that's why we remove it here
                    $repositoryName = substr($name, 0, strlen($name) - 1);

                    // Now we get the repository
                    /** @var Repository  $repository */
                    $repository = $GLOBALS['repositories'][$repositoryName];

                    // And call the general Repository method below mentionned
                    // It will in turn call the method getObjectsFromUserId of the given repository if it's from the
                    // User id that we search those objects
                    // We then put all of this in the corresponding array and we're done
                    $this -> $name = $repository -> getObjectsFromId($this->id, $this -> getClassName() , $repositoryName);

                }
                else if($name != "error" && $name != "errorMessage"){
                    // If the param is a simple param and not neither the error or errorMessage param
                    // We put the data array value inside this param and we're done
                    $this->$name = $data[$name];
                }
            }
        }
        return $this;
    }


    /**
     * @param $db PDO
     * @return DatabaseEntity
     */
    public function save($db)
    {



        // First of all, we get all the parameters listed in this object
        // Note that if you are in an object whose class extends this one, the parameters will be the parameters
        // of this extended class.
        // For example, in a User object, the parameters will be :  homes, buildings, address, firstName, mail...
        $rawParameters = $this -> getObjectVars();

        // This array will stock the sorted out parameters that will be saved in the database:
        // For example, in the class user, the array homes won't appear in this array
        // because we do not store the links from user to homes into the user object of the database
        // but into the home object of the database.
        $parameters = array();

        // This one will contain all the parameters that are array,
        // homes and buildings in User class for example
        $cascadingParameters = array();




        // For each of our raw parameters, we get, $name the name of the parameter and $value its value
        foreach($rawParameters as $name => $value){


            // If it's not a DatabaseEntity (such as Room object, Building Object, User Object for example)
            if(!($value instanceof DatabaseEntity)){

                // Then it might be an array
                if(is_array($value)){

                    // In this case, we store its value into the array cascadingParameters defined above
                    // In user, $cascadingParameters['homes'] will contain the homes of the user for example
                    $cascadingParameters[$name] = $value;

                }
                // Now, if the var is neither "error", nor "errorMessage" (because we don't save this into the database)
                else if($name != "error" && $name != "errorMessage"){


                    // If it's a string value, then $type will be set to PDO::PARAM_STR, else into PDO::PARAM_INT
                    // This will help us binding the param later on
                    if(is_string($value)){
                        $type = PDO::PARAM_STR;
                    }else{
                        $type = PDO::PARAM_INT;
                    }

                    // Now we create the parameters into the array, for example the parameter
                    // $parameters['firstName'] into the User Class
                    $parameters[$name] = array(
                        // We set it's value and type
                        "value" => $value,
                        "type" => $type,
                    );
                }
            }else{
                $addParameter = true;
                if(($value -> getClassName() ==  $this -> getClassName())  ) {
                    $IdGetterName = 'getBuilding';
                    if($value -> $IdGetterName() -> getId() == -1){
                        $addParameter = false;
                    }
                }
                if($addParameter) {
                    // Otherwise, if it's an object, we need to link it's id in the database so we already know the type
                    // And the value is not directly $value but $value -> getId() : the id of this entity
                    $parameters[$name] = array(
                        "value" => $value->getId(),
                        "type" => PDO::PARAM_INT,
                        "object" => $value
                    );
                }
            }
        }

        // If the entity parameters are set properly
        if ($this->getValid()) {


            // If id == -1 , it means, the object wasn't created yet
            if ($this->id == -1) {


                // We create the request string which will be and INSERT INTO + database name which is the entity class name in lowercase
                $request = "INSERT INTO " . strtolower($this -> getClassName()) . " (";
                //End of the request is created as well because both needs to cross the parameters array so we shall do this all at once
                $endRequest = ' VALUES (';

                // For each of the sorted out parameters
                foreach($parameters as $name => $value){
                    // If this is not the id
                    if($name != 'id' ) {

                        // Then we add 'firstName, ' for example to the SET ( *** params here***) part of the request
                        $request .= $name . ', ';
                        // Then we add ':firstName, ' for example to the VALUES ( *** params here***) part of the request
                        $endRequest .= ":" . $name . ", ";


                    }
                }

                // We delete the last ' ,'
                $request = substr($request, 0, strlen($request) - 2);
                // We delete the last ' ,'
                $endRequest = substr($endRequest, 0, strlen($endRequest) - 2);
                // We put all together
                $request .= ')' . $endRequest . ") ";


                // And sends the request
                $newEntity = $db -> prepare($request);

                // Now, for each param we need to bind its value
                foreach($parameters as $name => $value){

                    $getterName = 'get' . strtoupper($name[0]) .  substr($name, 1, strlen($name) -1);
                    $val =  $this->$getterName();

                    $GLOBALS['val'] = $val;


                    if($GLOBALS['val'] instanceof  DatabaseEntity){
                        $GLOBALS['val'] = $value['value'];
                    }


                    if($name !==  'id') {
                        // If it's a string type field
                        if ($value['type'] == PDO::PARAM_STR) {

                            // We will bind it with the right infos
                            $newEntity->bindParam(':' . $name, $GLOBALS['val'] , PDO::PARAM_STR, strlen($GLOBALS['val']));
                        } else {
                            // Or bind it differently if it's an integer
                            $newEntity->bindParam(':' . $name, $GLOBALS['val'], $value['type']);
                        }

                        unset($GLOBALS['val']);
                    }
                }



                // Finally, we execute the request and close the cursor
                $newEntity->execute();
                $newEntity->closeCursor();

                // And set this object id to the last mysql inserted Id
                $this->id = $db->lastInsertId();

            }else{


                // This is the same as above expect the request string is not the same and we also have
                // To bind the id for the WHERE part of the request
                // Also, no need here to do $this->id = $db->lastInsertId();
                $request = "UPDATE " . strtolower($this -> getClassName())  . " SET ";

                foreach($parameters as $name => $value){
                    if($name != 'id') {
                        $request .= $name . ' = :' . $name . ", ";
                    }
                }

                // We delete the last ' ,'
                $request = substr($request, 0, strlen($request) - 2);

                $request .= " WHERE id = :id";

                $updateEntity = $db -> prepare($request);

                foreach($parameters as $name => $value){

                    $getterName = 'get' . strtoupper($name[0]) .  substr($name, 1, strlen($name) -1);
                    $val =  $this->$getterName();


                    $GLOBALS['val'] = $val;


                    if($GLOBALS['val'] instanceof  DatabaseEntity){
                        $GLOBALS['val'] = $value['value'];
                    }
/*
                    if($GLOBALS['val'] instanceof Home){
                        throw new Exception($GLOBALS['val'] -> getName() . $name);
                    } */


                    if($value['type'] == PDO::PARAM_STR){
                        $updateEntity->bindParam(':' . $name, $GLOBALS['val'], PDO::PARAM_STR, strlen($GLOBALS['val']));
                    }else{
                        $updateEntity->bindParam(':' . $name, $GLOBALS['val'], $value['type']);
                    }
                    unset($GLOBALS['val']);
                }

                $updateEntity->execute();
                $updateEntity->closeCursor();

            }
            // Now, for each array in the params of this object
            foreach($cascadingParameters as $name => $value){
                // For each of the object in this array
                foreach($value as $object){
                    // We save it as well!
                    if($object -> save($db) == null){
                        return null;
                    }
                }
            }

            // We return this object
            return $this;

        }else{
            // If it failed, it will return null
            return null;
        }
    }

    /**
     * @return DatabaseEntity
     */
    public function delete($db)
    {
        $request = $db->prepare('DELETE FROM ' . strtolower($this -> getClassName()) . ' WHERE id = :id');
        $request ->bindParam(':id', $this->id, PDO::PARAM_INT);
        $request->execute();
        $request->closeCursor();
        return $this;
    }

    public function getValid(){
        return true;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return DatabaseEntity
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isError()
    {
        return $this->error;
    }

    /**
     * @param boolean $error
     */
    public function setError(bool $error)
    {
        $this->error = $error;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @param string $errorMessage
     */
    public function setErrorMessage(string $errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    public function getClassName(){
        return self::class;
    }

    public function getObjectVars(){
        return get_object_vars($this);
    }


}
