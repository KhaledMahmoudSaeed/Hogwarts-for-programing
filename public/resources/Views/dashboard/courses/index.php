<?php
$tableName = "Courses";
$url = "course";
require __DIR__ . "/../../layout/dashboard/indexPageStart.php"
    ?>
<tr>
    <th class="px-3 py-5">#</th>
    <th class="px-3 py-5">Image</th>
    <th class="px-3 py-5">Course Name</th>
    <th class="px-3 py-5">Professor</th>
    <th class="px-3 py-5">Description</th>
    <th class="px-3 py-5">Actions</th>
</tr>
</thead>
<tbody>
    <?php if (!empty($pageData)):
        foreach ($pageData as $i => $course): ?>
            <tr class="hover:bg-gray-700 hover:text-black transition-colors">
                <td class="px-5 py-4"><?= $i + 1 ?></td>
                <td class="px-5 py-4">
                    <?php if ($course['img']): ?>
                        <img src="<?= $GLOBALS['img']->image($course['img'], 'courses') ?>" class="avatar" alt="">
                    <?php else: ?>
                        <div class="course-image bg-gray-600 flex items-center justify-center text-gray-300">
                            <i class="fas fa-book-open"></i>
                        </div>
                    <?php endif; ?>
                </td>
                <td class="px-5 py-4 font-semibold"><?= htmlspecialchars($course['cname']) ?></td>
                <td class="px-5 py-4"><?= htmlspecialchars($course['pname']) ?></td>
                <td class="px-5 py-4 description-cell" title="<?= htmlspecialchars($course['description']) ?>">
                    <?= htmlspecialchars($course['description']) ?>
                </td>
                <td class="px-5 py-4">
                    <div class="flex space-x-3 action-icons">
                        <?php if (strtolower($_SESSION['role']) === 'headmaster' || (strtolower($_SESSION['name']) === strtolower($course['pname']))): ?>
                            <!-- Edit Button -->
                            <form action="/dashboard/course/edit" method="POST" class="inline-block">
                                <input type="hidden" name="_method" value="GET">
                                <input type="hidden" name="id" value="<?= $course['id'] ?>">
                                <input type="hidden" name="cname" value="<?= $course['cname'] ?>">
                                <input type="hidden" name="description" value="<?= $course['description'] ?>">
                                <input type="hidden" name="img" value="<?= $course['img'] ?>">
                                <button type="submit" class="icon-btn icon-edit" title="Edit">
                                    <i class="fas fa-wand-sparkles"></i>
                                </button>
                            </form>
                            <!-- Delete Button -->
                            <form action="/dashboard/course/delete" method="POST" class="inline-block">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" value="<?= $course['id'] ?>">
                                <input type="hidden" name="img" value="<?= $course['img'] ?>">
                                <button type="submit" class="icon-btn icon-delete" title="Delete">
                                    <i class="fas fa-skull-crossbones"></i>
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; else: ?>
        <tr>
            <td colspan="6" class="py-8 text-center text-gray-400 hogwarts-empty-state">
                <i class="fas fa-book text-4xl mb-4"></i>
                <p>No courses found.</p>
            </td>
        </tr>
    <?php endif; ?>

    <?php
    require __DIR__ . "/../../layout/dashboard/indexPageEnd.php"
        ?>