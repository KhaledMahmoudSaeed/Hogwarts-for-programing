<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Create Course • Hogwarts</title>
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
        }

        .card {
            background: rgba(0, 0, 0, 0.5);
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
        select,
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
        textarea:focus,
        select:focus {
            outline: none;
            box-shadow: 0 0 8px var(--gold);
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

        .btn-gold {
            background: linear-gradient(to right, #b8860b, var(--gold));
            color: #1e1e1e;
            padding: .5rem 1.25rem;
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
            <h2 class="text-3xl font-bold"><i class="fas fa-scroll mr-2"></i>Create a Course</h2>
        </div>
        <form action="/dashboard/course/store" method="POST" enctype="multipart/form-data" class="space-y-4">
            <!-- Course Title -->
            <div>
                <label for="name">Course Title</label>
                <input id="name" name="name" type="text" required />
            </div>
            <!-- Description -->
            <div>
                <label for="description">Course Description</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>
            <!-- Professor / Headmaster select -->
            <div>
                <label for="user_id">Professor In Charge</label>
                <div class="select-wrapper mt-1">
                    <select id="user_id" name="user_id" required>
                            <option value="">— Select Professor —</option>
                          <?php foreach ($data as $prof): ?>
                            <option value="<?= (int) $prof['id'] ?>"><?= htmlspecialchars($prof['name']) ?></option>
                        <?php endforeach; ?>
                        </select>
                </div>
            </div>
            <!-- Emblem Upload -->
            <div>
                <label for="img">Course Emblem</label>
                <input id="img" type="file" name="img" accept="image/*" />
            </div>
            <!-- Submit -->
            <div class="text-right">
                <button type="submit" class="btn-gold">
                    <i class="fas fa-book-reader mr-1"></i>Create Course
                </button>
            </div>
        </form>
        <div class="text-center">
            <a href="/dashboard/courses" class="back-link">&larr; Back to Courses</a>
        </div>
    </div>
</body>

</html>