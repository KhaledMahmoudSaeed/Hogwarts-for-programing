<?php
$db->insert("quizzes", [
    "course_id" => $_POST['course_id'],
    "question" => $_POST['question'],
    "correct_answer" => $_POST['correct_answer'],
    "points" => $_POST['points'],
]);

header("Location:/dashboard/quizzs");