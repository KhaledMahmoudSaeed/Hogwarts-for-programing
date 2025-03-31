<?php
// use Helpers\Auth;
// session_start();
// $id = Auth::getAuthenticatedUser()['id'];
$course_id = $_GET['course_id'];
// $quizz_finish = $db->where("enrollments", "course_id=$course_id AND user_id=$id", [
//     "quizz_finish" => "",
// ]);
// foreach ($quizz_finish as $finish) {
//     $quizz_finish = $finish['quizz_finish'];
// }

// if ($quizz_finish === "done") {
//     $quizzes = ['none'];
$quizzes = $db->where("quizzes", "course_id=$course_id", [
    "id" => "",
    "question" => "",
    "points" => ""
]);



$path->view("student/quizzes/index.php", $quizzes);