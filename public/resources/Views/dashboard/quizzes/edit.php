<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Quizz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: url('<?= $GLOBALS['img']->image("dashboardhogwarts.jpg") ?>') no-repeat center center fixed;
            background-size: cover;
        }

        .header-button {
            background: linear-gradient(to right, #1e3c2d, #2e7d32);
        }
    </style>
</head>

<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">

    <div class="bg-gray-500 bg-opacity-20 shadow-lg rounded-2xl p-6 w-96">
        <div class=" p-6 text-center">
            <h2 class="text-2xl text-black font-bold text-white">
                <i class="fas fa-user-edit mr-2"></i> Edit Profile
            </h2>
        </div>

        <form action="/dashboard/quizz/update" method="POST" class="space-y-4">
            <!-- Hidden Fields -->
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']); ?>">

            <!-- Question Field -->
            <div>
                <label class="block text-black font-semibold">Question:</label>
                <input type="text" name="question" value="<?= htmlspecialchars($data['question']); ?>"
                    class="w-full text-black px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"
                    required>
            </div>

            <!-- Correct Answer (Radio Buttons) -->
            <div>
                <label class="block text-black font-semibold">Correct Answer:</label>
                <div class="mt-2 flex items-center space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="correct_answer" value="true" class="form-radio text-amber-500"
                            <?= $data['correct_answer'] === 'true' ? 'checked' : ''; ?> required>
                        <span class="ml-2 text-white">True</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="correct_answer" value="false" class="form-radio text-amber-500"
                            <?= $data['correct_answer'] === 'false' ? 'checked' : ''; ?> required>
                        <span class="ml-2 text-white">False</span>
                    </label>
                </div>
            </div>

            <!-- Points Field -->
            <div>
                <label class="block text-black font-semibold">Points:</label>
                <input type="number" name="points" min="1" value="<?= htmlspecialchars($data['points']); ?>"
                    class="w-full text-black px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"
                    required>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full header-button text-gray-900 px-4 py-2 rounded-lg font-semibold hover:bg-amber-400 transition">
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