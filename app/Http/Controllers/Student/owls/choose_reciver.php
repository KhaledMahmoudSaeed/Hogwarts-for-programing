<?php

use Helpers\Auth;
$id = Auth::getAuthenticatedUser()['id'];
$path->view("student/owls/choose_reciver.php", ["id" => $id]);
