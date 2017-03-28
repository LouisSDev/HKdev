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
            if(!empty($GLOBALS['mail']) && !empty($GLOBALS['password'])) {
                if($this instanceof UserRepository) {
                    $this->connect($GLOBALS['mail'], $GLOBALS['password']);
                }else{
                    $this->user = $GLOBALS['repositories']['user']->getUser();
                }
            }
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