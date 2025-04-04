<?php

// there is another trigger responsible for add earned points from quizzes to house points
$leaderboard = $db->getAll("houses");
usort($leaderboard, function ($a, $b) {
    return $b['points'] - $a['points'];
});

$path->view("student/leaderboard.php", $leaderboard);
