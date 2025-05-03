<?php
$editPageName = "profile";
$pageType = "edit";
require __DIR__ . "/../../layout/dashboard/edit&CreatePageStart.php"
    ?>
<?php if ($_SESSION['role'] !== "student"): ?>
    <form action="/dashboard/user/update" method="POST" enctype="multipart/form-data" class="space-y-6">
    <?php else: ?>
        <form action="/profile" method="POST" enctype="multipart/form-data" class="space-y-6">
        <?php endif ?>
<input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="<?= htmlspecialchars($_POST['id']); ?>">
                <input type="hidden" name="img" value="<?= htmlspecialchars($user['img']); ?>">

                <div class="flex flex-col items-center">
                    <?php if (!empty($_POST['img'])): ?>
                        <img src="<?= $GLOBALS['img']->image($_POST['img'], 'users'); ?>"
                            class="picture rounded-full" alt="Profile Picture">
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
                <a href="javascript:history.back()" class="back-link">&larr; Back to Dashboard</a>
            </div>
    </div>

    <?php
    require __DIR__ . "/../../layout/dashboard/editPageEnd.php"
        ?>