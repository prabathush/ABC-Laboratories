<?php

class Database {
    private $host = "localhost";
    private $dbname = "abc laboratories";
    private $username = "root";
    private $password = "";

    private $dbh;
    private $error;
     // Prepare and execute SQL query
     public function query($sql) {
        return $this->dbh->query($sql);
    }

    // Bind values for prepared statements
    public function bind($param, $value, $type = null) {
        // Implementation of bind() method
    }

    // Execute the prepared statement
    public function execute() {
        // Implementation of execute() method
    }

    // Fetch all rows from the result set
    public function resultSet() {
        // Implementation of resultSet() method
    }

    // Fetch a single row from the result set
    public function single() {
        // Implementation of single() method
    }
    protected $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->username,
                $this->password
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}

?>
