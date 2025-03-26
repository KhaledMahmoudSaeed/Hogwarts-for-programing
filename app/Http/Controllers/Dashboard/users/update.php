<?php
$db->update("users", [
    'name' => $_POST['name'],
    'email' => $_POST['email'],
], $_POST['id']);

header("Location: /dashboard/users");