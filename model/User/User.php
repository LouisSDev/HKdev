<?php


class User extends DatabaseEntity
{


    /**
     * @var string $firstName
     */
    private $firstName;

    /**
     * @var string $lastName
     */
    private $lastName;

    /**
     * @var string $mail
     */
    private $mail;

    /**
     * @var  $cellPhoneNumber
     */
    private $cellPhoneNumber;

    /**
     * @var string $address
     */
    private $address;

    /**
     * @var string $city
     */
    private $city;

    /**
     * @var string $country
     */
    private $country;

    /**
     * @var string $password
     */
    private $password;

    /**
     * @var bool $admin
     */
    private $admin = false;

    /**
     * @var bool $quoteTreated
     */
    private $quoteTreated = false;

    /**
     * @var bool $validated
     */
    private $validated = false;

    /**
     * @var string $quoteFilePath
     */
    private $quoteFilePath;

    /**
     * @var array
     */
    private $homes = array();






    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        if(strlen($firstName)<=50){
            $this->firstName = $firstName;
        }
        else{
            Utils::addWarning("This firstname is too long");
            $this->error = true;
            $this->errorMessage []=  "This firstname is too long";
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {

        if(strlen($lastName)<=60){
            $this->lastName = $lastName;
        }
        else{
            Utils::addWarning("This lastName is too long");
            $this->error = true;
            $this->errorMessage [] = "This lastName is too long";
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     * @return User
     */
    public function setMail($mail)
    {
        if(preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#' ,$mail)){
            $this->mail = $mail;
        }
        else{
            Utils::addWarning("The Mail address is incorrect");
            $this->error = true;
            $this->errorMessage []= "The Mail address is incorrect";
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getCellPhoneNumber()
    {
        return $this->cellPhoneNumber;
    }

    /**
     * @param string $cellPhoneNumber
     * @return User
     */
    public function setCellPhoneNumber($cellPhoneNumber)
    {
        if(strlen($cellPhoneNumber)<=20){
            $this->cellPhoneNumber = $cellPhoneNumber;
        }
        else{
            Utils::addWarning("This cellPhoneNumber is incorrect");
            $this->error = true;
            $this->errorMessage []=  "This cellPhoneNumber is incorrect";
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return User
     */
    public function setAddress($address)
    {
        if(strlen($address)<=100){
            $this->address = $address;
        }
        else{
            Utils::addWarning("This address is too long");
            $this->error = true;
            $this->errorMessage[]= "This address is too long";
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return User
     */
    public function setCity($city)
    {
        if(strlen($city)<=40){
            $this->city = $city;
        }
        else{
            Utils::addWarning("This City name is too long");
            $this->error = true;
            $this->errorMessage[]=  "This City name is too long";
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param bool $admin
     * @return User
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
        return $this;
    }


    public function setPassword($password){
        $this -> password = $password;
    }


    public function setNewPassword($password, $passwordNew, $passwordConf, $encrypt = true)
    {
        // We first encrypt the passwords with our config salt for security purposes if needed (if $encrypt == true)
        if($encrypt){
            $password = sha1($password.$GLOBALS['salt']);
            $passwordNew = sha1($passwordNew.$GLOBALS['salt']);
            $passwordConf = sha1($passwordConf.$GLOBALS['salt']);
        }

        if($this->password == null){
            if($password == $passwordConf){
                $this->password = $password;
            }else{
                Utils::addWarning("The two passwords are not identical");
                $this->error = true;
                $this->errorMessage[]= "The two passwords are not identical";
            }
        }else{
            if($password == $this->password){
                if($passwordNew == $passwordConf){
                    $this->password = $passwordNew;
                }else{
                    Utils::addWarning("The two passwords are not identical");
                    $this->error = true;
                    $this->errorMessage[]= "The two passwords are not identical";
                }
            }else{
                Utils::addWarning("Your old password is not correctly entered");
                $this->error = true;
                $this->errorMessage[]= "Your old password is not correctly entered";
            }
        }

        return $this;
    }


    /**
     * @param string $country
     * @return User
     */
    public function setCountry($country)
    {
        if(strlen($country)<=30){
            $this->country = $country;
        }
        else{
            Utils::addWarning("This Country name is too long");
            $this->error = true;
            $this->errorMessage[]= "This Country name is too long";
        }

        return $this;
    }



    /**
     * @return array
     */
    public function getHomes()
    {
        if(!$this -> homes) {
        /** @var Repository $repo */
        $repo = $GLOBALS['repositories']['home'];
        $this->homes = $repo->getObjectsFromId($this, $this->getClassName(), 'home');
        }
        return $this->homes;
    }

    /**
     * @param array $homes
     * @return User
     */
    public function setHomes($homes)
    {
        $this -> homes = $homes;
        return $this;
    }



    /**
     * Add home
     *
     * @param Home
     * @return User
     */

    public function addHome(Home $home){
        if(!in_array($home, $this->getHomes())){
            array_push( $this->homes, $home);
            $home->setUser($this);
        }
        return $this;
    }

    /**
     * Remove home
     *
     * @param Home
     * @return User
     */

    public function removeHome(Home $home){
        if(!in_array($home, $this->getHomes())) {
            unset($this->homes[array_search($home,$this->homes)]);
            $home->setUser(null);
        }
        return $this;
    }

    /**
     * @return boolean
     */
    public function getValidated()
    {
        return $this->validated;
    }

    /**
     * @param boolean $validated
     * @return User
     */
    public function setValidated($validated)
    {
        $this->validated = $validated;
        return $this;
    }

    /**
     * @return string
     */
    public function getQuoteFilePath()
    {
        return $this->quoteFilePath;
    }

    /**
     * @param string $quoteFilePath
     * @return User
     */
    public function setQuoteFilePath($quoteFilePath)
    {
        $this->quoteFilePath = $quoteFilePath;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getQuoteTreated()
    {
        return $this->quoteTreated;
    }

    /**
     * @param boolean $quoteTreated
     * @return User
     */
    public function setQuoteTreated($quoteTreated)
    {
        $this->quoteTreated = $quoteTreated;
        return $this;
    }



    public function getValid(){
        if($this->error){
            return false;
        }

        if($this->firstName != null
            && $this->lastName != null
            && $this ->mail != null
            && $this->cellPhoneNumber != null
            && $this-> address != null
            && $this->country != null
            && $this->city != null
        ){
            return true;
        }
        $this->errorMessage[] = "Vous n'avez pas rentré toutes les informations nécessaires.";
        return false;
    }


    public function getClassName(){
        return self::class;
    }


    public function getObjectVars(){
        return get_object_vars($this);
    }


    public function getAllSensors(){
        $sensors = array();
        foreach ($this -> getHomes() as $home){
            $sensors = array_merge($sensors, $home -> getAllSensors());
        }
        return $sensors;
    }


    /**
     * @param $type string
     * @return array
     */
    public function getAllSensorsPerType($type){

        $sensors = [];

        /** @var Sensor $sensor*/
        foreach ($this -> getAllSensors() as $sensor){
            if($sensor -> getSensorType() -> getType() === $type){
                $sensors[] = $sensor;
            }
        }
        return $sensors;
    }

    public function getAllRooms()
    {
        $rooms = array();

        /** @var Home $hm */
        foreach($this ->  getHomes() as $hm){
            $rooms = DatabaseEntity::mergeArraysWithoutDuplicata($rooms, $hm -> getRooms());
        }
        return $rooms;
    }




}