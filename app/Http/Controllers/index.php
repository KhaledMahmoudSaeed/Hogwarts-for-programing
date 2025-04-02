<?php
if ($_SERVER['REQUEST_URI'] === '/') {
    $_SERVER['REQUEST_URI'] = "home";
}
require $path->view_path("index.php");

