<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Courses Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .course-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.2s ease;
        }

        .course-image:hover {
            transform: scale(1.05);
        }

        .action-btn {
            transition: all 0.2s ease;
            padding: 5px;
            border-radius: 4px;
        }

        .action-btn:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .description-cell {
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen py-8 px-4 sm:px-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
                    <i class="fas fa-graduation-cap text-blue-600 mr-2"></i> Courses Dashboard
                </h1>
                <p class="text-gray-500 text-sm mt-1">Manage all available courses</p>
            </div>
            <a href="/dashboard/course/create"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-md transition flex items-center whitespace-nowrap">
                <i class="fas fa-plus mr-2"></i> Add New Course
            </a>
        </div>

        <!-- Table Container -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-blue-600 to-blue-500">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">#
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Image</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Course Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Professor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (!empty($data)): ?>
                            <?php foreach ($data as $index => $course): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <?= $index + 1 ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php if (!empty($course['img'])): ?>
                                            <img src="<?= $GLOBALS['img']->image($course['img'], 'courses'); ?>"
                                                class="course-image shadow-sm cursor-pointer"
                                                alt="<?= htmlspecialchars($course['cname']) ?>" title="Course image">
                                        <?php else: ?>
                                            <div class="course-image bg-gray-100 flex items-center justify-center text-gray-400">
                                                <i class="fas fa-book"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <?= htmlspecialchars($course['cname']) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?= htmlspecialchars($course['pname']) ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 description-cell"
                                        title="<?= htmlspecialchars($course['description']) ?>">
                                        <?= htmlspecialchars($course['description']) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <!-- Edit Button -->
                                            <form action="/dashboard/course/edit" method="POST" class="inline-block">
                                                <input type="hidden" name="_method" value="GET">
                                                <input type="hidden" name="id" value="<?= $course['id'] ?>">
                                                <input type="hidden" name="cname" value="<?= $course['cname'] ?>">
                                                <input type="hidden" name="description" value="<?= $course['description'] ?>">
                                                <button type="submit" class="text-blue-600 hover:text-blue-800 action-btn"
                                                    title="Edit Course">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </form>

                                            <!-- Delete Button -->
                                            <form action="/dashboard/course/delete" method="POST" class="inline-block">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="id" value="<?= $course['id'] ?>">
                                                <input type="hidden" name="img" value="<?= $course['img'] ?>">
                                                <button type="submit" class="text-red-600 hover:text-red-800 action-btn"
                                                    title="Delete Course"
                                                    onclick="return confirm('Are you sure you want to delete this course?');">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center py-12">
                                        <i class="fas fa-book-open text-4xl text-gray-300 mb-3"></i>
                                        <p class="text-lg font-medium">No courses found</p>
                                        <p class="text-sm text-gray-400 mt-1">Add your first course to get started</p>
                                        <a href="/dashboard/course/create"
                                            class="mt-4 text-blue-600 hover:text-blue-800 text-sm font-medium">
                                            <i class="fas fa-plus mr-1"></i> Create New Course
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>