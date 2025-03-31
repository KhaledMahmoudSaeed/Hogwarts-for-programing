<?php

$db->update("quizzes", [
    "question" => $_POST['question'],
    "correct_answer" => $_POST['correct_answer'],
    "points" => $_POST['points'],
], $_POST['id']);

header("Location:/dashboard/quizzs");