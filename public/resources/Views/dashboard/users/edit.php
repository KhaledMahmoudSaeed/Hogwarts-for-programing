<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile • Hogwarts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet" />
    <style>
        :root {
            --parchment: #f4e7c5;
            --ink: #3d2b1f;
            --gold: #daa520;
            --hover-glow: rgba(218, 165, 32, 0.6);
        }

        body {
            background: url('<?= $GLOBALS['img']->image("dashboardhogwarts.jpg") ?>') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Cinzel', serif;
            color: var(--parchment);
        }

        .card {
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(8px);
            border: 2px solid var(--gold);
            border-radius: 1rem;
            box-shadow: 0 0 20px var(--gold);
            max-width: 32rem;
            margin: auto;
            padding: 2rem;
        }

        h2 {
            color: var(--gold);
            text-shadow: 2px 2px #000;
        }

        label {
            color: var(--gold);
            font-weight: 600;
        }

        input,
        textarea,
        input[type="file"] {
            background: rgba(255, 255, 255, 0.1);
            color: #fff !important;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: .5rem;
            width: 100%;
            padding: .75rem !important;
            font-family: 'Cinzel', serif;
        }

        input:focus,
        textarea:focus {
            outline: none;
            box-shadow: 0 0 8px var(--hover-glow);
        }

        .btn-gold {
            background: linear-gradient(to right, #b8860b, var(--gold));
            color: #1e1e1e;
            padding: .5rem 1.25rem;
            border: 2px solid var(--gold);
            border-radius: .75rem;
            font-weight: 700 !important;
            transition: all .3s ease;
            font-family: 'Cinzel', serif;
        }

        .btn-gold:hover {
            background: linear-gradient(to right, var(--gold), #b8860b);
            box-shadow: 0 0 20px var(--parchment);
            color: #000;
        }

        .back-link {
            color: var(--parchment);
            text-decoration: underline;
            display: inline-block;
            margin-top: 1.5rem;
            transition: color .3s;
            font-family: 'Cinzel', serif;
        }

        .back-link:hover {
            color: var(--gold);
        }

        .profile-picture {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border: 3px solid var(--gold);
            box-shadow: 0 0 12px rgba(218, 165, 32, 0.6);
        }

        .profile-picture:hover{
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(218, 165, 32, 0.8);
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
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-6">

    <div class="card">
        <div class="text-center mb-6">
            <h2 class="text-3xl font-bold"><i class="fas fa-user-edit mr-2"></i> Edit Profile</h2>
        </div>

        <?php if ($_SESSION['role'] === "professor"): ?>
            <form action="/dashboard/user/update" method="POST" enctype="multipart/form-data" class="space-y-6">
            <?php else: ?>
                <form action="/profile" method="POST" enctype="multipart/form-data" class="space-y-6">
                <?php endif ?>
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="<?= htmlspecialchars($_POST['id']); ?>">
                <input type="hidden" name="img" value="<?= htmlspecialchars($user['img']); ?>">

                <div class="flex flex-col items-center">
                    <?php if (!empty($_POST['img'])): ?>
                        <img src="<?= $GLOBALS['img']->image($_POST['img'], 'users'); ?>"
                            class="profile-picture rounded-full" alt="Profile Picture">
                    <?php else: ?>
                        <div class="profile-picture rounded-full bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-user text-4xl text-yellow-700"></i>
                        </div>
                    <?php endif; ?>

                    <div class="file-upload mt-4">
                        <button type="button" class="btn-gold text-sm font-medium">
                            <i class="fas fa-camera mr-1"></i> Change Photo
                        </button>
                        <input type="file" name="img" accept="image/*" class="file-upload-input">
                    </div>
                </div>

                <div>
                    <label>Full Name</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($_POST['name']); ?>" required>
                </div>

                <div>
                    <label>Email Address</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($_POST['email']); ?>" required>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn-gold">
                        <i class="fas fa-wand-sparkles mr-1"></i> Save Changes
                    </button>
                </div>
            </form>

            <div class="text-center">
                <a href="javascript:history.back()" class="back-link">&larr; Back to Dashboard</a>
            </div>
    </div>

    <script>
        document.querySelector('.file-upload-input').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    const img = document.querySelector('.profile-picture');
                    if (img.tagName === 'IMG') img.src = event.target.result;
                    else {
                        const newImg = document.createElement('img');
                        newImg.src = event.target.result;
                        newImg.className = 'profile-picture rounded-full';
                        img.parentNode.replaceChild(newImg, img);
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    </script>

</body>

</html>