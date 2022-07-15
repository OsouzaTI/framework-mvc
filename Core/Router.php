<?php


namespace Core;

use Exception;

class Router {

    private $controller = 'HomeController';
    private $method = 'index';
    private $params = [];

    // Middleware
    private $beforeMiddleware = [];
    private $afterMiddleware = [];

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

        // executa todos os middlewares que foram adicionados na area de before
        $this->handlerBeforeMiddlewares();

        // executa a funcao principal de roteamente
        call_user_func_array([$object, $this->method], $this->params);
        
        // executa todos os middlewares que foram adicionados na area de after
        $this->handlerAfterMiddlewares();
    }

    private function handlerBeforeMiddlewares() {
        foreach($this->beforeMiddleware as $middleware)
            $middleware($this->params);
    }

    private function handlerAfterMiddlewares() {
        foreach($this->afterMiddleware as $middleware)
            $middleware($this->params);
    }

    public function before($middleware) 
    {
        $this->beforeMiddleware[] = $middleware;
        return $this;
    }

    public function after($middleware) 
    {
        $this->afterMiddleware[] = $middleware;
        return $this;
    }

    public function processUrl() : array
    {
        $url = explode('/', filter_input(INPUT_GET, 'router', FILTER_SANITIZE_URL));
        return $url;
    }

}