<?php

$pdo = $db->getconnection();
$valuse = "";

foreach ($_POST['answer'] as $question_id => $answer) {
    $valuse .= "(" . $question_id . "," . $_POST['user_id'] . "," . $answer . "),";
}
$valuse = substr($valuse, 0, -1);
$stmt = $pdo->prepare("INSERT INTO student_quizz (quizz_id,user_id,answer) VALUES $valuse");
$stmt->execute();
$db->update(
    'enrollments',
    [
        "quizz_finish" => "done"
    ],
    [
        'user_id' => $_POST['user_id'],
        'course_id' => $_POST['course_id']
    ]
);
header("Location:/enrolls");