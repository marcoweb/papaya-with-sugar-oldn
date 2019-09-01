<?php
namespace PapayaWithSugar;

class Application {
    private $requestHandlerNamespace = null;
    private $defaultUrl = null;

    public function setRequestHandlerNamespace(string $namespace) : void {
        $this->requestHandlerNamespace = $namespace;
    }

    public function getRequestHandlerNamespace() : string {
        return $this->requestHandlerNamespace;
    }
    
    public function setDefaultUrl(string $url) : void {
        $this->defaultUrl = $url;
    }

    public function getDefaultUrl() : string {
        return $this->defaultUrl;
    }

    private function parseUri(string $uri, array $info = []) : array {
        $className = $this->getRequestHandlerNamespace();
        foreach(explode('/', $uri) as $segment)
            $className .= '\\' . ucfirst($segment);
        return $className .= 'Handler';
        if(class_exists($className))
            return ['class' => $className, 'parameters' => $info];
        else {
            $info[] = substr($uri, strrpos($uri, '/') + 1);
            $uri = substr($uri, 0, strrpos($uri, '/'));
            return $this->parseUri($uri, $info);
        }
    }

    private function parseRequest() {
        $requestInfo = [
            'method' => strtolower($_SERVER['REQUEST_METHOD']),
            'uri' => (trim($_SERVER['REQUEST_URI'], '/') == '') ? $this->getDefaultUrl() : trim($_SERVER['REQUEST_URI'], '/') == ''
        ];
        $requestInfo['class'] = $this->parseUri($requestInfo['uri']);
        return $requestInfo;
    }

    public function run() {
        return $this->parseRequest();
    }
}