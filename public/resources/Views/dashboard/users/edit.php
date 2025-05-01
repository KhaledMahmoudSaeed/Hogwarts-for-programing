<?php
$editPageName = "User";
$pageType = "edit";
require __DIR__ . "/../../layout/dashboard/edit&CreatePageStart.php"
    ?>
<?php if ($_SESSION['role'] === "professor"): ?>
    <form action="/dashboard/user/update" method="POST" enctype="multipart/form-data" class="space-y-6">
    <?php else: ?>
        <form action="/profile" method="POST" enctype="multipart/form-data" class="space-y-6">
        <?php endif ?>
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="<?= htmlspecialchars($_POST['id']); ?>">
        <input type="hidden" name="img" value="<?= htmlspecialchars($_POST['img']); ?>">


        <!-- Profile Picture Section -->
        <div class="flex flex-col items-center">
            <div class="flex flex-col items-center mb-4">
                <div class="flex flex-col items-center">
                    <?php if (!empty($_POST['img'])): ?>
                        <img src="<?= $GLOBALS['img']->image($_POST['img'], 'users'); ?>" class="picture rounded-full"
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
                <?php if (isset($_SESSION['errors'])): ?>
                    <div class="mt-4 p-3 bg-white/10 border border-indigo-400 rounded-md" style="border-color: #b8860b;">
                        <label class="text-red-700 text-x font-bold block">
                            <ul class="list-disc pl-5 space-y-1">
                                <?php foreach ($_SESSION['errors'] as $error): ?>
                                    <li><?php echo htmlspecialchars($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </label>
                    </div>
                    <?php unset($_SESSION['errors']); endif; ?>
                <div>
                    <label>Full Name</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($_POST['name']); ?>" required>
                </div>

                <div>
                    <label>Email Address</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($_POST['email']); ?>" required>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn-gold">
                        <i class="fas fa-wand-sparkles mr-1"></i> Save Changes
                    </button>
                </div>
    </form>

    <div class="text-center">
        <a href="/dashboard/users" class="back-link">&larr; Back to Dashboard</a>
    </div>
    </div>

    <?php
    require __DIR__ . "/../../layout/dashboard/editPageEnd.php"
        ?>