<?php


class UserRepository extends Repository
{

    /**
     * @param string $mail
     * @param string $password
     * @param boolean $encrypt
     * @return User
     */
    public function connect($mail, $password, $encrypt = true){
        if($encrypt){
            $password = sha1($password.$GLOBALS['salt']);
        }
        $connect = $this->db->prepare('SELECT * FROM user WHERE mail = :mail AND password = :password');
        $connect -> bindParam(':password', $password, PDO::PARAM_STR, strlen($password));
        $connect -> bindParam(':mail', $mail, PDO::PARAM_STR, strlen($mail));
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