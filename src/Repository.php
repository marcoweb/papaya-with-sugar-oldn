<?php
namespace PapayaWithSugar;

class Repository {
    protected $entityClassName;
    protected $dbconnection;

    public function findOne($object) {
        return [];
    }

    public function findAll() {
        return [];
    }

    public function save($object) {

    }

    public function saveMany($objectsArray) {

    }

    public function delete($object) {

    }

    public function deleteMany($arrayObjects) {
        
    }

    public function __construct(string $entityClassName, \PDO $dbConnection) {
        $this->entityClassName = $entityClassName;
        $this->dbConnection = $dbConnection;
    }
}