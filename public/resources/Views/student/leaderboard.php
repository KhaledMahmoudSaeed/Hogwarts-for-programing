<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hogwarts House Cup Leaderboard</title>
    <!-- Load Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="resources/assets/CSS/style.css">
</head>

<body>
    <section id="leaderboard">
        <h1><i class="fa-solid fa-trophy"></i> Hogwarts House Cup Leaderboard <i class="fa-solid fa-trophy"></i></h1>

        <div class="leaderboard">
            <?php
            // Get the highest points from the first house (assuming data is sorted)
            $highestPoints = !empty($data) ? $data[0]['points'] : 0;

            foreach ($data as $house) {
                $houseClass = strtolower($house['name']);
                $isFirstPlace = ($house['points'] === $highestPoints && $highestPoints > 0);

                echo '<div class="house ' . $houseClass . ' ' . ($isFirstPlace ? 'first-place' : '') . '">';
                echo '<div class="house-name">';
                echo '<img src="../../resources/assets/img/' . $houseClass . '.png" alt="' . $house['name'] . '" class="house-icon">';
                echo $house['name'];
                echo '</div>';
                echo '<div class="house-points">' . $house['points'];
                if ($isFirstPlace) {
                    echo ' <span class="trophy"><i class="fa-solid fa-trophy"></i></span>';
                }
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </section>
</body>
</html>