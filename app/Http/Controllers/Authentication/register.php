<?php
// handel reigster logic
use App\Core\Database;
use Firebase\JWT\JWT;
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

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        // grap the house_id,wand_id randomly 
        $house_id = $pdo->query("SELECT id FROM houses ORDER BY RANDOM() LIMIT 1")->fetchColumn();
        $wand_id = $pdo->query("SELECT id FROM wands ORDER BY RANDOM() LIMIT 1")->fetchColumn();

        if (!$house_id || !$wand_id) {
            echo "Error: Could not fetch a house or wand. Check your houses and wands tables.";
            exit;
        }

        echo "Name: $name, Email: $email, House ID: $house_id, Wand ID: $wand_id<br>";
        // insert new user
        $db->insert("users", [
            "name" => $name,
            "email" => $email,
            "password" => $hashed_password,
            "house_id" => $house_id,
            "wand_id" => $wand_id
        ]);
        // get house name and wand data
        $house = $db->getOne("houses", $house_id)['name'];
        $wand = $db->getOne("wands", $wand_id);

        $wand = $wand['wood'] . ' with ' . $wand['core'];
        $_SESSION['new_user'] = true;
        // prepare payload for JWT token
        $payload = array(
            "id" => $pdo->lastInsertId(),
            "role" => "student",
            "house" => $house,
            "wand" => $wand,
            "iat" => time(),
            "exp" => time() + (7 * 3600),
        );
        $jwt = JWT::encode($payload, $_ENV['JWT_SECRET_KEY'], "HS256");
        /* set JWT token and img which depends on your house to session 
user1.png => gryffindor
user2.png => hufflepuff
user3.png => ravenclaw
user4.png => syltherin

this column data will be handel by trigger
        */
        $_SESSION['jwt'] = $jwt;
        $_SESSION['img'] = "user" . $house_id . ".png";
        $_SESSION['house'] = $house;
        $_SESSION['islogged'] = true;
        echo "Registration successful. Redirecting to home page...<br>";
        header("Location: /home");
        exit;
    } else {
        // handel errors
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $_POST;
        header("Location: /register");
        exit;
    }
}

$_SESSION['errors'] = $errors;
$_SESSION['old'] = $_POST;
