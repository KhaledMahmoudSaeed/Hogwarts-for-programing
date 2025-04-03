<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hogwarts House Cup Leaderboard</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            background-color: #0a0a1a;
            color: #f0e6d2;
            text-align: center;
            padding: 20px;
        }

        h1 {
            font-size: 2.5em;
            color: #d4af37;
            text-shadow: 2px 2px 4px #000;
            margin-bottom: 30px;
        }

        .leaderboard {
            max-width: 500px;
            margin: 0 auto;
            border: 3px solid #5d4a2a;
            border-radius: 10px;
            background: linear-gradient(135deg, #1a1a2e 0%, #2a2a4a 100%);
            box-shadow: 0 0 20px rgba(214, 175, 55, 0.3);
            overflow: hidden;
        }

        .house {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid #5d4a2a;
            transition: all 0.3s ease;
        }

        .house:hover {
            transform: scale(1.02);
            background: rgba(214, 175, 55, 0.1);
        }

        .house-name {
            font-size: 1.3em;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .house-points {
            font-size: 1.5em;
            color: #d4af37;
            font-weight: bold;
        }

        .house-icon {
            width: 30px;
            height: 30px;
            margin-right: 15px;
        }

        /* House Colors */
        .gryffindor {
            color: #ae0001;
        }

        .hufflepuff {
            color: #ffdb00;
        }

        .ravenclaw {
            color: #222f5b;
        }

        .slytherin {
            color: #2a623d;
        }

        /* Trophy for 1st place */
        .first-place {
            background: linear-gradient(135deg, rgba(214, 175, 55, 0.2) 0%, rgba(214, 175, 55, 0.1) 100%);
            border-left: 5px solid #d4af37;
        }

        .trophy {
            margin-left: 10px;
            color: #d4af37;
        }
    </style>
</head>

<body>
    <h1>🏆 Hogwarts House Cup Leaderboard 🏆</h1>

    <div class="leaderboard">
        <?php

        // Get the highest points from the first house (assuming data is sorted)
        $highestPoints = !empty($data) ? $data[0]['points'] : 0;

        foreach ($data as $house) {
            $houseClass = strtolower($house['name']);
            $isFirstPlace = ($house['points'] === $highestPoints && $highestPoints > 0);

            echo '<div class="house ' . ($isFirstPlace ? 'first-place' : '') . '">';
            echo '<div class="house-name ' . $houseClass . '">';
            echo '<img src="../../resources/assets/img/' . $houseClass . '-flag.png" alt="' . $house['name'] . '" class="house-icon">';
            echo $house['name'];
            echo '</div>';
            echo '<div class="house-points">' . $house['points'];

            // Only show trophy if it has the highest points and points > 0
            if ($isFirstPlace) {
                echo ' <span class="trophy">🏆</span>';
            }

            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</body>

</html>