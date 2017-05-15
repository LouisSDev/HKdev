<?php


class StaticController extends Controller
{

    protected $connectionRequired = false;

    public function notFound()
    {
        $this -> generateView('static/404.php', 'Not Found' );
    }

    public function connection()
    {
        $this -> generateView('general/connection.php', 'Connection' );
    }

    public function contact()
    {
        $this -> generateView('static/contactPage.php', 'Contactez Nous!' );
    }


    public function homepage()
    {
        $this -> generateView('static/homepage.php', 'Home');
    }


}