<?php
// PAGINATION SETTINGS
$perPage = 10;
$currentPage = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
$totalItems = count($data);
$totalPages = (int) ceil($totalItems / $perPage);
$offset = ($currentPage - 1) * $perPage;

// SLICE DATA FOR CURRENT PAGE
$pageData = array_slice($data, $offset, $perPage);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Magical Items Inventory</title>
    <!-- Tailwind & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Wizarding Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet" />
    <style>
        :root {
            --gold: #daa520;
            --maroon: #8b0000;
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
            background: rgba(0, 0, 0, 0.4);
            border: 2px solid var(--gold);
            backdrop-filter: blur(6px);
            border-radius: 1rem;
            box-shadow: 0 0 30px var(--gold);
            overflow: hidden;
        }

        h1 {
            font-size: 2.5rem;
            color: var(--maroon);
            text-shadow: 2px 2px #000;
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

        table thead {
            background: rgba(0, 0, 0, 0.8);
        }

        table th {
            color: var(--scroll);
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

        .item-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 0.5rem;
            border: 2px solid #f0e68c;
        }

        .item-image:hover {
            transform: scale(1.1);
            box-shadow: 0 0 10px rgba(218, 165, 32, 0.8);
        }

        .type-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: capitalize;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.3);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .type-badge:hover {
            transform: scale(1.1);
            box-shadow: 0 0 10px var(--gold);
        }

        .broom-badge {
            background: #d4b483;
            color: #333;
        }

        .book-badge {
            background: #a3b18a;
            color: #333;
        }

        .potion-badge {
            background: #c77dff;
            color: #fff;
        }

        .wand-badge {
            background: #f8961e;
            color: #fff;
        }

        .icon-btn {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, var(--gold)AA, var(--gold)66);
            box-shadow: 0 0 8px var(--gold), inset 0 0 4px var(--scroll);
            animation: float 4s ease-in-out infinite;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            margin: 0 .25rem;
        }

        .icon-btn i {
            color: #fff;
            text-shadow: 0 0 4px rgba(255, 255, 255, 0.8);
            transition: transform .2s ease;
        }

        .icon-btn:hover {
            animation-play-state: paused;
            transform: translateY(-6px) scale(1.2) !important;
            box-shadow: 0 0 16px var(--gold), inset 0 0 6px var(--scroll);
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
            border: 1px dashed var(--maroon);
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
    <div class="w-full max-w-7xl px-6 card p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-4xl font-bold text-yellow-300 flex items-center" 1><i
                    class="fas fa-hat-wizard mr-2"></i>Magical Items Inventory</h1>
            <div class="flex space-x-4">
                <a href="/dashboard" class="hogwarts-button glow-hover flex items-center"><i
                        class="fas fa-undo mr-1"></i>Back to dashboard</a>
                <a href="/dashboard/purchase/create" class="hogwarts-button glow-hover flex items-center"><i
                        class="fas fa-plus mr-1"></i>Add Item</a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="py-3 px-5">#</th>
                        <th class="py-3 px-5">Image</th>
                        <th class="py-3 px-5">Name</th>
                        <th class="py-3 px-5">Type</th>
                        <th class="py-3 px-5">Price</th>
                        <th class="py-3 px-5">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pageData)):
                        foreach ($pageData as $i => $item):
                            $tc = strtolower($item['type']) . '-badge'; ?>
                            <tr class="hover:bg-gray-700 hover:text-black transition-colors">
                                <td class="py-4 px-5"><?= $offset + $i + 1 ?></td>
                                <td class="py-4 px-5">
                                    <?php if ($item['img']): ?><img src="<?= $GLOBALS['img']->image($item['img'], 'items') ?>"
                                            class="item-image" alt=""><?php else: ?>
                                        <div class="item-image bg-gray-600 flex items-center justify-center text-gray-300"><i
                                                class="fas fa-magic"></i></div>
                                    <?php endif; ?>
                                </td>
                                <td class="py-4 px-5"><?= htmlspecialchars($item['name']) ?></td>
                                <td class="py-4 px-5"><span
                                        class="type-badge <?= $tc ?>"><?= htmlspecialchars($item['type']) ?></span></td>
                                <td class="text-gray-300"><?= number_format($item['price'], 2) ?> Galleons</td>
                                <td class="py-4 px-5">
                                    <div class="flex space-x-2">
                                        <!-- Edit Button -->
                                        <form action="/dashboard/purchase/edit" method="POST" class="inline-block">
                                            <input type="hidden" name="_method" value="GET">
                                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                            <input type="hidden" name="name" value="<?= $item['name'] ?>">
                                            <input type="hidden" name="img" value="<?= $item['img'] ?>">
                                            <input type="hidden" name="type" value="<?= $item['type'] ?>">
                                            <input type="hidden" name="price" value="<?= $item['price'] ?>">
                                            <button type="submit" class="icon-btn icon-edit" title="Edit Item">
                                                <i class="fas fa-wand-sparkles"></i>
                                            </button>
                                        </form>

                                        <!-- Delete Button -->
                                        <form action="/dashboard/purchase/delete" method="POST" class="inline-block">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                            <input type="hidden" name="img" value="<?= $item['img'] ?>">
                                            <button type="submit" class="icon-btn icon-delete" title="Delete Item"
                                                onclick="return confirm('Are you sure you want to delete this item?');">
                                                <i class="fas fa-skull-crossbones"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; else: ?>
                        <tr>
                            <td colspan="6" class="py-8 text-center empty-state"><i
                                    class="fas fa-box-open text-4xl mb-2"></i>
                                <p>No magical items found.</p>
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