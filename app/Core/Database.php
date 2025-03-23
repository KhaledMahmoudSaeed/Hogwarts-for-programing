<?php
namespace App\Core;
use PDO;
use Dotenv\Dotenv;

class Database
{

    private $host;
    private $port;
    private $dbname;
    private $user;
    private $password;
    private $pdo;
    public function __construct()
    {
        // collect connection string data from .env 
        $dotenv = Dotenv::createImmutable(
            __DIR__ . "/../../"
        );
        $dotenv->load();

        $this->host = $_ENV["DB_HOST"];
        $this->port = $_ENV["DB_PORT"];
        $this->dbname = $_ENV["DB_DATABASE"];
        $this->user = $_ENV["DB_USERNAME"];
        $this->password = $_ENV["DB_PASSWORD"];


        $dsn = "pgsql:host=$this->host;port=$this->port;dbname=$this->dbname";

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);

            // echo "✅ Connected successfully to Supabase PostgreSQL!";

            // Example Query
            // $stmt = $pdo->query("SELECT *  from houses");
            // $result = [$stmt->fetchAll()];
            // echo '<br>';
            // echo '<pre>';
            // print_r($result);
            // echo '</pre>';
        } catch (\PDOException $e) {
            die("❌ Connection failed: " . $e->getMessage());
        }
    }
    public function getconnection()
    {
        return $this->pdo;
    }
}
?>