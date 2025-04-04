<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data[0]['uname'] ?>'s Profile</title>
    <!-- Load Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Define CSS variables first */
        :root {
            --light: #f8f9fa;
            --dark: #212529;
            --primary: #4e73df;
            --light-gray: #e9ecef;
            /* House colors - adjust as needed */
            --gryffindor: #740001;
            --slytherin: #1a472a;
            --ravenclaw: #0e1a40;
            --hufflepuff: #ecb939;
            --hogwarts: #5d5d5d;
        }

        body {
            font-family: 'Cinzel', serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        /* Profile Page Styles */
        .profile-container {
            max-width: 800px;
            margin: 2rem auto;
            background: #ffffff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            padding: 2rem;
            text-align: center;
            color: white;
            position: relative;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin: 0 auto 1rem;
            border: 5px solid white;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .house-badge {
            display: inline-block;
            padding: 0.3rem 1rem;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            font-weight: bold;
            margin-top: 0.5rem;
        }

        .profile-details {
            padding: 2rem;
        }

        .detail-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .detail-card h2 {
            color: #4e73df;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .profile-wand {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .wand-details {
            display: flex;
            gap: 2rem;
            margin-top: 1rem;
        }

        .wand-property {
            flex: 1;
        }

        .wand-label {
            display: block;
            font-weight: bold;
            color: #212529;
            margin-bottom: 0.3rem;
        }

        .wand-value {
            display: block;
            padding: 0.5rem;
            background: #e9ecef;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <div class="profile-container">
        <div class="profile-header" style="background-color: var(--<?= strtolower($data[0]['hname']) ?>);">
            <div class="profile-image">
                <img src="<?= $GLOBALS['img']->image($data[0]['img'], "users") ?>" alt="Profile Picture">
            </div>
            <h1><?= $data[0]['uname'] ?></h1>
            <p class="house-badge"><?= $data[0]['hname'] ?></p>
        </div>

        <div class="profile-details">
            <div class="detail-card">
                <h2><i class="fas fa-envelope"></i> Email</h2>
                <p><?= $data[0]['email'] ?></p>
            </div>
            <div class="detail-card">
                <h2><i class="fas fa-envelope"></i> Money</h2>
                <p><?= $data[0]['money'] ?></p>
            </div>

            <div class="profile-wand">
                <h2><i class="fas fa-magic"></i> Wand</h2>
                <div class="wand-details">
                    <div class="wand-property">
                        <span class="wand-label">Wood:</span>
                        <span class="wand-value"><?= $data[0]['wood'] ?></span>
                    </div>
                    <div class="wand-property">
                        <span class="wand-label">Core:</span>
                        <span class="wand-value"><?= $data[0]['core'] ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>