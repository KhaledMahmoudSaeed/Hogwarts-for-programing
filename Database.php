<?php
$host = "aws-0-eu-central-1.pooler.supabase.com";
$port = "6543";
$dbname = "postgres";
$user = "postgres.tahzvokrnzfbudmpexnl";
$password = "hogwatsForProgramming";
try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password, [
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
} catch (PDOException $e) {
    die("❌ Connection failed: " . $e->getMessage());
}
?>