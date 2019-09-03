<?php
namespace PapayaWithSugar;

class Entity {
    public function getConfig() {
        return [
            'table' => get_class($this)
        ];
    }
}