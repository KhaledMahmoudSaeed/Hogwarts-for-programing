<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - Users Table</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #f3f4f6;
            /* Light gray background */
        }
    </style>
</head>

<body class="min-h-screen flex flex-col items-center py-8">
    <div class="w-full max-w-6xl px-4">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">
            Dashboard - Users
        </h1>
        <div class="overflow-x-auto shadow-lg rounded-lg">
            <table class="min-w-full bg-white">
                <thead class="bg-blue-500">
                    <tr>
                        <th class="py-3 px-6 text-left text-white font-semibold">ID</th>
                        <th class="py-3 px-6 text-left text-white font-semibold">Name</th>
                        <th class="py-3 px-6 text-left text-white font-semibold">Email</th>
                        <th class="py-3 px-6 text-left text-white font-semibold">Role</th>
                        <th class="py-3 px-6 text-left text-white font-semibold">House</th>
                        <th class="py-3 px-6 text-left text-white font-semibold">Wand</th>
                        <th class="py-3 px-6 text-left text-white font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <?php if (!empty($data)):
                        $counter = 1 ?>
                        <?php foreach ($data as $user): ?>
                            <?php
                            $houseName = $user['hname'];
                            $cellColor = "";
                            if (strtolower($houseName) === 'gryffindor') {
                                $cellColor = "#b22222";
                            } elseif (strtolower($houseName) === 'slytherin') {
                                $cellColor = "#1e5128";
                            } elseif (strtolower($houseName) === 'ravenclaw') {
                                $cellColor = "#0e1a40";
                            } elseif (strtolower($houseName) === 'hufflepuff') {
                                $cellColor = "#f5e042";
                            }
                            ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-100 transition-opacity duration-200">
                                <td class="py-4 px-6"><?= htmlspecialchars($counter++); ?></td>
                                <td class="py-4 px-6"><?= htmlspecialchars($user['uname']); ?></td>
                                <td class="py-4 px-6"><?= htmlspecialchars($user['email']); ?></td>
                                <td class="py-4 px-6"><?= htmlspecialchars($user['role']); ?></td>
                                <td class="py-4 px-6" style="background-color: <?= htmlspecialchars($cellColor); ?>;">
                                    <?= htmlspecialchars($houseName); ?>
                                </td>
                                <td class="py-4 px-6"><?= htmlspecialchars($user['wood'] . $user['core']); ?></td>
                                <td class="py-4 px-6 flex space-x-2">
                                    <!-- Show Icon -->
                                    <a href="/dashboard/user?id=<?= $user['id']; ?>" class="text-blue-500 hover:text-blue-700">
                                        &#128065; <!-- Eye Icon -->
                                    </a>

                                    <!-- Update Form -->
                                    <form action="/dashboard/user/edit" method="POST" class="inline-block">
                                        <input type="hidden" name="_method" value="GET">
                                        <input type="hidden" name="id" value="<?= $user['id']; ?>">
                                        <input type="hidden" name="name" value="<?= $user['uname']; ?>">
                                        <input type="hidden" name="email" value="<?= $user['email']; ?>">
                                        <button type="submit" class="text-green-500 hover:text-green-700">
                                            &#9998; <!-- Pencil Icon -->
                                        </button>
                                    </form>

                                    <!-- Delete Form -->
                                    <form action="/dashboard/user/delete" method="POST" class="inline-block">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            &#10060; <!-- Cross Mark Icon -->
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="py-4 px-6 text-center">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>