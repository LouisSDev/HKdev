<?php


class UserCredentials
{

    public function __construct(){
        if(!empty($_POST['userMail']) && !empty($_POST['userPassword'])){
            $GLOBALS['mail'] = $_POST['userMail'];
            $GLOBALS['password'] = $_POST['userPassword'];
        }else if(!empty($_SESSION['mail']) && !empty($_SESSION['password'])){
            $GLOBALS['mail'] = $_SESSION['mail'];
            $GLOBALS['password'] = $_SESSION['password'];
        }else if(!empty($_COOKIE['mail']) && !empty($_COOKIE['password'])){
            $GLOBALS['mail'] = $_COOKIE['mail'];
            $GLOBALS['password'] = $_COOKIE['password'];
        }
    }

}