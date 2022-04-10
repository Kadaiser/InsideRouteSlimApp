<?php

namespace App\Domain\Database\Service;

use Slim\App;
use pdo;

/**
 * Service.
 */
final class MapDatabase
{

    private $host;
    private $user;
    private $pass;
    private $dbname;

    public function __construct(String $mapIdentifier = "")
    {
        $dbParams = require_once '../config/access.php';
        $this->host = $dbParams['host'];
        $this->user = $dbParams['user'];
        $this->pass = $dbParams['pass'];
        $this->dbname = $dbParams['dbname'];
    }

    public function connect(){
        $conn_str = "mysql:host=$this->host;dbname=$this->dbname";
        $conn = new PDO($conn_str, $this->user, $this->pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }

    
}