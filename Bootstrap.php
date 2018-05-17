<?php
/**
 * Created by PhpStorm.
 * User: dangvo
 * Date: 4/20/2018
 * Time: 9:54 AM
 */


class Bootstrap
{
    const CONTROLLER_SUFFIX = "Controller";
    const ACTION_SUFFIX = "Action";

    public $controller;
    public $action;
    public $controllerName;
    public $actionName;

    protected $suffix = ".html";
    protected $default_controller = "Home";
    protected $default_action = "index";
    protected $errorController = "Error";
    public $id;
    public $params = [];

    protected $url;

    public function __construct($config = null)
    {
        if (isset($config['default_action'])){
            $this->default_controller = $config['default_controller'];
            $this->default_action = $config['default_action'];
            $this->suffix = $config['suffix'];

        }
        // your_domain.com/controller/action/id    RETURN  controller/action/id
        $this->url = !empty($_SERVER["QUERY_STRING"]) ? $_SERVER["QUERY_STRING"] : strtolower($this->default_controller) . "/" . $this->default_action ;
    }

    public function resolveURL()
    {
        // your_domain.con/controller.html  ORR your_domain.con/controller
        $url = StringHelper::endsWith($this->url, $this->suffix) ? $this->url : $this->url.$this->suffix;

        // check if request url is controller/action/id; e.g  your_domain.com/user/edit/123
        $rule1 = "#(?P<controller>[a-zA-Z\-]+)\/(?P<action>[a-zA-Z\-]+)\/(?P<id>[a-zA-Z0-9\-]+)(". $this->suffix .")#i";

        $matches = [];
        preg_match($rule1, $url, $matches);
        if ( isset($matches['controller']) && isset($matches['action']) && isset($matches['id']) ){
                $this->controller = $matches['controller'];
                $this->action = $matches['action'];
                $this->id = $matches['id'];
                $_GET['id'] = $matches['id']; //append id to $_GET variable
        }else{

            // check rule 2: .controller/action; e.g /user/login
            $rule2 = "#(?P<controller>[a-zA-Z\-]+)\/(?P<action>[a-zA-Z\-]+)(". $this->suffix .")#i";

            preg_match($rule2, $url, $matches);
            if ( isset($matches['controller']) && isset($matches['action']) ){
                $this->controller = $matches['controller'];
                $this->action = $matches['action'];
                $this->id = null;
                $_GET['id'] = null; //append id to $_GET variable
            }else{
                // check rule 3: /controller ;  e.g /user
                $rule3 = "#(?P<controller>[a-zA-Z\-]+)(". $this->suffix .")#i";
                preg_match($rule3, $url, $matches);
                if ( isset($matches['controller']) ){
                    $this->controller = $matches['controller'];
                    $this->action = $this->default_action; // set action to default action;
                    $this->id = null;
                    $_GET['id'] = null; //append id to $_GET variable
                }else{

                    // call ErorController/defaul_action
                    $this->controller = $this->errorController;
                    $this->params[] = "Page not found!";
                    $this->action = $this->default_action;
                    $this->id = null;
                    $_GET['id'] = null; //append id to $_GET variable
                }
            }

        }


        // convert controller names; e.g. post-authors => PostAuthors
        $this->controller = StringHelper::convertToStudlyCaps($this->controller);
        $this->controllerName = $this->controller;

        // add suffix; e.g PostAuthors => PostAuthorsController
        $this->controller = StringHelper::convertToStudlyCaps($this->controller) . self::CONTROLLER_SUFFIX;



        // convert action names; e.g. add-new => addNew;
        $this->action = StringHelper::convertToCamelCase($this->action);
        $this->actionName = $this->action;

        // add action suffix; e.g addNew ==> addNewAction
        $this->action = StringHelper::convertToCamelCase($this->action) . self::ACTION_SUFFIX;

      /*  echo "<pre>";
        var_dump($this);
        die;*/
    }

}