<?php

namespace App;

use Core\Assets;
use Core\Component;
use Core\Html;

class Controller {
    public $component;
    public $assets;
    public $html;
    public function __construct() {
        $this->component = new Component();
        $this->assets = new Assets();
        $this->html = new Html();
    }
    public function view($view, $data = []) {
        $render = function() use($view, $data) {
            require_once __DIR__ . "/Views/{$view}.php";
        };        
        require_once __DIR__ . "/Layout/Default.php";
    }

}