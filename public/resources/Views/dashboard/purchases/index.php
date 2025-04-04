<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magical Items Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .item-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.2s ease;
        }

        .item-image:hover {
            transform: scale(1.05);
        }

        .type-badge {
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: capitalize;
        }

        .broom-badge {
            background-color: #d4b483;
            color: #333;
        }

        .book-badge {
            background-color: #a3b18a;
            color: #333;
        }

        .potion-badge {
            background-color: #c77dff;
            color: white;
        }

        .wand-badge {
            background-color: #f8961e;
            color: white;
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

<body class="bg-gray-50 min-h-screen py-8 px-4 sm:px-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
                    <i class="fas fa-hat-wizard text-blue-600 mr-2"></i> Magical Items Inventory
                </h1>
                <p class="text-gray-500 text-sm mt-1">Manage your magical items collection</p>
            </div>
            <a href="/dashboard/purchase/create"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-md transition flex items-center whitespace-nowrap">
                <i class="fas fa-plus mr-2"></i> Add New Item
            </a>
        </div>

        <!-- Table Container -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-blue-600 to-blue-500">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">#
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Image</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Item
                                Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Type
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (!empty($data)): ?>
                            <?php foreach ($data as $index => $purchase): ?>
                                <?php
                                $typeClass = '';
                                switch (strtolower($purchase['type'])) {
                                    case 'broom':
                                        $typeClass = 'broom-badge';
                                        break;
                                    case 'book':
                                        $typeClass = 'book-badge';
                                        break;
                                    case 'potion':
                                        $typeClass = 'potion-badge';
                                        break;
                                    case 'wand':
                                        $typeClass = 'wand-badge';
                                        break;
                                    default:
                                        $typeClass = 'bg-gray-100 text-gray-800';
                                }
                                ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <?= $index + 1 ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php if (!empty($purchase['img'])): ?>
                                            <img src="<?= $GLOBALS['img']->image($purchase['img'], 'items'); ?>"
                                                class="item-image shadow-sm cursor-pointer"
                                                alt="<?= htmlspecialchars($purchase['name']) ?>" title="View larger image">
                                        <?php else: ?>
                                            <div class="item-image bg-gray-100 flex items-center justify-center text-gray-400">
                                                <i class="fas fa-magic"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <?= htmlspecialchars($purchase['name']) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="type-badge <?= $typeClass ?>">
                                            <?= htmlspecialchars($purchase['type']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">
                                        <?= number_format(htmlspecialchars($purchase['price']), 2) ?> <span
                                            class="text-gray-500">Galleons</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <!-- Edit Button -->
                                            <form action="/dashboard/purchase/edit" method="POST" class="inline-block">
                                                <input type="hidden" name="_method" value="GET">
                                                <input type="hidden" name="id" value="<?= $purchase['id'] ?>">
                                                <button type="submit" class="text-blue-600 hover:text-blue-800 action-btn"
                                                    title="Edit Item">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </form>

                                            <!-- Delete Button -->
                                            <form action="/dashboard/purchase/delete" method="POST" class="inline-block">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="id" value="<?= $purchase['id'] ?>">
                                                <input type="hidden" name="img" value="<?= $purchase['img'] ?>">
                                                <button type="submit" class="text-red-600 hover:text-red-800 action-btn"
                                                    title="Delete Item"
                                                    onclick="return confirm('Are you sure you want to delete this item?');">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center py-12">
                                        <i class="fas fa-box-open text-4xl text-gray-300 mb-3"></i>
                                        <p class="text-lg font-medium">No magical items found</p>
                                        <p class="text-sm text-gray-400 mt-1">Add your first item to get started</p>
                                        <a href="/dashboard/purchase/create"
                                            class="mt-4 text-blue-600 hover:text-blue-800 text-sm font-medium">
                                            <i class="fas fa-plus mr-1"></i> Create New Item
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>