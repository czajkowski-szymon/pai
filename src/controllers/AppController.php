<?php

class AppController {
    private $request;

    public function __construct() {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function isGet(): bool {
        $request = $_SERVER['REQUEST_METHOD'];
        return $request === 'GET';
    }

    protected function isPost(): bool {
        $request = $_SERVER['REQUEST_METHOD'];
        return $request === 'POST';
    }

    protected function render(string $template = null, array $variables = []) {
        $templatePath = 'views/'.$template.'.php';
        // TODO strona bledu
        $output = 'File not found';

        if (file_exists($templatePath)) {
            extract($variables);
            ob_start(); 
            include $templatePath;
            $output = ob_get_clean();
        }

        print $output;
    }
}