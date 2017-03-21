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
     * @return int
     *
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
        $this->mail = $mail;
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
        if($this->id == -1){
            $newUser = $this->db->prepare('INSERT INTO user(nom, reference, prix, adressePhoto, TVA) 
					VALUES(:nom, :reference, :prix, :adressePhoto, :TVA)');
            $newUser->bindParam(':name',$this->name, PDO::PARAM_STR, strlen($this->name));
            $newUser->execute();
            $newUser->closeCursor();
        }
        return $this;
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
}