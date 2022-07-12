<?php

namespace App;

use Core\Assets;
use Core\Component;
use Core\Html;
use Core\ORM\MongoDB;

class Controller {
    public $component;
    public $assets;
    public $html;
    public $mongo;
    public function __construct() {
        $this->component = new Component();
        $this->assets = new Assets();
        $this->html = new Html();
        $this->mongo = new MongoDB('db_jornal');
        // $this->mongo->connetion('mongodb://root:pass@mongo:27017'); 
        $this->mongo->connetion('mongodb+srv://root:pass@cluster0.e4ljd0u.mongodb.net/?retryWrites=true&w=majority'); 
    }
    public function view($view, $data = []) {
        $render = function() use($view, $data) {
            require_once __DIR__ . "/Views/{$view}.php";
        };        
        require_once __DIR__ . "/Layout/Default.php";
    }

}