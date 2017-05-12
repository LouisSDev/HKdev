<?php


class StaticController extends Controller
{

    public function __construct()
    {
        parent::__construct(null);
    }

    public function notFound()
    {
        $this -> generateView('static/404.php', 'Not Found' );
    }


}