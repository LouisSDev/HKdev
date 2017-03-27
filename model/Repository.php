<?php

class Repository
{
    /*
     * @var PDO $db
     *
     */
    protected $db;

    /*
     * @var User $user
     *
     */
    protected $user;

    /**
     * UserRepository constructor.
     */
    public function __construct($db, $user = null)
    {
        $this->db = $db;
        if($user != null){
            $this->user = $user;
        }
        else{
            $this->connect($GLOBALS['mail'], $GLOBALS['password']);
            try{
                if($this->user == null){
                    $this->user = $GLOBALS['repositories']['user'] -> getUser();
                }
            }catch(Exception $e){}
        }

    }

    /**
     * @param string $mail
     * @param string $password
     * @param boolean $encrypt
     * @return User
     */
    public function connect($mail, $password, $encrypt = true)
    {
        return null;
    }
}