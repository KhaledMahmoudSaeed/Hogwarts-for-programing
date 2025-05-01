<?php
$editPageName = "Course";
$pageType = "edit";
require __DIR__ . "/../../layout/dashboard/edit&CreatePageStart.php"
    ?>

<form action="/dashboard/course/update" method="POST" enctype="multipart/form-data" class="space-y-4">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="img" value="<?= htmlspecialchars($data['img']); ?>">
    <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']); ?>">
    <div class="flex flex-col items-center">
        <?php if (!empty($data['img'])): ?>
            <img src="<?= $GLOBALS['img']->image($_POST['img'], 'courses'); ?>" class="picture rounded-full"
                alt="Profile Picture">
        <?php else: ?>
            <div class="picture rounded-full bg-gray-200 flex items-center justify-center">
                <i class="fas fa-user text-4xl text-yellow-700"></i>
            </div>
        <?php endif; ?>

        <div class="file-upload mt-4">
            <button type="button" class="btn-gold text-sm font-medium">
                <i class="fas fa-camera mr-1"></i> Change Photo
            </button>
            <input type="file" name="img" accept="image/*" class="file-upload-input">
        </div>
    </div>
    <div>
        <label>Name</label>
        <input type="text" name="name" value="<?= htmlspecialchars($data['cname']); ?>" required>
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
        <label>Description</label>
        <input type="text" name="description" value="<?= htmlspecialchars($data['description']); ?>" required>
    </div>
    <?php if (isset($_SESSION['errors']['string'])): ?>
        <div class="mt-4 p-3 bg-white/10 border border-indigo-400 rounded-md" style="border-color: #b8860b;">
            <label class="text-red-700 text-x font-bold block">
                <ul class="list-disc pl-5 space-y-1">
                    <li><?php echo htmlspecialchars($_SESSION['errors']['string']); ?></li>
                </ul>
            </label>
        </div>
        <?php unset($_SESSION['errors']['string']); endif; ?>


    <div class="text-right">
        <button type="submit" class="btn-gold">
            <i class="fas fa-wand-sparkles mr-1"></i>Save Changes
        </button>
    </div>

</form>
<div class="text-center">
    <a href="/dashboard/courses" class="back-link">&larr; Back to Courses</a>
</div>
<?php
require __DIR__ . "/../../layout/dashboard/editPageEnd.php"
    ?>