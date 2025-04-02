<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Purchase</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #f3f4f6;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col items-center py-8">

    <div class="w-full max-w-3xl bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Create a New Purchase</h2>

        <form action="/dashboard/purchase/store" method="POST" class="space-y-4">

            <!-- Item Name -->
            <div>
                <label class="block text-gray-700 font-semibold">Item Name:</label>
                <input type="text" name="name" required
                    class="w-full mt-2 p-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <!-- Price -->
            <div>
                <label class="block text-gray-700 font-semibold">Price:</label>
                <input type="number" name="price" required
                    class="w-full mt-2 p-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <!-- Type Dropdown -->
            <div>
                <label class="block text-gray-700 font-semibold">Select Type:</label>
                <select name="type" required class="w-full mt-2 p-2 border rounded-md focus:ring focus:ring-blue-300">
                    <option value="">-- Choose Type --</option>
                    <option value="Broom">Broom</option>
                    <option value="Book">Book</option>
                    <option value="Potion">Potion</option>
                    <option value="Wand">Wand</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200">
                    ➕ Add Purchase
                </button>
            </div>
        </form>

        <!-- Back Button -->
        <div class="mt-4 text-center">
            <a href="/dashboard/purchases" class="text-gray-600 hover:underline">⬅ Back to Purchases</a>
        </div>
    </div>

</body>

</html>