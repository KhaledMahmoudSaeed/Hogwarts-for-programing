<?php
$pageName = "ITEM";
$pageType = "create";
require __DIR__ . "/../../layout/dashboard/edit&CreatePageStart.php"
    ?>
<form action="/dashboard/purchase/store" method="POST" enctype="multipart/form-data" class="space-y-4">

    <div>
        <div class="flex flex-col items-center mb-4">
            <div class="flex flex-col items-center">
                <div class="picture rounded-full bg-gray-200 flex items-center justify-center">
                    <span>No Image</span>
                </div>
                <div class="file-upload mt-4">
                    <button type="button" class="btn-gold text-sm font-medium">
                        <i class="fas fa-camera mr-1"></i> Change Photo
                    </button>
                    <input type="file" name="img" accept="image/*" class="file-upload-input">
                </div>
            </div>
        </div>
    </div>

    <div>
        <label for="name">Item Name</label>
        <input id="name" type="text" name="name" required />
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

    <div>
        <label for="price">Price (galleons)</label>
        <input id="price" type="number" name="price" min="1" required />
    </div>
    <?php if (isset($_SESSION['errors']['number'])): ?>
        <div class="mt-4 p-3 bg-white/10 border border-indigo-400 rounded-md" style="border-color: #b8860b;">
            <label class="text-red-700 text-x font-bold block">
                <ul class="list-disc pl-5 space-y-1">
                    <li><?php echo htmlspecialchars($_SESSION['errors']['number']); ?></li>
                </ul>
            </label>
        </div>
        <?php unset($_SESSION['errors']['number']); endif; ?>

    <div>
        <label for="type">Item Type</label>
        <div class="select-wrapper mt-1">
            <select id="type" name="type" required>
                <option value="">— Select Type —</option>
                <option value="Broom">Broom</option>
                <option value="Book">Book</option>
                <option value="Potion">Potion</option>
                <option value="Wand">Wand</option>
            </select>
        </div>
    </div>

    <div class="text-right">
        <button type="submit" class="btn-gold">
            <i class="fas fa-plus mr-1"></i>Add Item
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