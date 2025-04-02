<?php
$professors = $db->where(
    "users",
    "role = 'professor'",
    [
        "id" => "id",
        "name" => 'name'
    ]
);
$path->view("/dashboard/purchases/create.php", $professors);