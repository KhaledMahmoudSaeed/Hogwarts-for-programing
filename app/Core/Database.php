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
    private $allowed_tabels = [
        'users',
        'wands',
        'houses',
        'purchases',
        'quizzes',
        'magical_items',
        'enrollments',
        'courses',
        'student_quiz'
    ];
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
        } catch (\PDOException $e) {
            die("❌ Connection failed: " . $e->getMessage());
        }
    }
    public function getconnection()
    {
        return $this->pdo;
    }
    // check if entered tabel is exists in allowed list
    public function checkExitsTable(...$tabels)
    {
        foreach ($tabels as $table) {
            if (!in_array($table, $this->allowed_tabels)) {
                throw new \Exception("Invalid Table: $table");
            }
        }
    }
    public function getAll(string $tabelname)
    {
        $stmt = $this->pdo->query("SELECT * FROM \"$tabelname\" ORDER BY id ASC");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public function getOne(string $tabelname, int $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM \"$tabelname\" WHERE id=:id");

        $stmt->execute([":id" => $id]);
        $result = $stmt->fetch();
        return $result;

    }
    public function where(string $tabelname, string $condtion, array $selectors = [])
    {
        $this->checkExitsTable($tabelname);
        $selectString = $this->selectString($selectors);// build the selectString

        $stmt = $this->pdo->prepare("SELECT $selectString FROM \"$tabelname\" WHERE $condtion ");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    // Insert new record 
    public function insert(string $tableName, array $data = [])
    {
        $this->checkExitsTable($tableName);

        if (empty($data)) {
            throw new \Exception("No values provided for insertion");
        }

        $keys = array_keys($data);
        $columns = implode(', ', array_map(fn($key) => "\"$key\"", $keys)); // Wrap column names in quotes
        $placeholders = implode(', ', array_map(fn($key) => ":$key", $keys)); // Named placeholders

        $stmt = $this->pdo->prepare("INSERT INTO \"$tableName\" ($columns) VALUES ($placeholders);");

        // Execute with bound values
        $stmt->execute($data);
    }

    // Update new record 
    public function update(string $tableName, array $data, array|string $conditions)
    {
        $this->checkExitsTable($tableName);

        if (empty($data)) {
            throw new \Exception("No values provided for update");
        }
        if (empty($conditions)) {
            throw new \Exception("No conditions provided for update");
        }

        // Build SET clause dynamically
        $updateString = implode(', ', array_map(fn($key) => "\"$key\" = :$key", array_keys($data)));

        $params = $data;
        $whereClause = "";

        if (is_array($conditions)) {
            // Build WHERE clause dynamically
            $whereClause = implode(' AND ', array_map(fn($key) => "\"$key\" = :where_$key", array_keys($conditions)));

            // Rename parameters to avoid conflicts
            foreach ($conditions as $key => $value) {
                $params["where_$key"] = $value;
            }
        } else {
            // If conditions is a string, assume it's a primary key and build a WHERE clause
            if (is_numeric($conditions)) {
                $whereClause = "\"id\" = :where_id";
                $params["where_id"] = $conditions;
            } else {
                // If it's a manually written WHERE clause, use it directly (ensure it's safe)
                $whereClause = $conditions;
            }
        }

        // Prepare SQL statement
        $sql = "UPDATE \"$tableName\" SET $updateString WHERE $whereClause";
        $stmt = $this->pdo->prepare($sql);

        // Execute query with parameters
        $stmt->execute($params);
    }




    public function delete(string $tableName, int $id)
    {
        $this->checkExitsTable($tableName);
        if (empty($id)) {
            throw new \Exception("No values provided for dekete");
        }
        $stmt = $this->pdo->prepare("DELETE FROM \"$tableName\" WHERE \"id\"=:id ");
        $stmt->execute(["id" => $id]);
    }

    // returns $selectSrting after prepare it with what user enters its details such if thier any alias or not and what colums will be SELECTED
    // it only accept $selectors as a paramter which is an associative array contains all wanted colums and which of them will have alias 
    public function selectString(array $selectors)
    {
        if (!empty($selectors)) {
            $mapped_array = array_map(function ($column_name, $alias) {
                // add " " to all string to prevent sql injections
                $column_named = str_replace(".", '"."', $column_name);
                // check whether the user want an alias or default name for this column 
                return empty($alias) ? "\"$column_named\"" : "\"$column_named\" AS \"$alias\"";
            }, array_keys($selectors), array_values($selectors));
            return implode(',', $mapped_array);
        } else {
            return "*";
        }
    }
    // this method provide only one JOIN 
    public function getWithJoin(
        string $firstTable,
        string $firstSecondKey,
        string $secondTable,
        string $secondKey,
        array $selectors = []
    ) {
        // check if the entered tabels are exits or allowed in our DB
        $this->checkExitsTable($firstTable, $secondTable);
        // construct the foreign keys
        $keys = [
            'first' => "\"$firstTable\".\"$firstSecondKey\"",
            'second' => "\"$secondTable\".\"$secondKey\""
        ];
        $selectString = $this->selectString($selectors);// build the selectString

        $stmt = $this->pdo->prepare(
            "SELECT $selectString FROM \"$firstTable\"
        INNER JOIN \"$secondTable\" ON {$keys['first']} = {$keys['second']} ORDER BY id ASC"
        );

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    // this method provide two JOIN 
    public function getWith2Joins(
        string $firstTable,
        string $firstSecondKey,
        string $firstThirdKey,
        string $secondTable,
        string $secondKey,
        string $thirdTable,
        string $thirdKey,
        array $selectors = [],
        $condtion = null
    ) {
        // check if the entered tabels are exits or allowed in our DB
        $this->checkExitsTable($firstTable, $secondTable, $thirdTable);
        // construct the foreign keys
        $keys = [
            'first_second' => "\"$firstTable\".\"$firstSecondKey\"",
            'first_third' => "\"$firstTable\".\"$firstThirdKey\"",
            'second' => "\"$secondTable\".\"$secondKey\"",
            'third' => "\"$thirdTable\".\"$thirdKey\""
        ];

        $selectString = $this->selectString($selectors);// build the selectString
        $id = "\"$firstTable\".\"id\"";// to be more strict in order retrived data beacuse of using two JOIN it
        if ($condtion) {
            $co = " WHERE $condtion";
        } else {
            $co = "";
        }
        $stmt = $this->pdo->prepare(
            "SELECT $selectString FROM \"$firstTable\"
        INNER JOIN \"$secondTable\" ON {$keys['first_second']} = {$keys['second']}
        INNER JOIN \"$thirdTable\" ON {$keys['first_third']} = {$keys['third']} $co
        ORDER BY $id ASC "
        );
        // var_dump($stmt);
        // exit;
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
