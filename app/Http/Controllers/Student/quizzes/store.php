<?php

$pdo = $db->getconnection();
$valuse = "";
$id = $_POST['user_id'];
foreach ($_POST['answer'] as $question_id => $answer) {
    $valuse .= "(" . $question_id . "," . $id . "," . $answer . "),";
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
        'user_id' => $id,
        'course_id' => $_POST['course_id']
    ]
);
$points = $pdo->prepare(
    "SELECT SUM(earned_points) from student_quizz WHERE user_id=:id "
);
$points->execute([
    ":id" => $id
]);
$points = $points->fetch();
$money = (int) ($points['sum'] / 3);
$stmt = $pdo->prepare(
    "UPDATE users SET money=money+:money WHERE id=:id"
);
$stmt->execute([
    ":money" => $money,
    ":id" => $id
]);

header("Location:/enrolls");