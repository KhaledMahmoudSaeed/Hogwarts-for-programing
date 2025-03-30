<?php
$professors = $db->where(
    "users",
    "role = 'professor'",
    [
        "id" => "id",
        "name" => 'name'
    ]
);
$path->view("/dashboard/courses/create.php", $professors);