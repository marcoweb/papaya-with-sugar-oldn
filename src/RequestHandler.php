<?php
namespace PapayaWithSugar;

class RequestHandler {
    protected $application;

    public function __construct(Application $application) {
        $this->application = $application;
    }

    public function view(array $parameters = []) {
        $className = strtolower(str_replace([$this->application->getRequestHandlerNamespace(), '\\', 'Handler'], ['', '/', ''], get_class($this)));
        $viewPath = '/public/views/';
        return $className;
    }
}