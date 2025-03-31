<?php
$db->delete("quizzes", $_POST['id']);

header("Location: /dashboard/quizzs");