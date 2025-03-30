<?php

$db->update("courses", [
    "name" => $_POST['name'],
    "description" => $_POST['description']
], $_POST['id']);

header("Location:/dashboard/courses");