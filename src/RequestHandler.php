<?php
namespace PapayaWithSugar;

class RequestHandler {
    public function view(array $parameters = []) {
        $viewPath = '/public/views/' . get_class($this);
        return $viewPath;
    }
}