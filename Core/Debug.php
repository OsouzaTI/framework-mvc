<?php

namespace Core;

class Debug {

    static function debug($object) {
        echo '<pre>';
        print_r($object);
        echo '</pre>';
    }

}