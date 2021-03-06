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
        if(isset($_GET['errorMessage'])){
            $this -> args['error_message'] = $_GET['errorMessage'];
        }

        $this -> generateView('static/homepage.php', 'Accueil' );
    }

    public function homepage()
    {
        $this -> generateView('static/homepage.php', 'Home');
    }

    public function disclaimer(){
        $this -> generateView('static/disclaimer.php', 'Mention Légal');
    }

}

