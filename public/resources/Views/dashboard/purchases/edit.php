<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Purchase • Hogwarts</title>
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
            backdrop-filter: blur(10px);
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

        .item-image {
            width: 100px;
            height: 100px;
            margin-top: 10px;
            object-fit: cover;
            border: 3px solid var(--gold);
            box-shadow: 0 0 12px rgba(218, 165, 32, 0.6);
        }

        .item-image:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(218, 165, 32, 0.8);
        }

        label {
            color: var(--gold);
            font-weight: 600;
        }

        input[type="text"],
        input[type="number"],
        select {
            background: rgba(255, 255, 255, 0.1);
            color: #fff !important;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: .5rem;
            width: 100%;
            padding: .75rem !important;
            font-family: 'Cinzel', serif;
            transition: box-shadow .2s;
        }

        input:focus,
        select:focus {
            outline: none;
            box-shadow: 0 0 8px var(--hover-glow);
        }

        /* ====== PARCHMENT-STYLE OPTIONS ====== */
        select {
            /* hide native arrow */
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            position: relative;
        }

        select option {
            background: #000;
            padding: .5rem 1rem;
            font-family: 'Cinzel', serif;
        }

        select option:hover {
            background: var(--hover-glow);
            color: #000;
        }

        /* add your own arrow */
        .select-wrapper {
            position: relative;
        }

        .select-wrapper::after {
            content: '\f0d7';
            /* FontAwesome caret-down */
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            top: 50%;
            right: 1rem;
            transform: translateY(-50%);
            pointer-events: none;
            color: var(--ink);
            text-shadow: 0 0 4px rgba(255, 255, 255, 0.8);
        }


        .file-wrapper {
            display: flex;
            flex-direction: column;
            border: 2px dashed var(--gold);
            border-radius: .5rem;
            padding: 1rem;
            cursor: pointer;
            text-align: center;
            transition: box-shadow .3s;
        }

        .file-wrapper:hover {
            box-shadow: 0 0 10px var(--hover-glow);
        }

        #preview {
            margin-top: 1rem;
            border: 2px solid var(--gold);
            border-radius: .5rem;
        }

        .btn-gold {
            background: linear-gradient(to right, #b8860b, var(--gold));
            color: #1e1e1e;
            padding: .5rem 1.5rem;
            border: 2px solid var(--gold);
            border-radius: .75rem;
            font-weight: 700;
            box-shadow: 0 0 10px var(--gold);
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
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-6">
    <div class="card">
        <div class="text-center mb-6">
            <h2 class="text-3xl font-bold"><i class="fas fa-scroll mr-2"></i>Edit Magical Item</h2>
        </div>

        <form action="/dashboard/purchase/update" method="POST" enctype="multipart/form-data" class="space-y-4">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']); ?>">
            <input type="hidden" name="img" value="<?= htmlspecialchars($data['img']); ?>">

            <!-- Current Image -->
            <div>
                <label>Current Item Image</label>
                <div class="flex justify-center mb-4">
                    <?php if (!empty($data['img'])): ?>
                        <img src="<?= $GLOBALS['img']->image($data['img'], 'items'); ?>" class="item-image rounded-lg">
                    <?php else: ?>
                        <div class="item-image rounded-lg bg-gray-200 flex items-center justify-center">
                            <span>No Image</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Name -->
            <div>
                <label for="name">Item Name</label>
                <input id="name" type="text" name="name" value="<?= htmlspecialchars($data['name']); ?>" required>
            </div>
            <?php if (isset($_SESSION['errors']['name'])): ?>
                <div class="mt-4 p-3 bg-white/10 border border-indigo-400 rounded-md" style="border-color: #b8860b;">
                    <label class="text-red-700 text-x font-bold block">
                        <ul class="list-disc pl-5 space-y-1">
                            <li><?php echo htmlspecialchars($_SESSION['errors']['name']); ?></li>
                        </ul>
                    </label>
                </div>
                <?php unset($_SESSION['errors']['name']); endif; ?>

            <!-- Type -->
            <div>
                <label for="type">Item Type</label>
                <div class="select-wrapper mt-1">
                    <select id="type" name="type">
                        <option value="Broom" <?= $data['type'] == 'Broom' ? 'selected' : '' ?>>Broom</option>
                        <option value="Book" <?= $data['type'] == 'Book' ? 'selected' : '' ?>>Book</option>
                        <option value="Potion" <?= $data['type'] == 'Potion' ? 'selected' : '' ?>>Potion</option>
                        <option value="Wand" <?= $data['type'] == 'Wand' ? 'selected' : '' ?>>Wand</option>
                    </select>
                </div>
            </div>

            <!-- Price -->
            <div>
                <label for="price">Price (galleons)</label>
                <input id="price" type="number" name="price" min="1" value="<?= htmlspecialchars($data['price']); ?>"
                    required>
            </div><?php if (isset($_SESSION['errors']['number'])): ?>
                <div class="mt-4 p-3 bg-white/10 border border-indigo-400 rounded-md" style="border-color: #b8860b;">
                    <label class="text-red-700 text-x font-bold block">
                        <ul class="list-disc pl-5 space-y-1">
                            <li><?php echo htmlspecialchars($_SESSION['errors']['number']); ?></li>
                        </ul>
                    </label>
                </div>
                <?php unset($_SESSION['errors']['number']); endif; ?>

            <!-- Change Image -->
            <div>
                <label>Change Item Image</label>
                <label class="file-wrapper" for="img">
                    <i class="fas fa-file-image fa-2x mb-2" style="color:var(--gold)"></i>
                    <p>Click to upload a magical item image</p>
                    <input id="img" class="file-input" type="file" name="img" accept="image/*" hidden>
                    <img id="preview" src="" alt="Preview" class="hidden w-32 h-32 object-cover mx-auto" />
                </label>
            </div>

            <!-- Submit -->
            <div class="text-right">
                <button type="submit" class="btn-gold">
                    <i class="fas fa-wand-sparkles mr-1"></i>Save Changes
                </button>
            </div>

            <div class="text-center">
                <a href="/dashboard/purchases" class="back-link">&larr; Back to Purchases</a>
            </div>
        </form>
    </div>

    <script>
        const input = document.getElementById('img');
        const preview = document.getElementById('preview');
        input.addEventListener('change', e => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = ev => {
                    preview.src = ev.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>