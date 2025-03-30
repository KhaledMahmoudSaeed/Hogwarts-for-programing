<?php
$db->insert("courses", [
    "name" => $_POST['name'],
    "description" => $_POST['description'],
    "user_id" => $_POST['user_id'],
]);

header("Location:/dashboard/courses");