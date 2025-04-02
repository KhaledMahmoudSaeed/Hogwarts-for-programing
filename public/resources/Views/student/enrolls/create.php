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
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Enroll in new course</h2>

        <form action="/enroll/store" method="POST" class="space-y-4">
            <input type="hidden" name="user_id" value="<?= end($data);
            array_pop($data) ?>">
            <!-- courses Dropdown -->
            <div>
                <label class="block text-gray-700 font-semibold">Select Course:</label>
                <select name="course_id" required
                    class="w-full mt-2 p-2 border rounded-md focus:ring focus:ring-blue-300">
                    <option value="">-- Choose Professor --</option>
                    <?php foreach ($data as $course): ?>
                        <option value="<?= htmlspecialchars($course['id']); ?>">
                            <?= htmlspecialchars($course['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
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