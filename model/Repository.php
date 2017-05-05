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

    }


    protected function getResultantObjects($objectsQuery){
        $objects = array();
        while($objectData = $objectsQuery -> fetch(PDO::FETCH_ASSOC)){

            $objectClassName = self::OBJECT_CLASS_NAME;
            $object = new $objectClassName();
            $object -> createFromResults($objectData);

            $objects[] = $object;
        }

        $objectsQuery -> closeCursor();

        return $objects;
    }

    // Example, we could call it with params : (3 , user, Home ) which means we'll search for the homes that belongs to user 3
    public function getObjectsFromId($id, $fromObject,$fromTable ){

        // The from object name goes to lower case
        $fromTable = strtolower($fromTable);

        // We prepare the questy
        $objectsQuery = $this->db->prepare('SELECT * FROM '
            . $fromTable . ' WHERE ' . $fromObject . ' = :' . $fromObject ) ;
            // Example :  SELECT * FROM room WHERE home = :home

        // We bind the param and execute the request
        $objectsQuery -> bindParam(':' . $fromObject , $id, PDO::PARAM_INT);
        $objectsQuery -> execute();

        return $this->getResultantObjects($objectsQuery);
    }

    /**
     * @return User
     */
    public function connectFromGlobals()
    {

        return null;
    }
}