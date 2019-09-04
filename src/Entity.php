<?php
namespace PapayaWithSugar;

class Entity {
    public function __get($name) {
        $methodName = 'get'.ucfirst($name);
        if(method_exists($this, $methodName))
            return $this->$methodName();
    }

    public function __set($name, $value) {
        $methodName = 'set'.ucfirst($name);
        if(method_exists($this, $methodName))
            return $this->$methodName($value);
    }

    public static function getConfig() {
        return [
            'table' => strtolower(substr(get_class(__CLASS__), strrpos(get_class(__CLASS__), '\\') + 1))
        ];
    }
}