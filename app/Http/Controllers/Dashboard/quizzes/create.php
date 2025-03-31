<?php
$courses = $db->getAll("courses");
$path->view("dashboard/quizzes/create.php", $courses);