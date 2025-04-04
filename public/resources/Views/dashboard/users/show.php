<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .profile-picture {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 3px solid #3b82f6;
        }

        .house-badge {
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .house-gryffindor {
            background-color: #b22222;
            color: white;
        }

        .house-slytherin {
            background-color: #1e5128;
            color: white;
        }

        .house-ravenclaw {
            background-color: #0e1a40;
            color: white;
        }

        .house-hufflepuff {
            background-color: #f5e042;
            color: #333;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white shadow-xl rounded-xl overflow-hidden w-full max-w-md">
        <!-- Header with blue gradient -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-500 p-6 text-center">
            <h2 class="text-2xl font-bold text-white">
                <i class="fas fa-user-circle mr-2"></i> User Profile
            </h2>
        </div>

        <div class="p-6">
            <?php foreach ($data as $user):
                $houseClass = "";
                $houseName = $user['hname'];
                if (strtolower($houseName) === 'gryffindor') {
                    $houseClass = "house-gryffindor";
                } elseif (strtolower($houseName) === 'slytherin') {
                    $houseClass = "house-slytherin";
                } elseif (strtolower($houseName) === 'ravenclaw') {
                    $houseClass = "house-ravenclaw";
                } elseif (strtolower($houseName) === 'hufflepuff') {
                    $houseClass = "house-hufflepuff";
                }
                ?>
                <div class="flex flex-col items-center mb-6">
                    <!-- Profile Picture -->
                    <?php if (!empty($user['img'])): ?>
                        <img src="<?= $GLOBALS['img']->image($user['img'], 'users'); ?>"
                            class="profile-picture rounded-full mb-4" alt="Profile Picture">
                    <?php else: ?>
                        <div class="profile-picture rounded-full bg-gray-200 flex items-center justify-center mb-4">
                            <i class="fas fa-user text-4xl text-gray-500"></i>
                        </div>
                    <?php endif; ?>

                    <!-- User Info -->
                    <div class="w-full space-y-4">
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600 font-medium"><i class="fas fa-user mr-2 text-blue-500"></i>
                                Name:</span>
                            <span class="text-gray-800 font-semibold"><?= htmlspecialchars($user['uname']) ?></span>
                        </div>

                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600 font-medium"><i class="fas fa-envelope mr-2 text-blue-500"></i>
                                Email:</span>
                            <span class="text-gray-800"><?= htmlspecialchars($user['email']) ?></span>
                        </div>

                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600 font-medium"><i class="fas fa-user-tag mr-2 text-blue-500"></i>
                                Role:</span>
                            <span class="text-gray-800">
                                <span
                                    class="<?= $user['role'] === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' ?> px-2 py-1 rounded-full text-xs">
                                    <?= htmlspecialchars($user['role']) ?>
                                </span>
                            </span>
                        </div>

                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600 font-medium"><i class="fas fa-home mr-2 text-blue-500"></i>
                                House:</span>
                            <span class="house-badge <?= $houseClass ?>"><?= htmlspecialchars($houseName) ?></span>
                        </div>

                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600 font-medium"><i class="fas fa-magic mr-2 text-blue-500"></i>
                                Wand:</span>
                            <span
                                class="text-gray-800 font-serif italic"><?= htmlspecialchars($user['wood'] . " & " . $user['core']) ?></span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between mt-6">
                    <button onclick="history.back()"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg font-medium transition flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Back
                    </button>

                    <form action="/dashboard/user/edit" method="POST" class="inline-block">
                        <input type="hidden" name="_method" value="GET">
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        <input type="hidden" name="name" value="<?= $user['uname'] ?>">
                        <input type="hidden" name="email" value="<?= $user['email'] ?>">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition flex items-center">
                            <i class="fas fa-edit mr-2"></i> Edit Profile
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>