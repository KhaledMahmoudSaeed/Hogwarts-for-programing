<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">

    <div class="bg-gray-800 shadow-lg rounded-2xl p-6 w-96 text-center">
        <h2 class="text-2xl font-bold text-amber-500 mb-4">User Profile</h2>

        <div class="space-y-4">
            <p><span class="font-semibold text-gray-400">Name:</span> <span
                    class="text-white"><?php echo htmlspecialchars($user['uname']); ?></span></p>
            <p><span class="font-semibold text-gray-400">Email:</span> <span
                    class="text-white"><?php echo htmlspecialchars($user['email']); ?></span></p>
            <p><span class="font-semibold text-gray-400">Role:</span> <span
                    class="text-white"><?php echo htmlspecialchars($user['role']); ?></span></p>
            <p><span class="font-semibold text-gray-400">House ID:</span> <span
                    class="text-white"><?php echo htmlspecialchars($user['hname']); ?></span></p>
            <p><span class="font-semibold text-gray-400">Wand ID:</span> <span
                    class="text-white"><?php echo htmlspecialchars($user['wood'] . " " . $user['core']); ?></span></p>
        </div>

        <!-- Back Button -->
        <button onclick="history.back()"
            class="mt-4 bg-green-700 text-white px-4 py-2 rounded-lg font-semibold hover:bg-gray-600 transition">
            Back
        </button>
        <button
            class="mt-6 bg-amber-500 text-gray-900 px-4 py-2 rounded-lg font-semibold hover:bg-amber-400 transition">
            Edit Profile
        </button>


    </div>

</body>

</html>