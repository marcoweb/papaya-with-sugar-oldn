<?php
namespace PapayaWithSugar;

class RequestHandler {
    protected $application;

    public function __construct(Application $application) {
        $this->application = $application;
    }

    public function view(array $parameters = []) {
        $className = str_replace([$this->application->getRequestHandlerNamespace(), '\\'], ['', '/'], get_class($this));
        $viewPath = '/public/views/' .
            strtolower(str_replace('\\', '/', substr(get_class($this), 0, strrpos(get_class($this), '\\'))));
        return $className;
    }
}