<?php

class User implements DatabaseEntity
{
    /**
     * @var integer
     *
     */
    private $id = -1;

    /**
     * @var string
     */
    private $firstName;

    /**
         * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $mail;

    /**
     * @var string
     */
    private $cellPhoneNumber;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $country;

    /**
     * @var boolean
     */
    private $adminBuilding;

    /**
     * @var array
     */
    private $buildings;

    /**
     * @var array
     */
    private $homes;


    /**
     * @var boolean
     */
    private $error;

    /**
     * @var string
     */
    private $errorMessage;





    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param int
     * @return User
     *
     */
    private function setId($id)
    {
        $this->id = $id;
        return $this;
    }


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
        $this->firstName = $firstName;
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
        $this->lastName = $lastName;
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
        $this->cellPhoneNumber = $cellPhoneNumber;
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
        $this->address = $address;
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
     * @param string $country
     * @return User
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return boolean
     */

    public function isAdminBuilding()
    {
        return $this->adminBuilding;
    }

    /**
     * @param boolean $adminBuilding
     * @return User
     */
    public function setAdminBuilding($adminBuilding)
    {
        $this->adminBuilding = $adminBuilding;
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
     * @return array
     */
    public function getBuildings()
    {
        return $this->buildings;
    }

    /**
     * Add home
     *
     * @param Home
     * @return User
     */

    public function addHome($home){
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

    public function removeHome($home){
        if(!in_array($home, $this->homes)) {
            unset($this->homes[array_search($home,$this->homes)]);
            $home->setUser(null);
        }
        return $this;
    }


    /**
     * Add building
     *
     * @param Building
     * @return User
     */

    public function addBuilding($building){
        if(!in_array($building, $this->buildings)){
            array_push( $this->buildings, $building);
            $building->setUser($this);
        }
        return $this;
    }

    /**
     * Remove building
     *
     * @param Building
     * @return User
     */

    public function removeBuilding($building){
        if(!in_array($building, $this->buildings)){
            unset($this->buildings[array_search($building,$this->buildings)]);
            $building->setUser(null);
        }
        return $this;
    }

    /**
     * @return User
     */
    public function save($db)
    {
        if ($this->getValid()) {
            if ($this->id == -1) {
                $newUser = $db->prepare('INSERT INTO 
                    user(firstName, lastName, mail, cellPhoneNumber, address, country, adminBuilding) 
					VALUES(:firstName, :lastName, :mail, :cellPhoneNumber, :address, :country, :adminBuilding)');

                $newUser->bindParam(':firstName', $this->firstName, PDO::PARAM_STR, strlen($this->firstName));
                $newUser->bindParam(':lastName', $this->lastName, PDO::PARAM_STR, strlen($this->lastName));
                $newUser->bindParam(':mail', $this->mail, PDO::PARAM_STR, strlen($this->mail));
                $newUser->bindParam(':cellPhoneNumber', $this->cellPhoneNumber, PDO::PARAM_STR, strlen($this->cellPhoneNumber));
                $newUser->bindParam(':address', $this->address, PDO::PARAM_STR, strlen($this->address));
                $newUser->bindParam(':country', $this->country, PDO::PARAM_STR, strlen($this->country));
                $newUser->bindParam(':adminBuilding', $this->adminBuilding, PDO::PARAM_INT);
                $newUser->execute();
                $newUser->closeCursor();
                $this->id = $db->lastInsertId();
                // Get last id entered
            }else{
                $updatedUser = $db->prepare('UPDATE user
					SET firstName = :firstName, lastName = :lastName, mail = :mail, cellPhoneNumber = :cellPhoneNumber, 
					address = :address, country = :country, adminBuilding = :adminBuilding
					WHERE id = :id');

                $updatedUser->bindParam(':firstName', $this->firstName, PDO::PARAM_STR, strlen($this->firstName));
                $updatedUser->bindParam(':lastName', $this->lastName, PDO::PARAM_STR, strlen($this->lastName));
                $updatedUser->bindParam(':mail', $this->mail, PDO::PARAM_STR, strlen($this->mail));
                $updatedUser->bindParam(':cellPhoneNumber', $this->cellPhoneNumber, PDO::PARAM_STR, strlen($this->cellPhoneNumber));
                $updatedUser->bindParam(':address', $this->address, PDO::PARAM_STR, strlen($this->address));
                $updatedUser->bindParam(':country', $this->country, PDO::PARAM_STR, strlen($this->country));
                $updatedUser->bindParam(':adminBuilding', $this->adminBuilding, PDO::PARAM_INT);
                $updatedUser->bindParam(':id', $this->id, PDO::PARAM_INT);
                $updatedUser->execute();
                $updatedUser->closeCursor();

            }

            // SAVE LES OBJETS QUI DEPENDENT
            return $this;

        }else{
            return null;
        }
    }

    /**
     * @return User
     */
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
     */
    public function createFromResults($data)
    {
        // TODO: Implement createFromResults() method.
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
            ){
                if($this->adminBuilding == null){
                    $this->adminBuilding = false;
                }
                return true;
            }else{
                return false;
            }
        }
    }

    /**
     * @return boolean
     */
    public function isError()
    {
        return $this->error;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}