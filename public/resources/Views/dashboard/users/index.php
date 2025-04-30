<?php
// resources/Views/dashboard/users/index.php

// PAGINATION SETTINGS
$perPage = 10;                                             // how many users per page
$currentPage = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
$totalUsers = count($data);                                  // $data comes from your controller
$totalPages = (int) ceil($totalUsers / $perPage);
$offset = ($currentPage - 1) * $perPage;

// SLICE OUT ONLY THE USERS FOR THIS PAGE
$pageData = array_slice($data, $offset, $perPage);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hogwarts Users Management</title>
    <!-- Tailwind & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Magical Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --gryffindor: #8b0000;
            --slytherin: #1E7352;
            --ravenclaw: #113243;
            --hufflepuff: #CA8D0F;
        }

        body {
            background: url('<?= $GLOBALS['img']->image("landing.png") ?>') no-repeat center fixed;
            background-size: cover;
            font-family: 'Cinzel', serif;
            color: #f0e6d2;
            min-height: 100vh;
            padding-bottom: 4rem;
        }

        thead {
            background: rgba(0, 0, 0, 0.8);
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
            border-radius: 12px;
            padding: 0.5rem 1rem;
            transition: all .3s ease;
        }

        .hogwarts-button:hover {
            background: linear-gradient(to right, #daa520, #b8860b);
            box-shadow: 0 0 12px #f0e68c;
        }

        .user-avatar {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #f0e68c;
        }

        .user-avatar:hover {
            transform: scale(1.1);
            box-shadow: 0 0 10px rgba(218, 165, 32, 0.8);
        }

        table th,
        table td {
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        }

        table th {
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .wand-info {
            font-style: italic;
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
            animation: float-icon 4s ease-in-out infinite;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .icon-btn i {
            font-size: 1rem;
            color: #fff;
            text-shadow: 0 0 4px rgba(255, 255, 255, 0.8);
            transition: transform .2s ease;
        }

        .icon-btn:hover i {
            transform: scale(1.1);
        }

        .icon-btn:hover {
            transform: translateY(-6px) scale(1.2) !important;
            box-shadow: 0 0 16px rgba(255, 215, 0, 1), inset 0 0 6px rgba(255, 248, 220, 0.8);
            animation-play-state: paused;
        }

        /* Float animation */
        @keyframes float-icon {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-4px);
            }
        }

        /* Color variants */
        .icon-btn.icon-view {
            background: radial-gradient(circle at 30% 30%, rgba(79, 195, 247, 0.6), rgba(79, 195, 247, 0.2));
        }

        .icon-btn.icon-edit {
            background: radial-gradient(circle at 30% 30%, rgba(102, 187, 106, 0.6), rgba(102, 187, 106, 0.2));
        }

        .icon-btn.icon-delete {
            background: radial-gradient(circle at 30% 30%, rgba(239, 83, 80, 0.6), rgba(239, 83, 80, 0.2));
        }

        .glow-hover:hover {
            box-shadow: 0 0 12px 2px #ffd700;
        }

        .house-gryffindor:hover {
            background: linear-gradient(90deg, var(--gryffindor), #ad3d40);
            color: #000;
        }

        .house-slytherin:hover {
            background: linear-gradient(90deg, var(--slytherin), #498865);
            color: #000;
        }

        .house-ravenclaw:hover {
            background: linear-gradient(90deg, var(--ravenclaw), #325a88);
            color: #000;
        }

        .house-hufflepuff:hover {
            background: linear-gradient(90deg, var(--hufflepuff), #f2d675);
            color: #000;
        }

        /* Magical Role Badges */
        .role-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.875rem;
            font-weight: 700;
            text-transform: uppercase;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.3);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .student {
            background: #d4b483;
            color: #333;
        }

        .professor {
            background: #a3b18a;
            color: #333;
        }

        .headmaster {
            background: #f8961e;
            color: #333;
        }

        .role-badge:hover {
            transform: scale(1.1);
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.8);
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
    </style>
</head>

<body class="flex flex-col items-center pt-10">
    <div class="w-full max-w-7xl px-6">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-yellow-300 flex items-center">
                <i class="fas fa-hat-wizard mr-3"></i> Hogwarts Users
            </h1>
            <a href="/dashboard" class="hogwarts-button glow-hover flex items-center">
                <i class="fas fa-undo mr-2"></i> Back to Dashboard
            </a>
        </div>

        <div class="hogwarts-card p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead>
                        <tr>
                            <th class="py-3 px-5">#</th>
                            <th class="py-3 px-5">Avatar</th>
                            <th class="py-3 px-5">Name</th>
                            <th class="py-3 px-5">Email</th>
                            <th class="py-3 px-5">Role</th>
                            <th class="py-3 px-5">House</th>
                            <th class="py-3 px-5">Wand</th>
                            <th class="py-3 px-5">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($pageData):
                            $count = $offset + 1;
                            foreach ($pageData as $user):
                                $houseClass = '';
                                switch (strtolower($user['hname'])) {
                                    case 'gryffindor':
                                        $houseClass = 'house-gryffindor';
                                        break;
                                    case 'slytherin':
                                        $houseClass = 'house-slytherin';
                                        break;
                                    case 'ravenclaw':
                                        $houseClass = 'house-ravenclaw';
                                        break;
                                    case 'hufflepuff':
                                        $houseClass = 'house-hufflepuff';
                                        break;
                                }
                                ?>
                                <tr class="transition-colors duration-300 <?= $houseClass ?>">
                                    <td class="py-4 px-5"><?= $count++ ?></td>
                                    <td class="py-4 px-5">
                                        <?php if (!empty($user['img'])): ?>
                                            <img src="<?= $GLOBALS['img']->image($user['img'], 'users') ?>" class="user-avatar"
                                                alt="">
                                        <?php else: ?>
                                            <div class="user-avatar bg-gray-300 flex items-center justify-center">
                                                <i class="fas fa-user text-gray-600"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="py-4 px-5"><?= htmlspecialchars($user['uname']) ?></td>
                                    <td class="py-4 px-5"><?= htmlspecialchars($user['email']) ?></td>
                                    <td class="py-4 px-5">
                                        <span class="role-badge <?= strtolower($user['role']); ?>">
                                            <?= htmlspecialchars(ucfirst($user['role'])); ?>
                                        </span>
                                    </td>
                                    <td class="py-4 px-5 font-semibold"><?= htmlspecialchars($user['hname']) ?></td>
                                    <td class="py-4 px-5 wand-info">
                                        <?= htmlspecialchars($user['wood'] . ' & ' . $user['core']) ?>
                                    </td>
                                    <td class="py-4 px-5">
                                        <div class="flex space-x-3 action-icons">
                                            <!-- View (always available) -->
                                            <a href="/dashboard/user?id=<?= $user['id'] ?>" class="icon-btn icon-view"
                                                title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                                <form action="/dashboard/user/edit" method="POST" class="inline-block">
                                                    <input type="hidden" name="_method" value="GET">
                                                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                    <input type="hidden" name="name" value="<?= $user['uname'] ?>">
                                                    <input type="hidden" name="email" value="<?= $user['email'] ?>">
                                                    <input type="hidden" name="img" value="<?= $user['img'] ?>">
                                                    <button type="submit" class="icon-btn icon-edit" title="Edit">
                                                        <i class="fas fa-wand-sparkles"></i>
                                                    </button>
                                                </form>

                                                <!-- Delete -->
                                                <form action="/dashboard/user/delete" method="POST" class="inline-block">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                    <button type="submit" class="icon-btn icon-delete" title="Delete">
                                                        <i class="fas fa-skull-crossbones"></i>
                                                    </button>
                                                </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach;
                        else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-6 text-lg">
                                    <i class="fas fa-magic text-4xl text-yellow-400 mb-2"></i>
                                    <p>No users found!</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <?php if ($totalPages > 1): ?>
                <div class="pagination">
                    <!-- Prev -->
                    <a href="?page=<?= max(1, $currentPage - 1) ?>" class="<?= $currentPage === 1 ? 'disabled' : '' ?>">
                        &laquo;
                    </a>

                    <!-- Page Numbers -->
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?= $i; ?>" class="<?= $currentPage === $i ? 'active' : ''; ?>">
                            <?= $i; ?>
                        </a>
                    <?php endfor; ?>

                    <!-- Next -->
                    <a href="?page=<?= min($totalPages, $currentPage + 1) ?>"
                        class="<?= $currentPage === $totalPages ? 'disabled' : '' ?>">
                        &raquo;
                    </a>
                </div>
            <?php endif; ?>


        </div>
    </div>
</body>

</html>