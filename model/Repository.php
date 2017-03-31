<?php

class Repository
{
    /*
     * @var PDO $db
     *
     */
    const OBJECT_CLASS_NAME = '';
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


    protected function getResultantObjects($objectsQuery){
        $objects = array();
        while($objectData = $objectsQuery -> fetch(PDO::FETCH_ASSOC)){

            $objectClassName = self::OBJECT_CLASS_NAME;
            $object = new $objectClassName();
            $object -> createFromResults($objectData);

            $objects[] = $object;
        }

        return $objects;
    }

    public function getObjectsFromId(integer $id, string $fromObject){
        $methodName = "getObjectsFrom" . $fromObject . "Id";
        $this->$methodName($id);
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