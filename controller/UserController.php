<?php

class UserController extends Controller
{

    protected $connectionRequired = true;

    public function getDashboard(){
        $this -> generateView('dashboard.php');
    }


}