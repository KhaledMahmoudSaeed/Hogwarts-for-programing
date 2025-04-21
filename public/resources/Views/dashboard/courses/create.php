<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Course</title>
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
        <div class=" p-6 text-center">
            <h2 class="text-4xl font-bold  text-black">
                <i class="fas fa-user-circle mr-2"></i> Create a course
            </h2>
        </div>
        <form action="/dashboard/course/store" method="POST" enctype="multipart/form-data" class="space-y-4">

            <!-- Course Name -->
            <div>
                <label class="block text-black font-semibold">Course Name:</label>
                <input type="text" name="name" required
                    class="w-full mt-2 p-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <!-- Description -->
            <div>
                <label class="block text-black font-semibold">Description:</label>
                <textarea name="description" required rows="3"
                    class="w-full mt-2 p-2 border rounded-md focus:ring focus:ring-blue-300"></textarea>
            </div>

            <!-- Professor Dropdown -->
            <div>
                <label class="block text-black font-semibold">Select Professor:</label>
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
                <label class="block text-black font-semibold">Course Image:</label>
                <input type="file" name="img" accept="image/*"
                    class="w-full mt-2 p-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="hogwarts-button hover:bg-gold px-4 py-2 rounded-lg shadow-md transition flex items-center whitespace-nowrap">
                    <i class="fas fa-plus mr-2"></i> Add New Course
                </button>
            </div>
        </form>

        <!-- Back Button -->
        <div class="mt-4 text-center">
            <a href="/dashboard/courses" class="text-green hh button"> Back to Courses</a>
        </div>
    </div>

</body>

</html>