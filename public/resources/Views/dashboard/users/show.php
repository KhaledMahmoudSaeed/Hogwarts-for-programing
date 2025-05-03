<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wizard Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700&display=swap" rel="stylesheet">

    <style>
        :root {
            --gryffindor: #8b0000;
            --slytherin: #1E7352;
            --ravenclaw: #113243;
            --hufflepuff: #CA8D0F;
        }

        body {
            font-family: 'Cinzel Decorative', cursive;
            background: url('<?= $GLOBALS['img']->image("dashboardhogwarts.jpg") ?>') no-repeat center center fixed;
            background-size: cover;
        }

        .magic-box {
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            backdrop-filter: blur(5px);
            border: 2px solid #ffd700;
            box-shadow: 0 0 20px #d4af37;
        }

        .gold-text {
            color: #d4af37;
        }

        .hogwarts-button {
            background: linear-gradient(to right, #b8860b, #f1c40f);
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            transition: transform 0.2s;
        }

        .hogwarts-button:hover {
            transform: scale(1.05);
        }

        .student {
            background: #d4b483;
            color: #333;
        }

        .professor {
            background: #a3b18a;
            color: #333;
        }

        .headmaster {
            background: #f8961e;
            color: #333;
        }

        .house-badge {
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .house-gryffindor {
            background-color: var(--gryffindor);
            color: #ffc500;
        }

        .house-slytherin {
            background-color: var(--slytherin);
            color: #c1ff72;
        }

        .house-ravenclaw {
            background-color: var(--ravenclaw);
            color: #8ab4f8;
        }

        .house-hufflepuff {
            background-color: var(--hufflepuff);
            color: #3b3b3b;
        }

        .profile-picture {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 3px solid #d4af37;
            box-shadow: 0 0 10px #f9e79f;
        }

        .profile-picture:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(218, 165, 32, 0.8);
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-6 text-white">
    <div class="magic-box rounded-xl shadow-lg overflow-hidden w-full max-w-md">
        <div class="text-center p-6 bg-gradient-to-r from-yellow-700 to-yellow-500">
            <h2 class="text-3xl font-bold text-white">
                <i class="fas fa-hat-wizard mr-2"></i> Wizard Profile
            </h2>
        </div>

        <div class="p-6">
            <?php foreach ($data as $user):
                $houseClass = '';
                $houseName = strtolower($user['hname']);
                $houseClass = match ($houseName) {
                    'gryffindor' => 'house-gryffindor',
                    'slytherin' => 'house-slytherin',
                    'ravenclaw' => 'house-ravenclaw',
                    'hufflepuff' => 'house-hufflepuff',
                    default => '',
                };
                ?>
                <div class="flex flex-col items-center mb-6">
                    <!-- Profile Picture -->
                    <?php if (!empty($user['img'])): ?>
                        <img src="<?= $GLOBALS['img']->image($user['img'], 'users'); ?>"
                            class="profile-picture rounded-full mb-4" alt="Wizard Image">
                    <?php else: ?>
                        <div class="profile-picture rounded-full bg-gray-700 flex items-center justify-center mb-4">
                            <i class="fas fa-user text-4xl text-gray-300"></i>
                        </div>
                    <?php endif; ?>

                    <!-- User Details -->
                    <div class="w-full space-y-3">
                        <div class="flex justify-between border-b border-yellow-600 pb-2">
                            <span><i class="fas fa-user gold-text mr-2"></i>Name:</span>
                            <span><?= htmlspecialchars($user['uname']) ?></span>
                        </div>

                        <div class="flex justify-between border-b border-yellow-600 pb-2">
                            <span><i class="fas fa-envelope gold-text mr-2"></i>Owl Mail:</span>
                            <span><?= htmlspecialchars($user['email']) ?></span>
                        </div>

                        <div class="flex justify-between border-b border-yellow-600 pb-2">
                            <span><i class="fas fa-user-tag gold-text mr-2"></i>Status:</span>
                            <span>
                                <span class="px-2 py-1 rounded-full text-xs <?= strtolower($user['role']) ?>">
                                    <?= htmlspecialchars($user['role']) ?>
                                </span>
                            </span>
                        </div>

                        <div class="flex justify-between border-b border-yellow-600 pb-2">
                            <span><i class="fas fa-shield-alt gold-text mr-2"></i>House:</span>
                            <span class="house-badge <?= $houseClass ?>"><?= ucfirst($houseName) ?></span>
                        </div>

                        <div class="flex justify-between border-b border-yellow-600 pb-2">
                            <span><i class="fas fa-wand-sparkles gold-text mr-2"></i>Wand:</span>
                            <span><em><?= htmlspecialchars($user['wood'] . " & " . $user['core']) ?></em></span>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between items-center mt-6">
                    <button class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                        <a href="/dashboard/users"><i class="fas fa-arrow-left mr-1"></i> Back</a>
                    </button>

                    <?php if (strtolower($_SESSION['role']) === 'headmaster' && strtolower($user['role']) === 'student'): ?>
                        <form action="/dashboard/user/promote" method="POST">
                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                            <button type="submit" class="hogwarts-button px-4 py-2 rounded-lg flex items-center">
                                <i class="fas fa-hat-wizard mr-2"></i> Appoint as Professor
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>