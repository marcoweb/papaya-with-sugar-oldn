<?php
namespace PapayaWithSugar;

class RequestHandler {
    protected $application;

    public function __construct(Application $application) {
        $this->application = $application;
    }

    public function view(array $parameters = []) {
        $viewPath = $_SERVER['DOCUMENT_ROOT'];
        $viewPath .= (substr($viewPath, strrpos($viewPath, DIRECTORY_SEPARATOR) + 1) == 'public') ? '/views' : '/public/views';
        $viewPath .= strtolower(str_replace([$this->application->getRequestHandlerNamespace(), '\\', 'Handler'], ['', DIRECTORY_SEPARATOR, ''], get_class($this))) . '.php';
        return (file_exists($viewPath)) ? 'Existe' : 'Não';
    }
}