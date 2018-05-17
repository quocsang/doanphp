<?php
/**
 * Created by PhpStorm.
 * User: dangvo
 * Date: 4/20/2018
 * Time: 11:15 AM
 */


class Controller
{
    public $controller;
    public $action;
    private $params = [];
    public $controllerPath;
    public $errorMessage;



    /**
     * @var View
     */
    private $_view;
    /**
     * @var Application
     */
    public $app;

    public function __construct($controller, $action = 'index', $params = [])
    {
        $this->controller = $controller;
        $this->action = $action;
        $this->params = $params;

        global $app;
        $this->app = $app;

    }

    public function getView()
    {
        if ($this->_view === null) {
            $this->_view = new View($this->controller, $this->action, $this->params);
        }

        return $this->_view;
    }

    public function render($view,$args = [] )
    {
            return $this->getView()->render($view, $args);
    }

    public function renderPartial($view,$args = [] )
    {
        return $this->getView()->renderPartial($view, $args);
    }


    public function beforeAction()
    {
        return true;
    }

    public function runAction($action)
    {
        $this->params[] = $this->errorMessage;

        if ($this->beforeAction()){

            $controllerClass = get_called_class();
            $methods  =  get_class_methods($controllerClass);
            if (in_array($action, $methods)){
                return  call_user_func_array(array($this, $action),$this->params);
            }else{
                http_response_code(404);
                header("location: /error.html");
            }
        }else{

            $controller_file = $this->getControllerPath() . DIRECTORY_SEPARATOR . "ErrorController.php";
            if (! file_exists($controller_file)){
               throw new \Exception("ErrorController not found.");
            }
            include_once  $controller_file;
            $controllerClass = "ErrorController";

            $methods  =  get_class_methods($controllerClass);
            $controllerObject = new $controllerClass(null);
            if (in_array($action, $methods)){
                return  call_user_func_array(array($controllerObject, $action),[$this->errorMessage]);
            }else{
                throw new \Exception("index action in the ErrorController not found.");
            }

        }

    }


    public function getControllerPath(){

        return $this->app->getControllerPath();
    }

}