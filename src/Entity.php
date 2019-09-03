<?php
namespace PapayaWithSugar;

class Entity {
    public function getConfig() {
        return [
            'table' => strtolower(substr(get_class($this), strrpos(get_class($this), '\\') + 1))
        ];
    }
}