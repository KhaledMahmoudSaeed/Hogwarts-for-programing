<?php

$data = [
    "string" => $_POST['question'],
    "number" => $_POST['points'],
];
$fn->validators($data);
if ($_SESSION['errors']) {
    $quizz = [
        "question" => $_POST['question'],
        "id" => $_POST['id'],
        "correct_answer" => $_POST['correct_answer'],
        "points" => $_POST['points'],
    ];
    $path->view("dashboard/quizzes/edit.php", $quizz);
    exit;
}
$db->update("quizzes", [
    "question" => $_POST['question'],
    "correct_answer" => $_POST['correct_answer'],
    "points" => $_POST['points'],
], $_POST['id']);

header("Location:/dashboard/quizzs");