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
            'SELECT * FROM ' . strtolower(self::OBJECT_CLASS_NAME)
            . ' WHERE quoteTreated = 2'
        );

        $submittedQuoteSearch -> execute();

        return $this->getResultantObjects( $submittedQuoteSearch);
    }

    public function getUsersWithTreatedQuote()
    {
        $treatedQuoteSearch = $this->db->prepare(
            'SELECT * FROM ' . strtolower(self::OBJECT_CLASS_NAME)
            . ' WHERE quoteTreated = 1 AND validated = 2'
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

    public function searchUsers($data)
    {
        $firstName = "%";
        $lastName = "%";
        $mail = "%";

        if(!empty($data['firstName'])){
            $firstName = '%' . $data['firstName'] . '%';
        }
        if(!empty($data['lastName'])){
            $lastName = '%' . $data['lastName'] . '%';
        }
        if(!empty($data['mail'])){
            $mail = '%' . $data['mail'] . '%';
        }

        $usersSearch = $this->db->prepare(
            'SELECT * FROM user '
            . ' WHERE firstName LIKE :firstName AND lastName LIKE :lastName AND mail LIKE :mail  '
        );

        $usersSearch -> bindParam(':firstName', $firstName, PDO::PARAM_STR, strlen($firstName));
        $usersSearch -> bindParam(':lastName', $lastName, PDO::PARAM_STR, strlen($lastName));
        $usersSearch -> bindParam(':mail', $mail, PDO::PARAM_STR, strlen($mail));

        $usersSearch->execute();

        return $usersSearch -> fetchAll(PDO::FETCH_ASSOC);



    }


}