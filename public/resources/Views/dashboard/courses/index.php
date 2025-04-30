<?php
// PAGINATION SETTINGS (if you want to add pagination later)
$perPage = 10;
$currentPage = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
$totalCourses = count($data);
$totalPages = (int) ceil($totalCourses / $perPage);
$offset = ($currentPage - 1) * $perPage;

// SLICE DATA FOR CURRENT PAGE
$pageData = array_slice($data, $offset, $perPage);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hogwarts Courses Dashboard</title>
    <!-- Tailwind & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Magical Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap"
        rel="stylesheet">
    <style>

        body {
            background: url('<?= $GLOBALS['img']->image("landing.png") ?>') no-repeat center fixed;
            background-size: cover;
            font-family: 'Cinzel', serif;
            color: #f0e6d2;
            min-height: 100vh;
            padding: 2rem;
        }

        .hogwarts-card {
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

        .course-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #f0e68c;
        }

        .course-image:hover {
            transform: scale(1.1);
            box-shadow: 0 0 10px rgba(218, 165, 32, 0.8);
        }

        .icon-btn {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%,
                    rgba(218, 165, 32, 0.6),
                    rgba(218, 165, 32, 0.2));
            box-shadow: 0 0 8px rgba(218, 165, 32, 0.8),
                inset 0 0 4px rgba(255, 248, 220, 0.6);
            animation: float-icon 4s ease-in-out infinite;
            transition: transform .3s ease, box-shadow .3s ease;
            cursor: pointer;
        }

        .icon-btn i {
            color: #fff;
            text-shadow: 0 0 4px rgba(255, 255, 255, 0.8);
            transition: transform .2s ease;
        }

        .icon-btn:hover {
            animation-play-state: paused;
            transform: translateY(-6px) scale(1.2) !important;
            box-shadow: 0 0 16px rgba(255, 215, 0, 1),
                inset 0 0 6px rgba(255, 248, 220, 0.8);
        }

        @keyframes float-icon {

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
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
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

        thead {
            background: rgba(0, 0, 0, 0.8);
        }

        table th,
        table td {
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            text-align: center;
        }

        table th {
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
    </style>
</head>

<body>
    <div class="max-w-7xl mx-auto hogwarts-card p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
            <div>
                <h1 class="text-4xl font-bold text-yellow-300 flex items-center">
                    <i class="fas fa-book-reader mr-2"></i> Hogwarts Courses
                </h1>
                <p class="text-gray-400 mt-1">Manage all available courses</p>
            </div>
            <div class="flex space-x-4 mt-4 sm:mt-0">
                <a href="/dashboard" class="hogwarts-button glow-hover flex items-center">
                    <i class="fas fa-undo mr-2"></i> Back to Dashboard
                </a>
                <a href="/dashboard/course/create" class="hogwarts-button glow-hover flex items-center">
                    <i class="fas fa-plus mr-2"></i> Add Course
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-3 py-5">#</th>
                        <th class="px-3 py-5">Image</th>
                        <th class="px-3 py-5">Course Name</th>
                        <th class="px-3 py-5">Professor</th>
                        <th class="px-3 py-5">Description</th>
                        <th class="px-3 py-5">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pageData)):
                        foreach ($pageData as $i => $course): ?>
                            <tr class="hover:bg-gray-700 hover:text-black transition-colors">
                                <td class="px-5 py-4"><?= $i + 1 ?></td>
                                <td class="px-5 py-4">
                                    <?php if ($course['img']): ?>
                                        <img src="<?= $GLOBALS['img']->image($course['img'], 'courses') ?>" class="course-image"
                                            alt="">
                                    <?php else: ?>
                                        <div class="course-image bg-gray-600 flex items-center justify-center text-gray-300">
                                            <i class="fas fa-book-open"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-4 font-semibold"><?= htmlspecialchars($course['cname']) ?></td>
                                <td class="px-5 py-4"><?= htmlspecialchars($course['pname']) ?></td>
                                <td class="px-5 py-4 description-cell" title="<?= htmlspecialchars($course['description']) ?>">
                                    <?= htmlspecialchars($course['description']) ?>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex space-x-3 action-icons">
                                            <!-- Edit Button -->
                                            <form action="/dashboard/course/edit" method="POST" class="inline-block">
                                                <input type="hidden" name="_method" value="GET">
                                                <input type="hidden" name="id" value="<?= $course['id'] ?>">
                                                <input type="hidden" name="cname" value="<?= $course['cname'] ?>">
                                                <input type="hidden" name="description" value="<?= $course['description'] ?>">
                                                <input type="hidden" name="img" value="<?= $course['img'] ?>">
                                                <button type="submit" class="icon-btn icon-edit" title="Edit">
                                                    <i class="fas fa-wand-sparkles"></i>
                                                </button>
                                            </form>
                                            <!-- Delete Button -->
                                            <form action="/dashboard/course/delete" method="POST" class="inline-block">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="id" value="<?= $course['id'] ?>">
                                                <input type="hidden" name="img" value="<?= $course['img'] ?>">
                                                <button type="submit" class="icon-btn icon-delete" title="Delete">
                                                    <i class="fas fa-skull-crossbones"></i>
                                                </button>
                                            </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; else: ?>
                        <tr>
                            <td colspan="6" class="py-8 text-center text-gray-400 hogwarts-empty-state">
                                <i class="fas fa-book text-4xl mb-4"></i>
                                <p>No courses found.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- (Optional) Pagination -->
        <?php if ($totalPages > 1): ?>
            <div class="pagination mt-6">
                <a href="?page=<?= max(1, $currentPage - 1) ?>" class="<?= $currentPage === 1 ? 'disabled' : '' ?>">«</a>
                <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                    <a href="?page=<?= $p ?>" class="<?= $p === $currentPage ? 'active' : '' ?>"><?= $p ?></a>
                <?php endfor; ?>
                <a href="?page=<?= min($totalPages, $currentPage + 1) ?>"
                    class="<?= $currentPage === $totalPages ? 'disabled' : '' ?>">»</a>
            </div>
        <?php endif; ?>

    </div>
</body>

</html>