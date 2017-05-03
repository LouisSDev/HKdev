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
            $this->error = true;
            $this->errorMessage .= '<br/> This firstname is too long ';
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
            $this->error = true;
            $this->errorMessage .= '<br/> This lastName is too long ';
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
            $this->error = true;
            $this->errorMessage .= "<br>The Mail address is incorrect";
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
            $this->error = true;
            $this->errorMessage .= '<br/> This cellPhoneNumber is incorrect ';
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
                $this->error = true;
                $this->errorMessage[]= "The two passwords are not identical";
            }
        }else{
            if($password == $this->password){
                if($passwordNew == $passwordConf){
                    $this->password = $passwordNew;
                }else{
                    $this->error = true;
                    $this->errorMessage[]= "The two passwords are not identical";
                }
            }else{
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
        if(!in_array($home, $this->homes)){
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
        if(!in_array($home, $this->homes)) {
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




    public function getValid(){
        if($this->error){
            return false;
        }else{
            if($this->firstName != null
                && $this->lastName != null
                && $this ->mail != null
                && $this->cellPhoneNumber != null
                && $this-> address != null
                && $this->country != null
                && $this->password != null
                && $this->city != null
            ){
                return true;
            }else{
                $this->errorMessage[]= "Vous n'avez pas rentré toutes les informations nécessaires.";
                return false;
            }
        }
    }

    public function getClassName(){
        return self::class;
    }


    public function getObjectVars(){
        return get_object_vars($this);
    }

/*
    public function save($db)
    {
        if ($this->getValid()) {
            if ($this->id == -1) {
                $newUser = $db->prepare('INSERT INTO 
                    user(firstName, lastName, mail, cellPhoneNumber, address, country, admin, password, city) 
					VALUES(:firstName, :lastName, :mail, :cellPhoneNumber, :address, :country, :admin, :password, :city)');

                $newUser->bindParam(':firstName', $this->firstName, PDO::PARAM_STR, strlen($this->firstName));
                $newUser->bindParam(':lastName', $this->lastName, PDO::PARAM_STR, strlen($this->lastName));
                $newUser->bindParam(':mail', $this->mail, PDO::PARAM_STR, strlen($this->mail));
                $newUser->bindParam(':cellPhoneNumber', $this->cellPhoneNumber, PDO::PARAM_STR, strlen($this->cellPhoneNumber));
                $newUser->bindParam(':address', $this->address, PDO::PARAM_STR, strlen($this->address));
                $newUser->bindParam(':country', $this->country, PDO::PARAM_STR, strlen($this->country));
                $newUser->bindParam(':password', $this->password, PDO::PARAM_STR, strlen($this->password));
                $newUser->bindParam(':city', $this->city, PDO::PARAM_STR, strlen($this->city));
                $newUser->bindParam(':admin', $this->admin, PDO::PARAM_INT);
                $newUser->execute();
                $newUser->closeCursor();
                $this->id = $db->lastInsertId();
            }else{
                $updatedUser = $db->prepare('UPDATE user
					SET firstName = :firstName, lastName = :lastName, mail = :mail, cellPhoneNumber = :cellPhoneNumber, 
					address = :address, country = :country, admin = :admin, password = :password
					WHERE id = :id');

                $updatedUser->bindParam(':firstName', $this->firstName, PDO::PARAM_STR, strlen($this->firstName));
                $updatedUser->bindParam(':lastName', $this->lastName, PDO::PARAM_STR, strlen($this->lastName));
                $updatedUser->bindParam(':mail', $this->mail, PDO::PARAM_STR, strlen($this->mail));
                $updatedUser->bindParam(':cellPhoneNumber', $this->cellPhoneNumber, PDO::PARAM_STR, strlen($this->cellPhoneNumber));
                $updatedUser->bindParam(':address', $this->address, PDO::PARAM_STR, strlen($this->address));
                $updatedUser->bindParam(':country', $this->country, PDO::PARAM_STR, strlen($this->country));
                $updatedUser->bindParam(':admin', $this->admin, PDO::PARAM_INT);
                $updatedUser->bindParam(':password', $this->password, PDO::PARAM_STR, strlen($this->password));
                $updatedUser->bindParam(':id', $this->id, PDO::PARAM_INT);
                $updatedUser->execute();
                $updatedUser->closeCursor();

            }

            foreach($this->buildings as $building){
                $building->save();
            }
            foreach($this->homes as $home){
                $home->save();
            }
            return $this;

        }else{
            return null;
        }
    }
*/

    /**
     * @return User
     *//*
    public function delete($db)
    {
        $request = $db->prepare('DELETE FROM user WHERE id = :id');
        $request ->bindParam(':id', $this->id, PDO::PARAM_INT);
        $request->execute();
        $request->closeCursor();
        return $this;
    }

    /**
     * @return User
     *//*
    public function createFromResults($data)
    {
        $this->id = $data['id'];
        $this->firstName = $data['firstName'];
        $this->lastName = $data['lastName'];
        $this->mail = $data['mail'];
        $this->address = $data['address'];
        $this->adminBuilding = $data['adminBuilding'];
        $this->cellPhoneNumber = $data['cellPhoneNumber'];
        $this->country = $data['country'];
        $this->password = $data['password'];

        /** @var BuildingRepository $buildingRepo *//*
        $buildingRepo = $GLOBALS['repositories']['building'];
        $this->buildings = $buildingRepo -> getBuildingsFromUserId($this->id);


        /** @var HomeRepository  $homeRepo *//*
        $homeRepo = $GLOBALS['repositories']['home'];
        $this -> homes = $homeRepo -> getHomesFromUserId($this->id);

        return $this;
    }
*/



}