<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Enroll in a New Course | Hogwarts Academy</title>

    <!-- Tailwind CSS (optional) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Eagle+Lake&display=swap" rel="stylesheet">

    <style>
        /* === Full‐page backdrop === */
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('<?= $GLOBALS['img']->image($_SESSION['house'], "users") ?>.gif') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Cinzel', serif;
            color: #f5f5dc;
        }

        /* === Parchment container === */
        .container-all {
            background-color: rgba(0, 0, 0, 0.7);
            border: 3px solid #d4af37;
            border-radius: 20px;
            padding: 2.5rem 2rem;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 0 50px rgba(212, 175, 55, 0.5);
        }

        /* === Header styling === */
        h2 {
            font-size: 2.25rem !important;
            font-weight: 800 !important;
            color: #ffd700;
            text-align: center;
            margin-bottom: 1.5rem !important;
        }

        /* === Form labels === */
        label {
            display: block;
            font-size: 1.25rem;
            font-weight: 400;
            color: #ffd700;
            margin-bottom: 0.5rem;
        }

        /* === Select dropdown === */
        select {
            width: 100%;
            padding: 0.6rem !important;
            font-size: 1rem !important;
            background: rgba(0, 0, 0, 0.5);
            border: 2px solid rgba(255, 215, 0, 0.4);
            border-radius: 8px;
            color: #ccc !important;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        select:focus {
            outline: none;
            border-color: #ffd700;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.6);
        }

        select option {
            background: #000;
            color: #f5f5dc;
        }

        /* === Buttons === */
        .btn {
            font-family: 'Cinzel', serif;
            font-weight: bold;
            border-radius: 50px;
            padding: 0.6em 1.2em;
            border: 2px solid #fff8dc !important;
            box-shadow: 0 0 12px rgba(255, 215, 0, 0.5);
            transition: all 0.4s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.4em;
            text-decoration: none;
            justify-content: center;
        }

        .submit-btn {
            background: linear-gradient(45deg, #b8860b, #ffd700);
            color: #000;
            margin-top: 1rem;
            border: none;
        }

        .submit-btn:hover {
            background: linear-gradient(45deg, #ffcc00, #daa520);
            box-shadow: 0 0 20px #ffd700, 0 0 5px #fff;
        }

        .back-btn {
            background: none;
            color: #ffd700;
            margin-top: 2rem;
            font-size: 0.95rem;
        }

        .back-btn:hover {
            background: linear-gradient(45deg, #ffcc00, #daa520);
            color: #000;
            box-shadow: 0 0 20px #ffd700, 0 0 5px #fff;
        }

        /* === Form layout spacing === */
        form>div {
            margin-bottom: 1.5rem;
        }

        /* === Responsive tweak === */
        @media (max-width: 480px) {
            .container-all {
                padding: 2rem 1.5rem;
            }

            h2 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>
    <div class="container-all">
        <h2><i class="fas fa-hat-wizard"></i> Enroll in a New Course</h2>

        <form action="/enroll/store" method="POST">
            <input type="hidden" name="user_id" value="<?= end($data);
            array_pop($data) ?>">

            <!-- Course Selection -->
            <div>
                <label for="course_id"><i class="fas fa-book-open"></i> Select Course:</label>
                <select id="course_id" name="course_id" required>
                    <option value="" disabled selected>-- Choose Course --</option>
                    <?php foreach ($data as $course): ?>
                        <option value="<?= htmlspecialchars($course['id']); ?>">
                            <?= htmlspecialchars($course['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Submit -->
            <div class="text-right">
                <button type="submit" class="btn submit-btn">
                    <i class="fas fa-plus-circle"></i> Enroll Now
                </button>
            </div>
        </form>

        <!-- Back Link -->
        <div class="text-center">
            <a href="/enrolls" class="btn back-btn">
                <i class="fas fa-arrow-left"></i> Back to My Courses
            </a>
        </div>
    </div>
</body>

</html>