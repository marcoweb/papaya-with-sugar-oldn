<?php
namespace PapayaWithSugar;

class Application {
    private $requestHandlerNamespace = null;
    private $defaultUrl = null;

    public function setRequestHandlerNamespace(string $namespace) : void {
        $this->requestHandlerNamespace = $namespace;
    }
    
    public function setDefaultUrl(string $url) : void {
        $this->defaultUrl = $url;
    }

    public function getDefaultUrl() : string {
        return $this->defaultUrl;
    }

    private function parseRequest() {
        $requestInfo = [
            'method' => strtolower($_SERVER['REQUEST_METHOD']),
            'uri' => function() {
                $uri = trim($_SERVER['REQUEST_URI'], '/');
                if($uri == '')
                    $uri = $this->getDefaultUrl();
                return $uri;
            }
        ];
        return $requestInfo;
    }

    public function run() {
        return $this->parseRequest();
    }
}