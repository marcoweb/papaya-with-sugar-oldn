<?php
namespace PapayaWithSugar;

class RequestHandler {
    public function view(array $parameters = []) {
        $viewPath = '/public/views/' .
            strtolower(str_replace('\\', '/', substr(get_class($this), strpos(get_class($this), '\\') + 1, strrpos(get_class($this), '\\'))));
        return $viewPath;
    }
}