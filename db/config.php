<?php
class config{
    private $pdo = '';
    private $host = 'localhost';
    private $dbname = 'stitch';
    private $username = 'root';
    private $password = '';
    
    public function connDB()
    {
        try {
            $this->pdo = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password,
                [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
            );
        } catch (PDOException $pdoe) {
            die("Nuk mund të lidhej me bazën e të dhënave {$this->dbname} :" . $pdoe->getMessage());
        }

        return $this->pdo;
    }
    }
?>