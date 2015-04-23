<?php

class Layout {

    private function __construct() {
        /* Locked */
    }

    public static function getInstance() {
        if (self::$layoutManager == null) {
            return self::$layoutManager = new Layout();
        } else {
            return self::$layoutManager;
        }
    }

    public function render($layout, $path, $params = []) {
        extract($params);
        unset($params);
        ob_start();
        require $_SERVER["DOCUMENT_ROOT"]."/r3d/".$path;
        $content = ob_get_clean();
        $url = "/r3d/";
        require $_SERVER["DOCUMENT_ROOT"]."/r3d/layouts/".$layout.".php";
    }

    private static $layoutManager = null;
} 