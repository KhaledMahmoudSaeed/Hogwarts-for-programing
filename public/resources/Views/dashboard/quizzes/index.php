<?php
$tableName = "Quizzs";
$url = "quizz";
require __DIR__ . "/../../layout/dashboard/indexPageStart.php"
    ?>
<tr>
    <th class="py-3 px-5">#</th>
    <th class="py-3 px-5">Course</th>
    <th class="py-3 px-5">Question</th>
    <th class="py-3 px-5">Answer</th>
    <th class="py-3 px-5">Points</th>
    <th class="py-3 px-5">Actions</th>
</tr>
</thead>
<tbody>
    <?php if (!empty($pageData)):
        foreach ($pageData as $i => $quiz): ?>
            <tr class="hover:bg-gray-700 hover:text-black transition-colors">
                <td class="p-5"><?= $i + 1 ?></td>
                <td class="p-5"><?= htmlspecialchars($quiz['cname']) ?></td>
                <td class="description-cell" title="<?= htmlspecialchars($quiz['question']) ?>">
                    <?= htmlspecialchars($quiz['question']) ?>
                </td>
                <td class="p-5"><?= htmlspecialchars($quiz['correct_answer']) ?></td>
                <td class="p-5"><?= htmlspecialchars($quiz['points']) ?></td>
                <td class="p-5">
                    <div class="flex space-x-3 action-icons">
                        <!-- Edit -->
                        <form action="/dashboard/quizz/edit" method="POST" class="inline-block">
                            <input type="hidden" name="_method" value="GET">
                            <input type="hidden" name="id" value="<?= $quiz['id']; ?>">
                            <input type="hidden" name="question" value="<?= $quiz['question']; ?>">
                            <input type="hidden" name="correct_answer" value="<?= $quiz['correct_answer']; ?>">
                            <input type="hidden" name="points" value="<?= $quiz['points']; ?>">
                            <button type="submit" class="icon-btn icon-edit" title="Edit">
                                <i class="fas fa-wand-sparkles"></i>

                            </button>
                        </form>

                        <!-- Delete -->
                        <form action="/dashboard/quizz/delete" method="POST" class="inline-block">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="<?= $quiz['id']; ?>">
                            <button type="submit" class="icon-btn icon-delete" title="Delete">
                                <i class="fas fa-skull-crossbones"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; else: ?>
        <tr>
            <td colspan="6" class="py-8 text-center empty-state">
                <i class="fas fa-book-open text-4xl mb-2"></i>
                <p>No quizzes found in the wizarding world.</p>
            </td>
        </tr>
    <?php endif; ?>

    <?php
    require __DIR__ . "/../../layout/dashboard/indexPageEnd.php"
        ?>