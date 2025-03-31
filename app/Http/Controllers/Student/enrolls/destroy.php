<?php
$db->delete("enrollments", $_POST['id']);

header("Location: /enrolls");