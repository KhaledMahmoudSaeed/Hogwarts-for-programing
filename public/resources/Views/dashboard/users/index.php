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
                        <th class="py-3 px-6 text-left text-white font-semibold">Name</th>
                        <th class="py-3 px-6 text-left text-white font-semibold">Email</th>
                        <th class="py-3 px-6 text-left text-white font-semibold">Role</th>
                        <th class="py-3 px-6 text-left text-white font-semibold">House</th>
                        <th class="py-3 px-6 text-left text-white font-semibold">Wand</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <?php if (!empty($users)): ?>
                        <?php $i = 0;
                        foreach ($users as $user):
                            // Determine cell color based on house name
                            $houseName = $house[$i]['name'];
                            $cellColor = "";
                            if (strtolower($houseName) === 'gryffindor') {
                                $cellColor = "#b22222"; // Red for Gryffindor
                            } elseif (strtolower($houseName) === 'slytherin') {
                                $cellColor = "#1e5128"; // Green for Slytherin
                            } elseif (strtolower($houseName) === 'ravenclaw') {
                                $cellColor = "#0e1a40"; // Blue for Ravenclaw
                            } elseif (strtolower($houseName) === 'hufflepuff') {
                                $cellColor = "#f5e042"; // Yellow for Hufflepuff
                            }
                            ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-100 transition-opacity duration-200">
                                <td class="py-4 px-6"><?php echo htmlspecialchars($user['name']); ?></td>
                                <td class="py-4 px-6"><?php echo htmlspecialchars($user['email']); ?></td>
                                <td class="py-4 px-6"><?php echo htmlspecialchars($user['role']); ?></td>
                                <td class="py-4 px-6" style="background-color: <?php echo htmlspecialchars($cellColor); ?>;">
                                    <?php echo htmlspecialchars($houseName); ?>
                                </td>
                                <td class="py-4 px-6">
                                    <?php echo htmlspecialchars($wand[$i]['wood']) . " " . htmlspecialchars($wand[$i]['core']); ?>
                                </td>
                            </tr>
                            <?php $i++; endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="py-4 px-6 text-center">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>