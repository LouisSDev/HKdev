<?php


class UserRepository
{

    /*
     * @var PDO
     *
     */
    private $db;

    /*
     * @var User
     *
     */
    private $user;

    /**
     * UserRepository constructor.
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * @param $mail
     * @param $password
     */
    public function connect($mail, $password, $encrypt){
        if($encrypt){
            $password = sha1($password.$GLOBALS['salt']);
        }
        $connect = $this->db->prepare('SELECT * FROM user WHERE mail = :mail AND password = :password');
        $connect -> bindParam(':password', $password, PDO::PARAM_STR, strlen($password));
        $connect -> execute();
        $user = $connect -> fetch(PDO::FETCH_ASSOC);
        $this->user = $user;
        return $user;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }


}