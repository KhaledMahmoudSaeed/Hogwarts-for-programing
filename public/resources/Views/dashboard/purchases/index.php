<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - Magical itmes Table</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #f3f4f6;
            /* Light gray background */
        }
    </style>
</head>

<body class="min-h-screen flex flex-col items-center py-8">
    <div class="w-full max-w-6xl px-4">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">
            Dashboard - Magical itmes
        </h1>
        <div class="flex justify-end mb-4">
            <a href="/dashboard/purchase/create"
                class="bg-green-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-green-600 transition duration-200">
                ➕ Add purchase
            </a>
        </div>

        <div class="overflow-x-auto shadow-lg rounded-lg">
            <table class="min-w-full bg-white">
                <thead class="bg-blue-500">
                    <tr>
                        <th class="py-3 px-6 text-left text-white font-semibold">ID</th>
                        <th class="py-3 px-6 text-left text-white font-semibold">Name</th>
                        <th class="py-3 px-6 text-left text-white font-semibold">Type</th>
                        <th class="py-3 px-6 text-left text-white font-semibold">Price</th>
                        <th class="py-3 px-6 text-left text-white font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <?php if (!empty($data)):
                        $counter = 1 ?>
                        <?php foreach ($data as $purchase):
                            ?>

                            <tr class="border-b border-gray-200 hover:bg-gray-100 transition-opacity duration-200">
                                <td class="py-4 px-6"><?= htmlspecialchars($counter++); ?></td>
                                <td class="py-4 px-6"><?= htmlspecialchars($purchase['name']); ?></td>
                                <td class="py-4 px-6"><?= htmlspecialchars($purchase['type']); ?></td>
                                <td class="py-4 px-6"><?= htmlspecialchars($purchase['price']); ?></td>
                                <td class="py-4 px-6 flex space-x-2">
                                    <!-- Update Form -->
                                    <form action="/dashboard/purchase/edit" method="POST" class="inline-block">
                                        <input type="hidden" name="_method" value="GET">
                                        <input type="hidden" name="id" value="<?= $purchase['id']; ?>">
                                        <input type="hidden" name="name" value="<?= $purchase['name']; ?>">
                                        <input type="hidden" name="type" value="<?= $purchase['type']; ?>">
                                        <input type="hidden" name="price" value="<?= $purchase['price']; ?>">
                                        <button type="submit" class="text-green-500 hover:text-green-700">
                                            &#9998; <!-- Pencil Icon -->
                                        </button>
                                    </form>

                                    <!-- Delete Form -->
                                    <form action="/dashboard/purchase/delete" method="POST" class="inline-block">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="id" value="<?php echo $purchase['id']; ?>">
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            &#10060; <!-- Cross Mark Icon -->
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="py-4 px-6 text-center">No Magical itmes found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>