<?php


class UserCredentials
{

    private $password;
    private $mail;
    private $encrypted = false;
    private $connectionTried = true;

    public function __construct(){
        if(!empty($_POST['userMail']) &&  !empty($_POST['userPassword'])){
            $this -> mail = $_POST['userMail'];
            $this -> password = $_POST['userPassword'];
        }
        else if (isset($_SESSION['mail'], $_SESSION['password'])) {
            $this->mail = $_SESSION['mail'];
            $this->password = $_SESSION['password'];
            $this->encrypted = true;
        } else if(!empty($_COOKIE['mail']) && !empty($_COOKIE['password'])) {
            $this->mail = $_COOKIE['mail'];
            $this->password = $_COOKIE['password'];
            $this->encrypted = true;
        } else {
            $this->connectionTried = false;
        }
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return boolean
     */
    public function isEncrypted()
    {
        return $this->encrypted;
    }

    /**
     * @param boolean $encrypted
     */
    public function setEncrypted($encrypted)
    {
        $this->encrypted = $encrypted;
    }

    /**
     * @return boolean
     */
    public function isConnectionTried()
    {
        return $this->connectionTried;
    }

    /**
     * @param boolean $connectionTried
     */
    public function setConnectionTried($connectionTried)
    {
        $this->connectionTried = $connectionTried;
    }





}