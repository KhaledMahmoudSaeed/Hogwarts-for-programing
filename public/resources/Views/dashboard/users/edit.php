<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: url('<?= $GLOBALS['img']->image("dashboardhogwarts.jpg") ?>') no-repeat center center fixed;
            background-size: cover;
        }

        .header-button {
            background: linear-gradient(to right, #1e3c2d, #2e7d32);
        }

        .profile-picture {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 3px solid #3b82f6;
        }

        .file-upload {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .file-upload-input {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .card-shadow {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white card-shadow bg-opacity-20 rounded-xl overflow-hidden w-full max-w-md">
        <!-- Header with blue background -->
        <div class="header-button p-6 text-center">
            <h2 class="text-2xl font-bold text-white">
                <i class="fas fa-user-edit mr-2"></i> Edit Profile
            </h2>
        </div>

        <div class="p-6">
            <form action="/dashboard/user/update" method="POST" enctype="multipart/form-data" class="space-y-6">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="<?= htmlspecialchars($_POST['id']); ?>">
                <input type="hidden" name="img" value="<?= htmlspecialchars($_POST['img']); ?>">

                <!-- Profile Picture Section -->
                <div class="flex flex-col items-center">
                    <div class="relative mb-4">
                        <?php if (!empty($_POST['img'])): ?>
                            <img src="<?= $GLOBALS['img']->image($_POST['img'], 'users'); ?>"
                                class="profile-picture rounded-full" alt="Profile Picture">
                        <?php else: ?>
                            <div class="profile-picture rounded-full bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-user text-4xl text-gray-500"></i>
                            </div>
                        <?php endif; ?>

                        <div class="file-upload mt-3">
                            <button type="button"
                                class="header-button text-white px-3 py-1 rounded-full text-sm font-medium transition">
                                <i class="fas fa-camera mr-1"></i> Change Photo
                            </button>
                            <input type="file" name="img" accept="image/*" class="file-upload-input">
                        </div>
                    </div>
                </div>

                <!-- Name Field -->
                <div>
                    <label class="block text-black font-medium mb-2">
                        <i class="fas fa-user mr-2 text-blue-500"></i> Full Name
                    </label>
                    <input type="text" name="name" value="<?= htmlspecialchars($_POST['name']); ?>"
                        class="w-full bg-gray-50 text-gray-800 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 border border-gray-300 transition"
                        required>
                </div>

                <!-- Email Field -->
                <div>
                    <label class="block text-black font-medium mb-2">
                        <i class="fas fa-envelope mr-2 text-blue-500"></i> Email Address
                    </label>
                    <input type="email" name="email" value="<?= htmlspecialchars($_POST['email']); ?>"
                        class="w-full bg-gray-50 text-gray-800 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 border border-gray-300 transition"
                        required>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col space-y-3 pt-4">
                    <button type="submit"
                        class="w-full header-button text-white font-bold py-3 px-4 rounded-lg transition flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i> Save Changes
                    </button>

                    <a href="javascript:history.back()"
                        class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-4 rounded-lg transition flex items-center justify-center">
                        <i class="fas fa-arrow-left mr-2"></i> Back
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Preview image when selected
        document.querySelector('.file-upload-input').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    const imgPreview = document.querySelector('.profile-picture');
                    if (imgPreview.tagName === 'IMG') {
                        imgPreview.src = event.target.result;
                    } else {
                        // Replace the placeholder div with an img element
                        const newImg = document.createElement('img');
                        newImg.src = event.target.result;
                        newImg.className = 'profile-picture rounded-full';
                        imgPreview.parentNode.replaceChild(newImg, imgPreview);
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>