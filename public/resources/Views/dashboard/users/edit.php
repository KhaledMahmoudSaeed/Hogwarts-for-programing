<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">

    <div class="bg-gray-800 shadow-lg rounded-2xl p-6 w-96">
        <h2 class="text-2xl font-bold text-amber-500 mb-4 text-center">Edit Profile</h2>

        <form action="/dashboard/users/update" method="POST" class="space-y-4">
            <!-- Name Field -->
            <div>
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="<?= htmlspecialchars($_POST['id']); ?>">
                <label class="block text-gray-400 font-semibold">Name:</label>
                <input type="text" name="name" value="<?= htmlspecialchars($_POST['name']); ?>"
                    class="w-full bg-gray-700 text-white px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"
                    required>
            </div>

            <!-- Email Field -->
            <div>
                <label class="block text-gray-400 font-semibold">Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($_POST['email']); ?>"
                    class="w-full bg-gray-700 text-white px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"
                    required>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-amber-500 text-gray-900 px-4 py-2 rounded-lg font-semibold hover:bg-amber-400 transition">
                Save Changes
            </button>

            <!-- Back Button -->
            <a href="javascript:history.back()"
                class="block text-center mt-3 bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-gray-500 transition">
                Back
            </a>
        </form>
    </div>

</body>

</html>