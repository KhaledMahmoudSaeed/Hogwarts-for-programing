<?php
$courses = $db->getAll("courses");

$path->view("/student/enrolls/create.php", $courses);