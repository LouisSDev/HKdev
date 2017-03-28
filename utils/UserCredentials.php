<?php


class UserCredentials
{

    public function __construct(){
        if(!empty($_POST['mail']) && !empty($_POST['password'])){
            $GLOBALS['mail'] = $_POST['mail'];
            $GLOBALS['password'] = $_POST['password'];
        }else if(!empty($_SESSION['mail']) && !empty($_SESSION['password'])){
            $GLOBALS['mail'] = $_SESSION['mail'];
            $GLOBALS['password'] = $_SESSION['password'];
        }
    }

}