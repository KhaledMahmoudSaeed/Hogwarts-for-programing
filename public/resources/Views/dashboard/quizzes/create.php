<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create quizz</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: url('<?= $GLOBALS['img']->image("dashboardhogwarts.jpg") ?>') no-repeat center center fixed;
            background-size: cover;
        }

        .hogwarts-button {
            background: linear-gradient(to right, #b8860b, #daa520);
            /* Gold gradient */
            color: #fff;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }



        .hogwarts-button:hover {
            background: linear-gradient(to right, #daa520, #b8860b);
        }

        .hogwarts-table-header {
            background: linear-gradient(to right, #1e3c2d, #2e7d32);
            /* Emerald green */
        }

        .hh {
            background: linear-gradient(to right, #daa520, #b8860b);
            padding: 10px;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col items-center py-8">

    <div class="w-full max-w-3xl bg-opacity-20 bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-4xl font-bold  text-black">
            <i class="fas fa-user-circle mr-2"></i> Create a Quizz
        </h2>
        <form action="/dashboard/quizz/store" method="POST" class="space-y-4">

            <!-- Course Dropdown -->
            <div>
                <label class="block text-black font-semibold">Select Course:</label>
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
                <label class="block text-black font-semibold">Question:</label>
                <input type="text" name="question" required
                    class="w-full mt-2 p-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <!-- Correct Answer -->
            <div>
                <label class="block text-black font-semibold">Correct Answer:</label>
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
                <label class="block text-black font-semibold">Points:</label>
                <input type="number" name="points" min="1" required
                    class="w-full mt-2 p-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="hogwarts-button hover:bg-gold px-4 py-2 rounded-lg shadow-md transition flex items-center whitespace-nowrap">
                    <i class="fas fa-plus mr-2"></i> Add New Quizz
                </button>
            </div>

        </form>


        <!-- Back Button -->
        <div class="mt-4 text-center">
            <a href="/dashboard/quizzs" class="text-green hh button"> Back to Quizz</a>
        </div>
    </div>

</body>

</html>