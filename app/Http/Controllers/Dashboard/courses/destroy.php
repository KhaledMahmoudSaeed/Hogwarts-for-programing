<?php
$db->delete("courses", $_POST['id']);

header("Location: /dashboard/courses");