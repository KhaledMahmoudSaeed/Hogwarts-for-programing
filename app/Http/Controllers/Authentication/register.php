<?php
// handel reigster logic
use App\Core\Database;
session_start();
session_unset();

$db = new Database();
$pdo = $db->getconnection();

$errors = [];

// some validation on request method and entered inputs
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars(strip_tags($_POST['name']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirmed_password = $_POST['confirm-password'];

    if (empty($name)) {
        $errors['name'] = "Name is required.";
    }

    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            $errors['email'] = "Email already exists.";
        }
    }

    if (empty($password)) {
        $errors['password'] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "Password must be at least 6 characters.";
    }

    if ($password !== $confirmed_password) {
        $errors['confirm-password'] = "Passwords do not match.";
    }

    if (empty($errors)) {
        $role = 'student';
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $house_id = $pdo->query("SELECT id FROM houses ORDER BY RANDOM() LIMIT 1")->fetchColumn();
        $wand_id = $pdo->query("SELECT id FROM wands ORDER BY RANDOM() LIMIT 1")->fetchColumn();

        if (!$house_id || !$wand_id) {
            echo "Error: Could not fetch a house or wand. Check your houses and wands tables.";
            exit;
        }

        echo "Name: $name, Email: $email, House ID: $house_id, Wand ID: $wand_id<br>";

        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role, house_id, wand_id, created_at) 
        VALUES (?, ?, ?, ?, ?, ?, NOW())");

        if ($stmt->execute([$name, $email, $hashed_password, $role, $house_id, $wand_id])) {
            $_SESSION['new_user'] = true;
            $_SESSION['user_id'] = $pdo->lastInsertId();
            $_SESSION['house'] = $pdo->query("SELECT name FROM houses WHERE id = $house_id")->fetchColumn();
            // olivinder
            $wand_wood = $pdo->query("SELECT wood FROM wands WHERE id = $wand_id")->fetchColumn();
            $wand_core = $pdo->query("SELECT core FROM wands WHERE id = $wand_id")->fetchColumn();
            $_SESSION['wand'] = $wand_wood . ' with ' . $wand_core;
            echo "Registration successful. Redirecting to home page...<br>";
            header("Location: /");
            exit;
        } else {
            echo "Registration failed.";
        }
    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $_POST;
        header("Location: /register");
        exit;
    }
}

$_SESSION['errors'] = $errors;
$_SESSION['old'] = $_POST;
