<?php
namespace PapayaWithSugar;

class RequestHandler {
    public function view(array $parameters = []) {
        $viewPath = '/public/views/';
        return $viewPath;
    }
}