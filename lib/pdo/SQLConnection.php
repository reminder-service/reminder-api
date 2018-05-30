<?php

abstract class SQLConnection {

    protected $database;

    abstract protected function connect();

    private function database() {
        if ($this->database === null) {
            $this->connect();
        }

        return $this->database;
    }

    public function query() {
        if (func_num_args() < 1) {
            throw new InvalidArgumentException("SQLConnection->query: Need at least one argument");
        }
        $parameters = func_get_args();
        $query = array_shift($parameters);

        if (!empty($parameters)) {
            $statement = $this->database()->prepare($query);
            $statement->execute($parameters);
        } else {
            $statement = $this->database()->query($query);
        }

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function execute() {
        if (func_num_args() < 1) {
            throw new InvalidArgumentException("SQLConnection->query: Need at least one argument");
        }
        $parameters = func_get_args();
        $query = array_shift($parameters);

        if (!empty($parameters)) {
            $statement = $this->database()->prepare($query);
            $statement->execute($parameters);
        } else {
            $statement = $this->database()->query($query);
        }
    }

    public function close() {
        $this->database = null;
    }

}