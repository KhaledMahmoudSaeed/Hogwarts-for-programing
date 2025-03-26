<?php
$db->delete('users', $_POST['id']);

header("Location: /dashboard/users");