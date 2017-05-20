<?php


class UserRepository extends Repository
{

    /*
     * @var $connected boolean
     */
    protected $connected = false;

    /**
     * @var $dbConn DatabaseConnection
     *
     */
    protected $dbConn;

    const OBJECT_CLASS_NAME = 'User';

    /**
     * UserRepository constructor.
     */
    public function __construct($db, DatabaseConnection $dbConn)
    {
        parent::__construct($db);

        $this -> dbConn = $dbConn;
    }


    /**
     * @param string $mail
     * @param string $password
     * @param boolean $encrypt
     * @return User
     */
    public function connect($mail, $password, $encrypt = false){
        if($encrypt){
            $passwordEncrypted = sha1($password.$GLOBALS['salt']);
        }else{
            $passwordEncrypted = $password;
        }

        return $this -> canonicalConnection($mail, $passwordEncrypted);
    }

    public function connectFromGlobals()
    {
        /** @var UserCredentials $userCredentials */
        $userCredentials = $GLOBALS['credentials'];
        if($userCredentials -> isEncrypted()){
            $passwordEncrypted = $userCredentials -> getPassword() ;
        }else{
            $passwordEncrypted = sha1($userCredentials -> getPassword() . $GLOBALS['salt']) ;
        }
        $mail =  $userCredentials -> getMail();

        return $this -> canonicalConnection($mail,$passwordEncrypted);
    }

    public function canonicalConnection($mail, $passwordEncrypted){
        $connect = $this->db->prepare(
            'SELECT * FROM user'
        .   ' WHERE mail = :mail AND password = :password AND validated IS TRUE');
        $connect -> bindParam(':password', $passwordEncrypted, PDO::PARAM_STR, strlen($passwordEncrypted));
        $connect -> bindParam(':mail', $mail, PDO::PARAM_STR, strlen($mail));
        $connect -> execute();

        if($userArray = $connect -> fetch(PDO::FETCH_ASSOC)){
            $_SESSION['mail'] = $mail;
            $_SESSION['password'] = $passwordEncrypted;
            $user = new User();
            $user -> createFromResults($userArray);
            $this->user = $user;
            $this->connected = true;
        }else{
            unset($_SESSION['password']);
            unset($_SESSION['mail']);
        }

        return $this->user;
    }

    public function isMailAlreadyUsed($mail){
        $find = $this->db->prepare('SELECT * FROM user WHERE mail = :mail  ');
        $find -> bindParam(':mail', $mail, PDO::PARAM_STR, strlen($mail));
        $find -> execute();

        if($find -> fetch()){
            return true;
        }
        return false;
    }


    public function getUsersWithSubmittedQuote()
    {
        $submittedQuoteSearch = $this -> db -> prepare(
            'SELECT * FROM ' . self::OBJECT_CLASS_NAME
            . ' WHERE quoteTreated is FALSE'
        );

        $submittedQuoteSearch -> execute();

        return $this->getResultantObjects( $submittedQuoteSearch);
    }

    public function getUsersWithTreatedQuote()
    {
        $treatedQuoteSearch = $this->db->prepare(
            'SELECT * FROM ' . self::OBJECT_CLASS_NAME
            . ' WHERE quoteTreated IS TRUE AND validated IS FALSE'
        );

        $treatedQuoteSearch->execute();

        return $this->getResultantObjects($treatedQuoteSearch);
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @return boolean
     */
    public function isConnected()
    {
        return $this->connected;
    }

    public function createRepositories(){
        $this -> dbConn -> createOtherRepositories();
    }


    public function getObjectClassName()
    {
        return self::OBJECT_CLASS_NAME;
    }


}