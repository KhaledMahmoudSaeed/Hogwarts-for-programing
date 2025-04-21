<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - Quizz Table</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: url('<?= $GLOBALS['img']->image("dashboardhogwarts.jpg") ?>') no-repeat center center fixed;
            background-size: cover;
        }

        thead {
            background: linear-gradient(to right, #1e3c2d, #2e7d32);
        }

        .hogwarts-button:hover {
            background: linear-gradient(to right, #daa520, #b8860b);
        }

        .hogwarts-button {
            background: linear-gradient(to right, #b8860b, #daa520);
            /* Gold gradient */
            color: #fff;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .action-btn {
            transition: all 0.2s ease;
            padding: 5px;
            border-radius: 4px;
        }

        .action-btn:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body class="min-h-screen flex flex-col items-center py-8">
    <div class="w-full max-w-6xl px-4">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">
            Dashboard - Quizz
        </h1>
        <div class="flex justify-between mb-4">
            <a href="/dashboard"
                class="hogwarts-button hover:bg-gold px-4 py-2 rounded-lg shadow-md transition flex items-center whitespace-nowrap">
                Back to Dashboard
            </a>
            <a href="/dashboard/quizz/create"
                class="hogwarts-button hover:bg-gold px-4 py-2 rounded-lg shadow-md transition flex items-center whitespace-nowrap">
                Add Quizz
            </a>
        </div>

        <div class="bg-white bg-opacity-20 rounded-xl shadow-md overflow-hidden border border-gray-100">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="py-3 px-6 text-left text-white font-semibold">ID</th>
                        <th class="py-3 px-6 text-left text-white font-semibold">Course Name</th>
                        <th class="py-3 px-6 text-left text-white font-semibold">Question</th>
                        <th class="py-3 px-6 text-left text-white font-semibold">Correct answer</th>
                        <th class="py-3 px-6 text-left text-white font-semibold">Points</th>
                        <th class="py-3 px-6 text-left text-white font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-500 bg-opacity-20 divide-y divide-gray-200">
                    <?php if (!empty($data)):
                        $counter = 1 ?>
                        <?php foreach ($data as $quizz):
                            ?>

                            <tr class="border-b border-gray-200 hover:bg-gray-100 transition-opacity duration-200">
                                <td class="py-4 px-6"><?= htmlspecialchars($counter++); ?></td>
                                <td class="py-4 px-6"><?= htmlspecialchars($quizz['cname']); ?></td>
                                <td class="py-4 px-6"><?= htmlspecialchars($quizz['question']); ?></td>
                                <td class="py-4 px-6"><?= htmlspecialchars($quizz['correct_answer']); ?></td>
                                <td class="py-4 px-6"><?= htmlspecialchars($quizz['points']); ?></td>
                                <td class="py-4 px-6 flex space-x-2">
                                    <!-- Update Form -->
                                    <form action="/dashboard/quizz/edit" method="POST" class="inline-block">
                                        <input type="hidden" name="_method" value="GET">
                                        <input type="hidden" name="id" value="<?= $quizz['id']; ?>">
                                        <input type="hidden" name="question" value="<?= $quizz['question']; ?>">
                                        <input type="hidden" name="correct_answer" value="<?= $quizz['correct_answer']; ?>">
                                        <input type="hidden" name="points" value="<?= $quizz['points']; ?>">
                                        <button type="submit" class="text-green-500 hover:text-green-700">
                                            &#9998; <!-- Pencil Icon -->
                                        </button>
                                    </form>

                                    <!-- Delete Form -->
                                    <form action="/dashboard/quizz/delete" method="POST" class="inline-block">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="id" value="<?php echo $quizz['id']; ?>">
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            &#10060; <!-- Cross Mark Icon -->
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="py-4 px-6 text-center">No quizz found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>