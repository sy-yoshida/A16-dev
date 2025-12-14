<?php

class DatabaseManager
{
    private PDO $dbh;
    private array $models = [];

    public function connectDatabase(): void
    {
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $database = "leakdetector";

        $this->dbh = new PDO("mysql:host={$hostname};dbname={$database}", $username, $password);
    }

    public function getModel(string $modelName)
    {
        if (!array_key_exists($modelName, $this->models)) {
            $this->models[$modelName] = new $modelName($this->dbh);
        }
        return $this->models[$modelName];
    }
}
