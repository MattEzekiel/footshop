<?php

namespace App;

class View
{
    public function render($view, $variables = [], $otraVariable = []) {
        extract($variables);

        ob_start();
        require_once __DIR__ . "/../views/$view.php";
        $content = ob_get_clean();
        require_once __DIR__ . "/../views/layouts/app.php";
    }
}