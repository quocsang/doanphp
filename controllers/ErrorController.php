<?php
/**
 * Created by PhpStorm.
 * User: dangvo
 * Date: 4/20/2018
 * Time: 12:00 PM
 */

class ErrorController extends Controller
{
    public function indexAction($msg)
    {
        echo "Error: $msg";
    }

    public function testAction()
    {
        echo "test";
    }

    public function errorAction()
    {
        echo "Error action";
    }

}