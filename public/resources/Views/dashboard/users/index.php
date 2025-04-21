<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - Users Table</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: url('<?= $GLOBALS['img']->image("dashboardhogwarts.jpg") ?>') no-repeat center center fixed;
            background-size: cover;
        }

        thead {
            background: linear-gradient(to right, #1e3c2d, #2e7d32);
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

        .user-avatar {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
        }

        .wand-info {
            font-family: 'Times New Roman', serif;
            font-style: italic;
        }

        .hogwarts-button:hover {
            background: linear-gradient(to right, #daa520, #b8860b);
        }

        .hogwarts-button {
            background: linear-gradient(to right, #b8860b, #daa520);
            /* Gold gradient */
            color: #fff;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="min-h-screen flex flex-col items-center py-8">
    <div class="w-full max-w-6xl px-4">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-black">
                <i class="fas fa-users mr-3 text-blue-500"></i>Users Management
            </h1>
            <div class="flex justify-between mb-4">
                <a href="/dashboard"
                    class="hogwarts-button hover:bg-gold px-4 py-2 rounded-lg shadow-md transition flex items-center whitespace-nowrap">
                    Back to Dashboard
                </a>

            </div>
        </div>

        <div class="bg-white bg-opacity-20 rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="">
                        <tr>
                            <th class="py-3 px-6 text-left text-white font-semibold">ID</th>
                            <th class="py-3 px-6 text-left text-white font-semibold">Image</th>
                            <th class="py-3 px-6 text-left text-white font-semibold">Name</th>
                            <th class="py-3 px-6 text-left text-white font-semibold">Email</th>
                            <th class="py-3 px-6 text-left text-white font-semibold">Role</th>
                            <th class="py-3 px-6 text-left text-white font-semibold">House</th>
                            <th class="py-3 px-6 text-left text-white font-semibold">Wand</th>
                            <th class="py-3 px-6 text-left text-white font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-500 bg-opacity-20 divide-y divide-gray-200">
                        <?php if (!empty($data)):
                            $counter = 1 ?>
                            <?php foreach ($data as $user): ?>
                                <?php
                                $houseName = $user['hname'];
                                $houseClass = "";
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
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="py-4 px-6"><?= htmlspecialchars($counter++); ?></td>
                                    <td class="py-4 px-6">
                                        <?php if (!empty($user['img'])): ?>
                                            <img src="<?= $GLOBALS['img']->image($user['img'], 'users'); ?>" class="user-avatar"
                                                alt="<?= htmlspecialchars($user['uname']); ?>">
                                        <?php else: ?>
                                            <div class="user-avatar bg-gray-200 flex items-center justify-center">
                                                <i class="fas fa-user text-gray-500"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="py-4 px-6 font-medium"><?= htmlspecialchars($user['uname']); ?></td>
                                    <td class="py-4 px-6"><?= htmlspecialchars($user['email']); ?></td>
                                    <td class="py-4 px-6">
                                        <span
                                            class="px-2 py-1 rounded-full text-xs 
                                        <?= $user['role'] === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' ?>">
                                            <?= htmlspecialchars($user['role']); ?>
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 <?= $houseClass ?> font-semibold rounded">
                                        <?= htmlspecialchars($houseName); ?>
                                    </td>
                                    <td class="py-4 px-6 wand-info">
                                        <?= htmlspecialchars($user['wood'] . ' & ' . $user['core']); ?>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex space-x-3">
                                            <!-- Show Icon -->
                                            <a href="/dashboard/user?id=<?= $user['id']; ?>"
                                                class="text-blue-500 hover:text-blue-700" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <!-- Update Icon -->
                                            <form action="/dashboard/user/edit" method="POST" class="inline-block">
                                                <input type="hidden" name="_method" value="GET">
                                                <input type="hidden" name="id" value="<?= $user['id']; ?>">
                                                <input type="hidden" name="name" value="<?= $user['uname']; ?>">
                                                <input type="hidden" name="email" value="<?= $user['email']; ?>">
                                                <input type="hidden" name="img" value="<?= $user['img']; ?>">
                                                <button type="submit" class="text-green-500 hover:text-green-700" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </form>

                                            <!-- Delete Icon -->
                                            <form action="/dashboard/user/delete" method="POST" class="inline-block">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="id" value="<?= $user['id']; ?>">
                                                <input type="hidden" name="img" value="<?= $user['img']; ?>">
                                                <button type="submit" class="text-red-500 hover:text-red-700" title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="py-6 px-6 text-center text-gray-500">
                                    <i class="fas fa-user-slash text-3xl mb-2"></i>
                                    <p class="text-lg">No users found</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
</body>

</html>