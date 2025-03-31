<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create quizz</title>
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
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Create a New quizz</h2>

        <form action="/dashboard/quizz/store" method="POST" class="space-y-4">

            <!-- Course Dropdown -->
            <div>
                <label class="block text-gray-700 font-semibold">Select Course:</label>
                <select name="course_id" required
                    class="w-full mt-2 p-2 border rounded-md focus:ring focus:ring-blue-300">
                    <option value="">-- Choose Course --</option>
                    <?php foreach ($data as $course): ?>
                        <option value="<?= htmlspecialchars($course['id']); ?>">
                            <?= htmlspecialchars($course['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Question Field -->
            <div>
                <label class="block text-gray-700 font-semibold">Question:</label>
                <input type="text" name="question" required
                    class="w-full mt-2 p-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <!-- Correct Answer -->
            <div>
                <label class="block text-gray-700 font-semibold">Correct Answer:</label>
                <div class="mt-2">
                    <label class="inline-flex items-center">
                        <input type="radio" name="correct_answer" value="true" required
                            class="form-radio text-blue-500">
                        <span class="ml-2">True</span>
                    </label>
                    <label class="inline-flex items-center ml-4">
                        <input type="radio" name="correct_answer" value="false" required
                            class="form-radio text-red-500">
                        <span class="ml-2">False</span>
                    </label>
                </div>
            </div>

            <!-- Quiz Points Field -->
            <div>
                <label class="block text-gray-700 font-semibold">Points:</label>
                <input type="number" name="points" min="1" required
                    class="w-full mt-2 p-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200">
                    ➕ Add Quiz
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