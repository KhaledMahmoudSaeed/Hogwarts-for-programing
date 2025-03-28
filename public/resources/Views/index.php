<?php

// this is the view page for index
session_start();

$newUser = (isset($_SESSION['new_user']) && $_SESSION['new_user'] === true);
$house = isset($_SESSION['house']) ? $_SESSION['house'] : "HOGWARTS";
$wand = isset($_SESSION['house']) ?? "";
$isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);


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
    <div id="homepage" class="<?php echo $newUser ? 'hidden' : ''; ?>">
        <!-- <h1>Welcome to Hogwarts!</h1>
        <p>Your magical journey begins here.</p>
        <?php print_r($_SESSION); ?> -->
        <!-- Hero Section -->
        <section id="hero" class="hero">
            <div class="hero-overlay">
                <h1>Welcome to Hogwarts</h1>
                <p>Where magic thrives and legends are born.</p>
                <button class="btn"><a href="#houses"><i class="fa-solid fa-circle-chevron-down"></i></a></button>
            </div>
        </section>

        <!-- Houses Section -->
        <section id="houses" class="houses">
            <h2>Our Houses</h2>
            <div class="house-container">
                <div class="house">
                    <img src="../resources/assets/img/gryffindor-flag.png" alt="Gryffindor">
                    <h3>Gryffindor</h3>
                    <p>Brave, daring, and chivalrous—Gryffindors value courage and determination.</p>
                </div>
                <div class="house">
                    <img src="../resources/assets/img/slytherin-flag.png" alt="Slytherin">
                    <h3>Slytherin</h3>
                    <p>Cunning, ambitious, and resourceful—Slytherins strive for greatness.</p>
                </div>
                <div class="house">
                    <img src="../resources/assets/img/ravenclaw-flag.png" alt="Ravenclaw">
                    <h3>Ravenclaw</h3>
                    <p>Wise, creative, and intellectual—Ravenclaws prize knowledge and wit.</p>
                </div>
                <div class="house">
                    <img src="../resources/assets/img/hufflepuff-flag.png" alt="Hufflepuff">
                    <h3>Hufflepuff</h3>
                    <p>Loyal, patient, and hardworking—Hufflepuffs value fairness and dedication.</p>
                </div>
            </div>
        </section>

        <!-- Activities Section -->
        <section id="activities" class="activities">
            <h2>Magical Activities</h2>
            <div class="activities-container">
                <div class="activity">
                    <h3>Quidditch</h3>
                    <p>Soar on broomsticks and cheer as the houses compete in the exhilarating sport of Quidditch.</p>
                </div>
                <div class="activity">
                    <h3>Triwizard Tournament</h3>
                    <p>Witness daring challenges and magical duels as champions from different schools prove their
                        mettle.</p>
                </div>
                <div class="activity">
                    <h3>Potions & Spells</h3>
                    <p>Explore the art of potion-making and spell-casting under the guidance of legendary professors.
                    </p>
                </div>
            </div>
        </section>
    </div>

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