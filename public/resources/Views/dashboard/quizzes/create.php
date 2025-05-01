<?php
$pageName = "QUIZZ";
$pageType = "create";
require __DIR__ . "/../../layout/dashboard/edit&CreatePageStart.php"
    ?>
<form action="/dashboard/quizz/store" method="POST" class="space-y-4">

    <!-- Course Dropdown -->
    <div>
        <label for="course_id">Select Course</label>
        <div class="select-wrapper mt-1">
            <select id="course_id" name="course_id" required>
                <option value="">— Choose Course —</option>
                <?php foreach ($data as $course): ?>
                    <option value="<?= htmlspecialchars($course['id']); ?>">
                        <?= htmlspecialchars($course['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <!-- Question Field -->
    <div>
        <label for="question">Question</label>
        <input id="question" type="text" name="question" required />
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

    <!-- Correct Answer -->
    <div>
        <label>Correct Answer</label>
        <div class="radio-group mt-1">
            <label><input type="radio" name="correct_answer" value="true" required />True</label>
            <label><input type="radio" name="correct_answer" value="false" required />False</label>
        </div>
    </div>

    <!-- Points Field -->
    <div>
        <label for="points">Points</label>
        <input id="points" type="number" name="points" min="1" required />
    </div>

    <!-- Submit -->
    <div class="text-right">
        <button type="submit" class="btn-gold">
            <i class="fas fa-plus mr-1"></i>Add Quiz
        </button>
    </div>
</form>
<div class="text-center">
    <a href="/dashboard/quizzs" class="back-link">&larr; Back to Quizzes</a>
</div>
</div>

</body>

</html>