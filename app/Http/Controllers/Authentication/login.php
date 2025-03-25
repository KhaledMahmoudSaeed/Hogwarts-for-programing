<?php
// handel the login logic
session_start();
use App\Core\Database;

$error = '';
$db = new Database();
$pdo = $db->getconnection();

// some validations
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    // create the SQL statment
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['house'] = $pdo->query("SELECT name FROM houses WHERE id = " . $user['house_id'])->fetchColumn();
        header("Location: /");
        exit;
    } else {
        $error = "Invalid email or password.";
    }
    
    $_SESSION['error'] = $error;
    $_SESSION['old_post'] = $_POST;
    header("location: /login");
}
