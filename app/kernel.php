<?php
namespace app;

use app;
use app\exceptions\routeException;

class kernel{
    public $defaultControllerName = 'index';

    public $defaultActionName = "index";

    public function launch()
    {

        list($controllerName, $actionName, $params) = app::$router->resolve();
        echo $this->launchAction($controllerName, $actionName, $params);

    }


    public function launchAction($controllerName, $actionName, $params)
    {

        $controllerName = empty($controllerName) ? $this->defaultControllerName : $controllerName;
        if(!file_exists(ROOTPATH.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR.$controllerName.'.php')){
            throw new \App\Exceptions\routeException();
        }
        require_once ROOTPATH.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR.$controllerName.'.php';
        if(!class_exists("\\app\\controllers\\".$controllerName)){
            throw new \App\Exceptions\routeException();
        }
        $controllerName = "\\app\\controllers\\".$controllerName;
        $controller = new $controllerName;
        $actionName = empty($actionName) ? $this->defaultActionName : $actionName;
        if (!method_exists($controller, $actionName)){
            throw new \App\Exceptions\routeException();
        }
        return $controller->$actionName($params);

    }
}
