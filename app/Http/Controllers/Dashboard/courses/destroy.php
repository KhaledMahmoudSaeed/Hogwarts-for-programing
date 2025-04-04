<?php
$db->delete("courses", $_POST['id']);
$fn->deleteImage("courses", $_POST['img']);

header("Location: /dashboard/courses");