<?php

//  destroy the session
session_unset();
session_destroy();

// Redirect to homepage or login page
header("Location: /home");
exit();
