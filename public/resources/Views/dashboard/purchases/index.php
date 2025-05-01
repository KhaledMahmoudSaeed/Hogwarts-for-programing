<?php
$tableName = "Items";
$url = "purchase";
require __DIR__ . "/../../layout/dashboard/indexPageStart.php"
    ?>
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
                    <?php if ($item['img']): ?><img src="<?= $GLOBALS['img']->image($item['img'], 'items') ?>" class="avatar"
                            alt=""><?php else: ?>
                        <div class="item-image bg-gray-600 flex items-center justify-center text-gray-300"><i
                                class="fas fa-magic"></i></div>
                    <?php endif; ?>
                </td>
                <td class="py-4 px-5"><?= htmlspecialchars($item['name']) ?></td>
                <td class="py-4 px-5"><span class="type-badge <?= $tc ?>"><?= htmlspecialchars($item['type']) ?></span></td>
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
            <td colspan="6" class="py-8 text-center empty-state"><i class="fas fa-box-open text-4xl mb-2"></i>
                <p>No magical items found.</p>
            </td>
        </tr>
    <?php endif; ?>

    <?php
    require __DIR__ . "/../../layout/dashboard/indexPageEnd.php"
        ?>