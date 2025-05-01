<?php
$editPageName = "Quizz";
$pageType = "edit";
require __DIR__ . "/../../layout/dashboard/edit&CreatePageStart.php"
    ?>
<form action="/dashboard/quizz/update" method="POST" class="space-y-4">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']); ?>">
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
        <label for="question">Question</label>
        <input id="question" type="text" name="question" value="<?= htmlspecialchars($data['question']); ?>" required />
    </div>

    <div>
        <label>Correct Answer</label>
        <div class="radio-group">
            <label><input type="radio" name="correct_answer" value="true" <?= $data['correct_answer'] === 'true' ? 'checked' : ''; ?> required />True</label>
            <label><input type="radio" name="correct_answer" value="false" <?= $data['correct_answer'] === 'false' ? 'checked' : ''; ?> required />False</label>
        </div>
    </div>

    <div>
        <label for="points">Points</label>
        <input id="points" type="number" name="points" min="1" value="<?= htmlspecialchars($data['points']); ?>"
            required />
    </div>

    <div class="text-right">
        <button type="submit" class="btn-gold">
            <i class="fas fa-wand-sparkles mr-1"></i>Save Changes
        </button>
    </div>
</form>
<div class="text-center">
    <a href="/dashboard/quizzs" class="back-link">&larr; Back to Quizzes</a>
</div>
</div>
</body>

</html>