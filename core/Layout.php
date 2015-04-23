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
        require $_SERVER["DOCUMENT_ROOT"]."/nastya/".$path;
        $content = ob_get_clean();
        $url = "/nastya/";
        require $_SERVER["DOCUMENT_ROOT"]."/nastya/layouts/".$layout.".php";
    }

    private static $layoutManager = null;
} 