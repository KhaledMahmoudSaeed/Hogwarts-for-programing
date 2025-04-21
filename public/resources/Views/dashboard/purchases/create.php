<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Purchase</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: url('<?= $GLOBALS['img']->image("dashboardhogwarts.jpg") ?>') no-repeat center center fixed;
            background-size: cover;
        }

        .hogwarts-button {
            background: linear-gradient(to right, #b8860b, #daa520);
            /* Gold gradient */
            color: #fff;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }



        .hogwarts-button:hover {
            background: linear-gradient(to right, #daa520, #b8860b);
        }

        .hogwarts-table-header {
            background: linear-gradient(to right, #1e3c2d, #2e7d32);
            /* Emerald green */
        }

        .hh {
            background: linear-gradient(to right, #daa520, #b8860b);
            padding: 10px;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col items-center py-8">

    <div class="w-full max-w-3xl bg-opacity-20 bg-white p-6 rounded-lg shadow-lg">
        <div class=" p-6 text-center">
            <h2 class="text-4xl font-bold  text-black">
                <i class="fas fa-user-circle mr-2"></i> Create a Item
            </h2>
        </div>
        <form action="/dashboard/purchase/store" method="POST" class="space-y-4" enctype="multipart/form-data">

            <!-- Item Name -->
            <div>
                <label class="block text-text-black font-semibold">Item Name:</label>
                <input type="text" name="name" required
                    class="w-full mt-2 p-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <!-- Price -->
            <div>
                <label class="block text-text-black font-semibold">Price:</label>
                <input type="number" name="price" required
                    class="w-full mt-2 p-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <!-- Type Dropdown -->
            <div>
                <label class="block text-text-black font-semibold">Select Type:</label>
                <select name="type" required class="w-full mt-2 p-2 border rounded-md focus:ring focus:ring-blue-300">
                    <option value="">-- Choose Type --</option>
                    <option value="Broom">Broom</option>
                    <option value="Book">Book</option>
                    <option value="Potion">Potion</option>
                    <option value="Wand">Wand</option>
                </select>
            </div>

            <!-- Image Upload -->
            <div>
                <label class="block text-text-black font-semibold">Item Image:</label>
                <div class="mt-2 flex items-center">
                    <label for="image-upload" class="cursor-pointer">
                        <div
                            class="w-32 h-32 border-2 border-dashed border-black rounded-md flex items-center justify-center hover:border-blue-400 transition-colors duration-200">
                            <div class="text-center p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-black" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-sm text-black">Click to upload</span>
                            </div>
                        </div>
                        <input id="image-upload" type="file" name="img" accept="image/*" class="hidden">
                    </label>
                    <div class="ml-4 text-sm text-black">
                        <p>Upload an image of your magical item</p>
                        <p class="text-xs">(JPEG, PNG, max 2MB)</p>
                    </div>
                </div>
                <div id="image-preview" class="mt-2 hidden">
                    <img id="preview" class="w-32 h-32 object-cover rounded-md border">
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="hogwarts-button hover:bg-gold px-4 py-2 rounded-lg shadow-md transition flex items-center whitespace-nowrap">
                    <i class="fas fa-plus mr-2"></i> Add New Item
                </button>
            </div>
        </form>

        <!-- Back Button -->
        <div class="mt-4 text-center">
            <a href="/dashboard/purchases" class="text-green hh button"> Back to Purchases</a>
        </div>
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