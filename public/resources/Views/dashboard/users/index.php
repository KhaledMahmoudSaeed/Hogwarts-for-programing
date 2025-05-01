<?php
$tableName = "Users";
require __DIR__ . "/../../layout/dashboard/indexPageStart.php"
    ?>
<tr>
    <th class="py-3 px-5">#</th>
    <th class="py-3 px-5">Avatar</th>
    <th class="py-3 px-5">Name</th>
    <th class="py-3 px-5">Email</th>
    <th class="py-3 px-5">Role</th>
    <th class="py-3 px-5">House</th>
    <th class="py-3 px-5">Wand</th>
    <th class="py-3 px-5">Actions</th>
</tr>
</thead>
<tbody>
    <?php if ($pageData):
        $count = $offset + 1;
        foreach ($pageData as $user):
            $houseClass = '';
            switch (strtolower($user['hname'])) {
                case 'gryffindor':
                    $houseClass = 'house-gryffindor';
                    break;
                case 'slytherin':
                    $houseClass = 'house-slytherin';
                    break;
                case 'ravenclaw':
                    $houseClass = 'house-ravenclaw';
                    break;
                case 'hufflepuff':
                    $houseClass = 'house-hufflepuff';
                    break;
            }
            ?>
            <tr class="transition-colors duration-300 <?= $houseClass ?>">
                <td class="py-4 px-5"><?= $count++ ?></td>
                <td class="py-4 px-5">
                    <?php if (!empty($user['img'])): ?>
                        <img src="<?= $GLOBALS['img']->image($user['img'], 'users') ?>" class="avatar" alt="">
                    <?php else: ?>
                        <div class="user-avatar bg-gray-300 flex items-center justify-center">
                            <i class="fas fa-user text-gray-600"></i>
                        </div>
                    <?php endif; ?>
                </td>
                <td class="py-4 px-5"><?= htmlspecialchars($user['uname']) ?></td>
                <td class="py-4 px-5"><?= htmlspecialchars($user['email']) ?></td>
                <td class="py-4 px-5">
                    <span class="role-badge <?= strtolower($user['role']); ?>">
                        <?= htmlspecialchars(ucfirst($user['role'])); ?>
                    </span>
                </td>
                <td class="py-4 px-5 font-semibold"><?= htmlspecialchars($user['hname']) ?></td>
                <td class="py-4 px-5 wand-info">
                    <?= htmlspecialchars($user['wood'] . ' & ' . $user['core']) ?>
                </td>
                <td class="py-4 px-5">
                    <div class="flex space-x-3 action-icons">
                        <!-- View (always available) -->
                        <a href="/dashboard/user?id=<?= $user['id'] ?>" class="icon-btn icon-view" title="View">
                            <i class="fas fa-eye"></i>
                        </a>

                        <!-- Edit (headmaster or professor-for-students) -->
                        <?php if (strtolower($_SESSION['role']) === 'headmaster' || (strtolower($_SESSION['role']) === 'professor' && strtolower($user['role']) === 'student')): ?>
                            <form action="/dashboard/user/edit" method="POST" class="inline-block">
                                <input type="hidden" name="_method" value="GET">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                <input type="hidden" name="name" value="<?= $user['uname'] ?>">
                                <input type="hidden" name="email" value="<?= $user['email'] ?>">
                                <input type="hidden" name="img" value="<?= $user['img'] ?>">
                                <button type="submit" class="icon-btn icon-edit" title="Edit">
                                    <i class="fas fa-wand-sparkles"></i>
                                </button>
                            </form>

                            <!-- Delete -->
                            <form action="/dashboard/user/delete" method="POST" class="inline-block">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                <button type="submit" class="icon-btn icon-delete" title="Delete">
                                    <i class="fas fa-skull-crossbones"></i>
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
        <?php endforeach;
    else: ?>
        <tr>
            <td colspan="8" class="text-center py-6 text-lg">
                <i class="fas fa-magic text-4xl text-yellow-400 mb-2"></i>
                <p>No users found!</p>
            </td>
        </tr>
    <?php endif; ?>

    <?php
    require __DIR__ . "/../../layout/dashboard/indexPageEnd.php"
        ?>