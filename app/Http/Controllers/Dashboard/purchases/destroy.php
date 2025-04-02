<?php
$db->delete("magical_items", $_POST['id']);

header("Location: /dashboard/purchases");