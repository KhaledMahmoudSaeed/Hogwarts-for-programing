<?php
// Only allow access if the user is registered (has a wand name set)

if (!isset($_SESSION['new_user'])) {

    header("Location: /");
    exit;
}

$wand_name = $_SESSION['wand'];
// Unset the flag so that Ollivander’s Store (popup) appears only once
unset($_SESSION['new_user']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Ollivander's Wand Shop</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="resources/assets/CSS/style.css" />
</head>

<body>
    <div class="wand">
        <div class="wand-container">
            <h1>Ollivander's Wand Shop</h1>
            <p>"The wand chooses the wizard, remember..."</p>
            <button class="reveal-btn" onclick="showPopup()">Reveal Your Wand</button>
        </div>
    </div>

    <!-- Popup overlay -->
    <div id="popup" class="hidden">
        <h2>Your Wand</h2>
        <p><?= htmlspecialchars($wand_name) ?></p>
        <button class="ok-btn" onclick="closePopup()">OK</button>
    </div>

    <script>
        function showPopup() {
            document.getElementById("popup").classList.remove("hidden");
        }
        function closePopup() {
            document.getElementById("popup").classList.add("hidden");
            window.location.href = "/"; // Redirect back to index
        }
    </script>
</body>

</html>