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

    public function contact()
    {
        $this -> generateView('static/contactPage.php', 'Contactez Nous!' );
    }


    public function homepage()
    {
        $this -> generateView('static/homepage.php', 'Home');
    }

}

