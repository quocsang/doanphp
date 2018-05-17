<?php
/**
 * Created by PhpStorm.
 * User: dangvo
 * Date: 4/20/2018
 * Time: 11:04 AM
 */

include_once "Bootstrap.php";
include_once "Controller.php";
include_once "View.php";

class Application extends Bootstrap
{

    public $config;

    public function __construct($config = null)
    {
        if (! isset($config['router']) ){
            throw new \Exception("Invalid config file.");

        }

       parent::__construct($config);
       $this->config = $config;

       $this->init();
    }

    private function init()
    {
        $this->resolveURL();
    }

    public function getControllerPath(){
        return $this->config['controllerPath'];
    }

    public function run()
    {
        $controller_file = $this->getControllerPath() . DIRECTORY_SEPARATOR . $this->controller . ".php";

        if (! file_exists($controller_file)){
            header("location: /error.html");
            exit;
        }

        include_once  $controller_file;

        $controllerClass = $this->controller;
        $controllerObject = new $controllerClass($this->controllerName, $this->actionName, $this->params);

        $page  =  $controllerObject->runAction($this->action);
        echo $page;
    }

    public function isLogin()
    {
            if (! isset($_SESSION['user'])){
                return false;
            }

            $user = unserialize($_SESSION['user']);

            return ! empty($user->id);

    }

    public function goHome()
    {
        header("location: /" . strtolower($this->default_controller) . $this->suffix);
    }

    public function goLogin()
    {
        header("location: /user/login.html");
    }

    public function getUser()
    {
        if (! isset($_SESSION['user'])){
            return new User();
        }

        $user = unserialize($_SESSION['user']);
        return $user;
    }


    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === "POST" ;
    }

    public function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] === "GET" ;
    }

    public function post($key, $default = "")
    {
        return isset($_POST[$key]) ? $_POST[$key] : $default ;
    }
    public function get($key, $default = "")
    {
        return isset($_GET[$key]) ? $_GET[$key] : $default ;
    }


}