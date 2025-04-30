<?php
// PAGINATION SETTINGS
$perPage = 10;
$currentPage = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
$totalQuizzes = count($data);
$totalPages = (int) ceil($totalQuizzes / $perPage);
$offset = ($currentPage - 1) * $perPage;

// SLICE DATA FOR CURRENT PAGE
$pageData = array_slice($data, $offset, $perPage);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hogwarts Quiz Dashboard</title>
    <!-- Tailwind & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Magical Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet" />
    <style>
        :root {
            --gryffindor: #8b0000;
            --gold: #daa520;
            --scroll: rgba(255, 248, 220, 0.8);
        }

        body {
            background: url('<?= $GLOBALS['img']->image("landing.png") ?>') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Cinzel', serif;
            color: #f0e6d2;
            min-height: 100vh;
            padding: 2rem;
        }

        .card {
            background: rgba(0, 0, 0, 0.3);
            border: 2px solid rgba(255, 215, 0, 0.3);
            backdrop-filter: blur(6px);
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 0 25px rgba(218, 165, 32, 0.5);
        }

        .hogwarts-button {
            background: linear-gradient(to right, #b8860b, #daa520);
            color: #1e1e1e;
            border: 2px solid #f0e68c;
            border-radius: .75rem;
            padding: .5rem 1rem;
            transition: all .3s ease;
        }

        .hogwarts-button:hover {
            background: linear-gradient(to right, #daa520, #b8860b);
            box-shadow: 0 0 12px #f0e68c;
        }

        .icon-btn {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, rgba(218, 165, 32, 0.6), rgba(218, 165, 32, 0.2));
            box-shadow: 0 0 8px rgba(218, 165, 32, 0.8), inset 0 0 4px rgba(255, 248, 220, 0.6);
            animation: float 4s ease-in-out infinite;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .icon-btn:hover {
            animation-play-state: paused;
            transform: translateY(-6px) scale(1.2) !important;
            box-shadow: 0 0 16px rgba(255, 215, 0, 1), inset 0 0 6px rgba(255, 248, 220, 0.8);
        }

        .icon-btn i {
            color: #fff;
            text-shadow: 0 0 4px rgba(255, 255, 255, 0.8);
            transition: transform .2s ease;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-4px);
            }
        }


        .icon-btn.icon-edit {
            background: radial-gradient(circle at 30% 30%,
                    rgba(102, 187, 106, 0.6),
                    rgba(102, 187, 106, 0.2));
        }

        .icon-btn.icon-delete {
            background: radial-gradient(circle at 30% 30%,
                    rgba(239, 83, 80, 0.6),
                    rgba(239, 83, 80, 0.2));
        }

        .description-cell {
            max-width: 250px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .empty-state {
            background: rgba(0, 0, 0, 0.2);
            border: 1px dashed #fff;
        }

        /* Magical Pagination */
        .pagination {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            margin-top: 2rem;
        }

        .pagination a {
            width: 2.5rem;
            height: 2.5rem;
            font-size: 1rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border: 2px solid #daa520;
            border-radius: 0.75rem;
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }

        .pagination a:hover:not(.disabled) {
            background: #ffd700;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
        }

        .pagination a.active {
            background: #daa520;
            color: #1e1e1e;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.5);
        }

        .pagination a.disabled {
            opacity: 0.4;
            pointer-events: none;
        }

        table thead {
            background: rgba(0, 0, 0, 0.8);
        }

        table th {
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 0.75rem 1rem;
            text-align: center;
        }

        table td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
        }
    </style>
</head>

<body class="flex flex-col items-center pt-10">
    <div class="w-full max-w-7xl px-6 card p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-4xl font-bold text-yellow-300 flex items-center"><i class="fas fa-scroll mr-2"></i>Hogwarts
                Quizz</h1>
            <div class="flex space-x-4 mt-4 sm:mt-0">
                <a href="/dashboard" class="hogwarts-button glow-hover flex items-center"><i
                        class="fas fa-undo mr-2"></i>Back to dashboard</a>
                <a href="/dashboard/quizz/create" class="hogwarts-button glow-hover flex items-center"><i
                        class="fas fa-plus mr-2"></i>Add Quiz</a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="py-3 px-5">#</th>
                        <th class="py-3 px-5">Course</th>
                        <th class="py-3 px-5">Question</th>
                        <th class="py-3 px-5">Answer</th>
                        <th class="py-3 px-5">Points</th>
                        <th class="py-3 px-5">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pageData)):
                        foreach ($pageData as $i => $quiz): ?>
                            <tr class="hover:bg-gray-700 hover:text-black transition-colors">
                                <td class="p-5"><?= $i + 1 ?></td>
                                <td class="p-5"><?= htmlspecialchars($quiz['cname']) ?></td>
                                <td class="description-cell" title="<?= htmlspecialchars($quiz['question']) ?>">
                                    <?= htmlspecialchars($quiz['question']) ?>
                                </td>
                                <td class="p-5"><?= htmlspecialchars($quiz['correct_answer']) ?></td>
                                <td class="p-5"><?= htmlspecialchars($quiz['points']) ?></td>
                                <td class="p-5">
                                    <div class="flex space-x-3 action-icons">
                                        <!-- Edit -->
                                        <form action="/dashboard/quizz/edit" method="POST" class="inline-block">
                                            <input type="hidden" name="_method" value="GET">
                                            <input type="hidden" name="id" value="<?= $quiz['id']; ?>">
                                            <input type="hidden" name="question" value="<?= $quiz['question']; ?>">
                                            <input type="hidden" name="correct_answer" value="<?= $quiz['correct_answer']; ?>">
                                            <input type="hidden" name="points" value="<?= $quiz['points']; ?>">
                                            <button type="submit" class="icon-btn icon-edit" title="Edit">
                                                <i class="fas fa-wand-sparkles"></i>

                                            </button>
                                        </form>

                                        <!-- Delete -->
                                        <form action="/dashboard/quizz/delete" method="POST" class="inline-block">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="id" value="<?= $quiz['id']; ?>">
                                            <button type="submit" class="icon-btn icon-delete" title="Delete">
                                                <i class="fas fa-skull-crossbones"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; else: ?>
                        <tr>
                            <td colspan="6" class="py-8 text-center empty-state">
                                <i class="fas fa-book-open text-4xl mb-2"></i>
                                <p>No quizzes found in the wizarding world.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if ($totalPages > 1): ?>
            <div class="pagination">
                <a href="?page=<?= max(1, $currentPage - 1) ?>"
                    class="<?= $currentPage === 1 ? 'disabled' : '' ?>">&laquo;</a>
                <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                    <a href="?page=<?= $p ?>" class="<?= $p === $currentPage ? 'active' : '' ?>"><?= $p ?></a>
                <?php endfor; ?>
                <a href="?page=<?= min($totalPages, $currentPage + 1) ?>"
                    class="<?= $currentPage === $totalPages ? 'disabled' : '' ?>">&raquo;</a>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>