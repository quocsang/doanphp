<?php
/**
 * Created by PhpStorm.
 * User: dangvo
 * Date: 4/28/2018
 * Time: 12:59 PM
 */

class View
{
    public $controller;
    public $action;
    public $css = [];
    public $js = [];

    private $_viewSuffix = ".phtml";
    private $params = [];

    public $title = "Home";

    public $app;

    public  function __construct($controller, $action, $params = [])
    {
        $this->controller = $controller;
        $this->action = $action;
        $this->params = $params;

        $this->css[] =  strtolower( StringHelper::formalizeString($this->controller));
        $this->css[] = strtolower( StringHelper::formalizeString($this->controller) . "." . $this->action);

        $this->js[] =  strtolower( StringHelper::formalizeString($this->controller));
        $this->js[] = strtolower( StringHelper::formalizeString($this->controller) . "." . $this->action);

        global $app;
        $this->app = $app;
    }

    private function renderContent($view,$args)
    {
        $file = $this->findViewFile($view);
        return $this->renderFile($file,$args);
    }

    private function renderPage($args)
    {
        $layoutFile = $this->findLayoutFile();
        return   $this->renderFile($layoutFile,$args);
    }

    private function findLayoutFile()
    {
        return VIEW_DIR . DIRECTORY_SEPARATOR . "layout" . $this->_viewSuffix;
    }

    private function renderFile($viewFile, $params = [])
    {
        $output = $this->renderPhpFile($viewFile, $params);
        return $output;
    }

    private function findViewFile($view)
    {
        $file = VIEW_DIR . DIRECTORY_SEPARATOR . strtolower( StringHelper::formalizeString($this->controller) . DIRECTORY_SEPARATOR .
                ltrim($view, '/')   ) ;
        $path = $file . $this->_viewSuffix;

        if (!file_exists($path)){
            throw new \Exception("Unable to find the View  " . $path);

        }
        return $path;
    }

    private function renderPhpFile($_file_, $_params_ = [])
    {
        $_obInitialLevel_ = ob_get_level();
        ob_start();
        ob_implicit_flush(false);
        extract($_params_, EXTR_OVERWRITE);
        try {
            require $_file_;
            return ob_get_clean();
        } catch (\Exception $e) {
            while (ob_get_level() > $_obInitialLevel_) {
                if (!@ob_end_clean()) {
                    ob_clean();
                }
            }
            throw $e;
        } catch (\Throwable $e) {
            while (ob_get_level() > $_obInitialLevel_) {
                if (!@ob_end_clean()) {
                    ob_clean();
                }
            }
            throw $e;
        }
    }

    public function renderPartial($view,$args = [] )
    {
        return $this->renderContent($view, $args);
    }

    public function render($view,$args = [] )
    {
        $content = $this->renderContent($view, $args);
        $jsfiles = "";
        foreach($this->js as $file){
            $f =  JS_DIR . DIRECTORY_SEPARATOR . $file . ".js" ;

            if (file_exists($f)){
                $f = "/" .  basename(JS_DIR) . "/" . $file . ".js";
                $jsfiles .= "<script src='". $f ."'></script>";
            }
        }

        $cssFiles = "";
        foreach($this->css as $file){
            $f =  CSS_DIR . DIRECTORY_SEPARATOR . $file. ".css" ;

            if (file_exists($f)){
                $f = "/" .  basename(CSS_DIR) . "/" . $file . ".css";
                $cssFiles .= "<link href='". $f ."' rel=\"stylesheet\" />";
            }
        }


        return $this->renderPage([
            'content' => $content,
            'js'   => $jsfiles,
            'css'   => $cssFiles
        ]);
    }
}