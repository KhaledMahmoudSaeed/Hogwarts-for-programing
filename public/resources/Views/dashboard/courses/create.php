<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Course</title>
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
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Create a New Course</h2>

        <form action="/dashboard/course/store" method="POST" enctype="multipart/form-data" class="space-y-4">

            <!-- Course Name -->
            <div>
                <label class="block text-gray-700 font-semibold">Course Name:</label>
                <input type="text" name="name" required
                    class="w-full mt-2 p-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <!-- Description -->
            <div>
                <label class="block text-gray-700 font-semibold">Description:</label>
                <textarea name="description" required rows="3"
                    class="w-full mt-2 p-2 border rounded-md focus:ring focus:ring-blue-300"></textarea>
            </div>

            <!-- Professor Dropdown -->
            <div>
                <label class="block text-gray-700 font-semibold">Select Professor:</label>
                <select name="user_id" required
                    class="w-full mt-2 p-2 border rounded-md focus:ring focus:ring-blue-300">
                    <option value="">-- Choose Professor --</option>
                    <?php foreach ($data as $professor): ?>
                        <option value="<?= htmlspecialchars($professor['id']); ?>">
                            <?= htmlspecialchars($professor['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Course Image Upload -->
            <div>
                <label class="block text-gray-700 font-semibold">Course Image:</label>
                <input type="file" name="img" accept="image/*"
                    class="w-full mt-2 p-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200">
                    ➕ Add Course
                </button>
            </div>
        </form>

        <!-- Back Button -->
        <div class="mt-4 text-center">
            <a href="/dashboard/courses" class="text-gray-600 hover:underline">⬅ Back to Courses</a>
        </div>
    </div>

</body>

</html>