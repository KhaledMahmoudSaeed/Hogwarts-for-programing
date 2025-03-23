<?php
session_start();
require 'Database.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['house'] = $pdo->query("SELECT name FROM houses WHERE id = " . $user['house_id'])->fetchColumn();
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>
<?php
$_SESSION['error'] = $error;
$_SESSION['old_post'] = $_POST;
require('Views/auth.view.php');
?>