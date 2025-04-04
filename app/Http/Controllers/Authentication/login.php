<?php
// handel the login logic
session_start();
use App\Core\Database;
use Firebase\JWT\JWT;
$error = '';
$db = new Database();

// some validations
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    // create the SQL statment
    $user = $db->where("users", "email='$email'");// return array of objects

    if ($user[0] && password_verify($password, $user[0]['password'])) {
        $id = $user[0]['id'];
        $role = $user[0]['role'];
        $img = $user[0]['img'];
        $house_id = $db->getOne("houses", $user[0]['house_id'])['name'];
        $payload = array(
            "id" => $id,
            "role" => $role,
            "house" => $house_id,

            "iat" => time(),
            "exp" => time() + (7 * 3600),
        );
        $jwt = JWT::encode($payload, $_ENV['JWT_SECRET_KEY'], "HS256");
        $_SESSION['jwt'] = $jwt;
        $_SESSION['img'] = $img;
        header("Location: /home");
        exit;
    } else {
        $error = "Invalid email or password.";
    }

    $_SESSION['error'] = $error;
    $_SESSION['old_post'] = $_POST;
    header("location: /login");
}
