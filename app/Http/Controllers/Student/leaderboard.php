<?php
$leaderboard = $db->getAll("houses");
usort($leaderboard, function ($a, $b) {
    return $b['points'] - $a['points'];
});

$path->view("student/leaderboard.php", $leaderboard);
