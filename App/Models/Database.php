<?php
namespace Models;

class Database
{
    public string $dsn;
    public string $username;
    public string $password;

    public function __construct()
    {
        $this->dsn = "mysql:host=localhost;dbname=demo";
        $this->username = "root";
        $this->password = "200997";
    }

    /**
     * @return \PDO
     */
    function connect(): \PDO
    {
        try {
            return new \PDO($this->dsn,$this->username,$this->password);
        }catch (\PDOException $PDOException){
            echo $PDOException->getMessage();
            die();
        }
    }
}