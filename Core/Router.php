<?php


namespace Core;

use Exception;

class Router {

    private $controller = 'HomeController';
    private $method = 'index';
    private $params = [];

    public function __construct() {
        $router = $this->processUrl();
        
        $controller = ucfirst($router[0]).'Controller';
        $fileName = "App/Controllers/{$controller}.php";
        if(file_exists($fileName)) {
            $this->controller = $controller;
            unset($router[0]);   
        }

        $class = "\\App\\Controllers\\$this->controller";
        $object = new $class;

        if(isset($router[1]) && method_exists($class, $router[1])) {
            $this->method = $router[1];
            unset($router[1]);
        }

        $this->params = $router ? array_values($router) : [];
        call_user_func_array([$object, $this->method], $this->params);
    }

    public function processUrl() : array
    {
        $url = explode('/', filter_input(INPUT_GET, 'router', FILTER_SANITIZE_URL));
        return $url;
    }

}