<?php
$editPageName = "Items";
$pageType = "edit";
require __DIR__ . "/../../layout/dashboard/edit&CreatePageStart.php"
    ?>
<form action="/dashboard/purchase/update" method="POST" enctype="multipart/form-data" class="space-y-4">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']); ?>">
    <input type="hidden" name="img" value="<?= htmlspecialchars($data['img']); ?>">

    <!-- Current Image -->
    <div>
        <div class="flex flex-col items-center mb-4">
            <div class="flex flex-col items-center">
                <?php if (!empty($data['img'])): ?>
                    <img src="<?= $GLOBALS['img']->image($data['img'], 'items'); ?>" class="picture rounded-full"
                        alt="Profile Picture">
                <?php else: ?>
                    <div class="picture rounded-full bg-gray-200 flex items-center justify-center">
                        <span>No Image</span>
                    </div>
                <?php endif; ?>
                <div class="file-upload mt-4">
                    <button type="button" class="btn-gold text-sm font-medium">
                        <i class="fas fa-camera mr-1"></i> Change Photo
                    </button>
                    <input type="file" name="img" accept="image/*" class="file-upload-input">
                </div>
            </div>
        </div>
    </div>
    <!-- Name -->
    <div>
        <label for="name">Item Name</label>
        <input id="name" type="text" name="name" value="<?= htmlspecialchars($data['name']); ?>" required>
    </div>
    <?php if (isset($_SESSION['errors']['name'])): ?>
        <div class="mt-4 p-3 bg-white/10 border border-indigo-400 rounded-md" style="border-color: #b8860b;">
            <label class="text-red-700 text-x font-bold block">
                <ul class="list-disc pl-5 space-y-1">
                    <li><?php echo htmlspecialchars($_SESSION['errors']['name']); ?></li>
                </ul>
            </label>
        </div>
        <?php unset($_SESSION['errors']['name']); endif; ?>

    <!-- Type -->
    <div>
        <label for="type">Item Type</label>
        <div class="select-wrapper mt-1">
            <select id="type" name="type" class="w-full">
                <option value="Broom" <?= $data['type'] == 'Broom' ? 'selected' : '' ?>>Broom</option>
                <option value="Book" <?= $data['type'] == 'Book' ? 'selected' : '' ?>>Book</option>
                <option value="Potion" <?= $data['type'] == 'Potion' ? 'selected' : '' ?>>Potion</option>
                <option value="Wand" <?= $data['type'] == 'Wand' ? 'selected' : '' ?>>Wand</option>
            </select>
        </div>
    </div>

    <!-- Price -->
    <div>
        <label for="price">Price (galleons)</label>
        <input id="price" type="number" name="price" min="1" value="<?= htmlspecialchars($data['price']); ?>" required>
    </div><?php if (isset($_SESSION['errors']['number'])): ?>
        <div class="mt-4 p-3 bg-white/10 border border-indigo-400 rounded-md" style="border-color: #b8860b;">
            <label class="text-red-700 text-x font-bold block">
                <ul class="list-disc pl-5 space-y-1">
                    <li><?php echo htmlspecialchars($_SESSION['errors']['number']); ?></li>
                </ul>
            </label>
        </div>
        <?php unset($_SESSION['errors']['number']); endif; ?>

    <!-- Submit -->
    <div class="text-right">
        <button type="submit" class="btn-gold">
            <i class="fas fa-wand-sparkles mr-1"></i>Save Changes
        </button>
    </div>

</form>
<div class="text-center">
    <a href="/dashboard/purchases" class="back-link">&larr; Back to Purchases</a>
</div>
</div>
<?php
require __DIR__ . "/../../layout/dashboard/editPageEnd.php"
    ?>