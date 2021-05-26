<?php namespace app\controllers;

use app\controller;

class error extends controller
{
    public function page404()
    {
        echo '404';
    }

    public function page500()
    {
        echo '500';
    }
}
