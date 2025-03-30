<?php

// this is the view page for index
session_start();

$newUser = (isset($_SESSION['new_user']) && $_SESSION['new_user'] === true);
$house = isset($_SESSION['house']) ? $_SESSION['house'] : "HOGWARTS";
$wand = isset($_SESSION['house']) ?? "";
$isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
$content = $_SERVER['REQUEST_URI'] === '/' ? 'home' : $_SERVER['REQUEST_URI'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hogwarts</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">
    <!-- for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="resources/assets/CSS/style.css">
</head>

<body>

    <?php if ($newUser): ?>
        <!-- Overlay with Sorting Hat -->
        <div id="overlay" class="img">
            <img id="sortingHat" src="../resources/assets/img/sorting_hat.png" alt="Sorting Hat">
        </div>

        <!-- Pop-up Message -->
        <div id="popup" class="hidden">
            <p id="houseMessage">You have been sorted into <b><?php echo $house; ?></b>!</p>
            <button onclick="closePopup()">OK</button>
        </div>
    <?php endif; ?>

    <!-- Main Homepage Content -->
    <?php require('resources/Views/layout/navbar.view.php'); ?>

    <?php require("pages/" . $content . ".view.php") ?>
    <!-- Magical Footer -->
    <?php require("resources/Views/layout/footer.view.php"); ?>

    <script>
        document.getElementById("sortingHat")?.addEventListener("click", function () {
            document.getElementById("popup").classList.remove("hidden");
        });

        function closePopup() {
            document.getElementById("popup").classList.add("hidden");
            document.getElementById("overlay").classList.add("hidden");
            document.getElementById("homepage").classList.remove("hidden");
            document.getElementsByClassName("navbar")[0].classList.remove("hidden");
            document.getElementsByClassName("magic-footer")[0].classList.remove("hidden");

        }
    </script>

</body>

</html>