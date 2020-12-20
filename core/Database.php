<?php

namespace Core;

class Database{

    /**
     * Stockage de la connexion à la BDD
     *
     * @var PDO
     */
    protected $pdo;

    protected $statement;

    /**
     * Connexion à la BDD
     *
     * @return PDO
     */
    public function __construct()
    {
        try {
            require "Config/config.php";

            $this->host = $dbConfig["host"];
            $this->dbname = $dbConfig["dbname"];
            $this->dbuser = $dbConfig["dbuser"];
            $this->dbpass = $dbConfig["dbpass"];
            $this->pdo = new \PDO("mysql:host=$this->host;dbname=$this->dbname", $this->dbuser, $this->dbpass);
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    public function query($statement, $one = false)
    {
        $query = $this->pdo->query($statement);

        if($one){
            return $query->fetch(\PDO::FETCH_OBJ);
        } else {
            return $query->fetchAll(\PDO::FETCH_OBJ);
        }
    }

    public function prepare($statement, $data = array())
    {
        $prepare = $this->pdo->prepare($statement);
        $prepare->execute($data);
    }
}