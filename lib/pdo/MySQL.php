<?php

require_once('SQLConnection.php');

class MySQL extends SQLConnection {
    private $username;
    private $password;
    private $host = 'localhost';
    private $databaseName;

    private function __construct($username, $password, $databaseName) {
        $this->username = $username;
        $this->password = $password;
        $this->databaseName = $databaseName;
        $this->database = null;
    }

    public static function build($username, $password, $databaseName) {
        return new self($username, $password, $databaseName);
    }

    public static function buildWithHost($username, $password, $databaseName, $host) {
        $instance = new self($username, $password, $databaseName);
        $instance->setHost($host);
        return $instance;
    }

    private function setHost($host) {
        $this->host = $host;
    }

    protected function connect() {
        $this->database = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->databaseName . ';charset=utf8', $this->username, $this->password);
        $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
}