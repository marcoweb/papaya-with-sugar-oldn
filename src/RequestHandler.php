<?php
namespace PapayaWithSugar;

class RequestHandler {
    protected $application;

    public function __construct(Application $application) {
        $this->application = $application;
    }

    public function view(array $parameters = []) {
        $documentRoot = $_SERVER['DOCUMENT_ROOT'];
        $viewsRoot = $documentRoot . (substr($documentRoot, strrpos($documentRoot, DIRECTORY_SEPARATOR) + 1) == 'public') ? '/views' : '/public/views';
        $viewFile = $viewsRoot . strtolower(str_replace([$this->application->getRequestHandlerNamespace(), '\\', 'Handler'], ['', DIRECTORY_SEPARATOR, ''], get_class($this))) . '.php';
        // $viewPath = $_SERVER['DOCUMENT_ROOT'];
        // $viewPath .= (substr($viewPath, strrpos($viewPath, DIRECTORY_SEPARATOR) + 1) == 'public') ? '/views' : '/public/views';
        // $viewPath .= strtolower(str_replace([$this->application->getRequestHandlerNamespace(), '\\', 'Handler'], ['', DIRECTORY_SEPARATOR, ''], get_class($this))) . '.php';
        $view_content = '';
        $template = 'default';
        if(file_exists($viewFile)) {
            ob_start();
            include($viewFile);
            $view_content = ob_get_clean();
            $templateFile = $viewPath . '/_templates/' . $template . '.php';
        }
        return $view_content;
    }
}