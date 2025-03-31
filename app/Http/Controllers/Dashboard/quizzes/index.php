<?php
$quizzes = $db->getWithJoin(
    "quizzes",
    "course_id",
    "courses",
    "id",
    [
        "courses.name" => "cname",
        "quizzes.id" => "",
        "quizzes.question" => "",
        "quizzes.correct_answer" => "",
        "quizzes.points" => "",
    ]
);

$path->view("dashboard/quizzes/index.php", $quizzes);