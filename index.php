<?php
session_start();

$newUser = (isset($_SESSION['new_user']) && $_SESSION['new_user'] === true);
$house = isset($_SESSION['house']) ? $_SESSION['house'] : "HOGWARTS";
$wand = isset($_SESSION['house']) ?? "";
$isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);

// If the user is new, clear the flag so the overlay shows only once
if ($newUser) {
    unset($_SESSION['new_user']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hogwarts</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/CSS/style.css">
</head>
<body>

<?php if ($newUser): ?>
    <!-- Overlay with Sorting Hat -->
    <div id="overlay" class="img">
        <img id="sortingHat" src="assets/img/sorting_hat.png" alt="Sorting Hat">
    </div>

    <!-- Pop-up Message -->
    <div id="popup" class="hidden">
        <p id="houseMessage">You have been sorted into <b><?php echo $house; ?></b>!</p>
        <button onclick="closePopup()">OK</button>
    </div>
<?php endif; ?>

<!-- Main Homepage Content -->
<?php require('Views/navbar.view.php'); ?>
<div id="homepage" class="<?php echo $newUser ? 'hidden' : ''; ?>">
    <h1>Welcome to Hogwarts!</h1>
    <p>Your magical journey begins here.</p>
    <?php print_r($_SESSION); ?>
</div>

<script>
    document.getElementById("sortingHat")?.addEventListener("click", function () {
        document.getElementById("popup").classList.remove("hidden");
    });

    function closePopup() {
        document.getElementById("popup").classList.add("hidden");
        document.getElementById("overlay").classList.add("hidden");
        document.getElementById("homepage").classList.remove("hidden");
    }
</script>

</body>
</html>
