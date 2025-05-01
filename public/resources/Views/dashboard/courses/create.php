<?php
use Helpers\Auth;
$id = Auth::getAuthenticatedUser()['id'];// get the id from JWT
$pageName = "COURSE";
$pageType = "create";
require __DIR__ . "/../../layout/dashboard/edit&CreatePageStart.php"
    ?>
<form action="/dashboard/course/store" method="POST" enctype="multipart/form-data" class="space-y-4">

    <div>
        <div class="flex flex-col items-center mb-4">
            <div class="flex flex-col items-center">
                <div class="picture rounded-full bg-gray-200 flex items-center justify-center">
                    <span>No Image</span>
                </div>
                <div class="file-upload mt-4">
                    <button type="button" class="btn-gold text-sm font-medium">
                        <i class="fas fa-camera mr-1"></i> Course Emblem
                    </button>
                    <input type="file" name="img" accept="image/*" class="file-upload-input">
                </div>
            </div>
        </div>
    </div>

    <!-- Course Title -->
    <div>
        <label for="name">Course Title</label>
        <input id="name" name="name" type="text" required />
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
    <!-- Description -->
    <div>
        <label for="description">Course Description</label>
        <textarea id="description" name="description" rows="4" required></textarea>
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
    <!-- Professor / Headmaster select -->
    <div>
        <label for="user_id">Professor In Charge</label>
        <div class="select-wrapper mt-1">
            <?php if (strtolower($_SESSION['role'] ?? '') === 'headmaster'): ?>
                <select id="user_id" name="user_id" required>
                    <option value="">— Select Professor —</option>
                    <?php foreach ($data as $prof): ?>
                        <option value="<?= (int) $prof['id'] ?>"><?= htmlspecialchars($prof['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            <?php else: ?>
                <input type="text" value="<?= htmlspecialchars($_SESSION['name'] ?? '') ?>" disabled />
                <input type="hidden" name="user_id" value="<?= $id ?? 0 ?>" />
            <?php endif; ?>
        </div>
    </div>
    <!-- Submit -->
    <div class="text-right">
        <button type="submit" class="btn-gold">
            <i class="fas fa-book-reader mr-1"></i>Create Course
        </button>
    </div>
</form>
<div class="text-center">
    <a href="/dashboard/courses" class="back-link">&larr; Back to Courses</a>
</div>
</div>
<?php
require __DIR__ . "/../../layout/dashboard/editPageEnd.php"
    ?>