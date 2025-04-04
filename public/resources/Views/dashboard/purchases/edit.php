<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Purchase</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">

    <div class="bg-gray-800 shadow-lg rounded-2xl p-6 w-96">
        <h2 class="text-2xl font-bold text-amber-500 mb-4 text-center">Edit Purchase</h2>

        <form action="/dashboard/purchase/update" method="POST" class="space-y-4" enctype="multipart/form-data">
            <!-- Hidden Fields -->
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']); ?>">

            <!-- Current Image Preview -->
            <div>
                <label class="block text-gray-400 font-semibold mb-2">Current Image:</label>
                <div class="flex justify-center">
                    <?php if (!empty($data['img'])): ?>
                        <img src="<?= $GLOBALS['img']->image($data['img'], 'purchases'); ?>" alt="Current Item Image"
                            class="w-32 h-32 object-cover rounded-lg border-2 border-amber-500">
                    <?php else: ?>
                        <div
                            class="w-32 h-32 bg-gray-700 rounded-lg border-2 border-dashed border-gray-600 flex items-center justify-center">
                            <span class="text-gray-400">No Image</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Image Upload -->
            <div>
                <label class="block text-gray-400 font-semibold">Update Image:</label>
                <div class="mt-2">
                    <label for="image-upload" class="cursor-pointer">
                        <div
                            class="bg-gray-700 border-2 border-dashed border-gray-600 rounded-lg p-4 hover:border-amber-500 transition-colors duration-200">
                            <div class="flex flex-col items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-sm text-gray-400 mt-2">Click to change image</span>
                                <span class="text-xs text-gray-500">(JPEG, PNG, max 2MB)</span>
                            </div>
                        </div>
                        <input id="image-upload" type="file" name="img" accept="image/*" class="hidden">
                    </label>
                </div>
                <div id="image-preview" class="mt-2 hidden">
                    <img id="preview" class="w-32 h-32 object-cover rounded-lg border-2 border-amber-500 mx-auto">
                </div>
            </div>

            <!-- Name Field -->
            <div>
                <label class="block text-gray-400 font-semibold">Name:</label>
                <input type="text" name="name" value="<?= htmlspecialchars($data['name']); ?>"
                    class="w-full bg-gray-700 text-white px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"
                    required>
            </div>

            <!-- Type Dropdown -->
            <div>
                <label class="block text-gray-400 font-semibold">Type:</label>
                <select name="type"
                    class="w-full bg-gray-700 text-white px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                    <option value="Broom" <?= $data['type'] == 'Broom' ? 'selected' : ''; ?>>Broom</option>
                    <option value="Book" <?= $data['type'] == 'Book' ? 'selected' : ''; ?>>Book</option>
                    <option value="Potion" <?= $data['type'] == 'Potion' ? 'selected' : ''; ?>>Potion</option>
                    <option value="Wand" <?= $data['type'] == 'Wand' ? 'selected' : ''; ?>>Wand</option>
                </select>
            </div>

            <!-- Price Field -->
            <div>
                <label class="block text-gray-400 font-semibold">Price:</label>
                <input type="number" name="price" value="<?= htmlspecialchars($data['price']); ?>"
                    class="w-full bg-gray-700 text-white px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"
                    required>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-amber-500 text-gray-900 px-4 py-2 rounded-lg font-semibold hover:bg-amber-400 transition">
                Save Changes
            </button>

            <!-- Back Button -->
            <a href="javascript:history.back()"
                class="block text-center mt-3 bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-gray-500 transition">
                Back
            </a>
        </form>
    </div>

    <script>
        // Image preview functionality
        document.getElementById('image-upload').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    document.getElementById('preview').src = event.target.result;
                    document.getElementById('image-preview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>

</body>

</html>