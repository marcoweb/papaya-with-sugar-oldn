<?php
namespace PapayaWithSugar;

class Application {
    private $requestHandlerNamespace = null;
    private $defaultUrl = null;
    private $applicationRoot = '/';
    private $config = [];

    public function getApplicationSystemPath() {
        return str_replace('/', DIRECTORY_SEPARATOR, ($_SERVER['DOCUMENT_ROOT'] . $this->applicationRoot));
    }

    public function getConfig() {
        return $this->config;
    }

    public function setApplicationRoot(string $url) {
        $this->applicationRoot = $url;
    }

    public function getApplicationRoot() {
        return $this->applicationRoot;
    }

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
        $className .= 'Handler';
        if(class_exists($className))
            return ['class' => $className, 'params' => $info];
        else {
            array_unshift($info, substr($uri, strrpos($uri, '/') + 1));
            $uri = substr($uri, 0, strrpos($uri, '/'));
            if($uri == '')
                return ['class' => null, 'params' => $info];
            else
                return $this->parseUri($uri, $info);
        }
    }

    private function parseRequest() {
        $requestInfo = [
            'method' => strtolower($_SERVER['REQUEST_METHOD']),
            'uri' => (trim($_SERVER['REQUEST_URI'], '/') == '') ? $this->getDefaultUrl() : trim($_SERVER['REQUEST_URI'], '/'),
            'class' => null,
            'parameters' => []
        ];
        $uriInfo = $this->parseUri($requestInfo['uri']);
        $requestInfo['class'] = $uriInfo['class'];
        if(!is_null($uriInfo['class'])) {
            $rf = new \ReflectionMethod($requestInfo['class'], $requestInfo['method']);
            $methodParameters = $rf->getParameters();
            for($i = 0;$i < count($methodParameters);$i++)
                $requestInfo['parameters'][$methodParameters[$i]->name] =isset($uriInfo['params'][$i]) ? $uriInfo['params'][$i] : null;
        }
        return $requestInfo;
    }

    public function run() {
        $request = $this->parseRequest();
        if(!is_null($request['class'])) {
            $handler = new $request['class']($this);
            return call_user_func_array([$handler, $request['method']], $request['parameters']);
        } else {
            http_response_code(404);
            die();
        }
    }
}