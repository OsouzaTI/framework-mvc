<?php

namespace Core;

use Exception;
use Core\Assets;

class Html {

    public $assets;

    public function __construct() {
        $this->assets = new Assets();
    }

    private function generateJsIncludeFile($filePath) {
        return "<script src='$filePath'></script>";
    }
    
    private function generateCssIncludeFile($filePath) {
        return "<link rel='stylesheet' href='$filePath'>";
    }

    public function js($files = []) {
        $jsHtml = [];
        foreach($files as $file) {
            $filePath = $this->assets->fetch("js/$file.js");
            $jsIncludeHtml = $this->generateJsIncludeFile($filePath);
            array_push($jsHtml, $jsIncludeHtml);
        }
        return implode('<br>', $jsHtml);
    }

    public function css($files = []) {
        $cssHtml = [];
        foreach($files as $file) {
            $filePath = $this->assets->fetch("css/$file.css");
            $cssIncludeHtml = $this->generateCssIncludeFile($filePath);
            array_push($cssHtml, $cssIncludeHtml);
        }
        return implode('<br>', $cssHtml);
    }

}