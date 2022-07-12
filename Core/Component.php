<?php

namespace Core;

use Exception;

class Component {

    public function render($component, $data = []) {
        $componentFile = "App/Components/{$component}.php";
        if(file_exists($componentFile)) {
            require $componentFile;
        } else {
            throw new Exception("Component $component não existe!");
        }
    }

}