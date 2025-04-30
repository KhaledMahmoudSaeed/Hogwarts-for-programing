<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Enchanted Courses | Hogwarts Academy</title>

    <!-- Global Styles -->
    <link rel="stylesheet" href="<?= $GLOBALS['img']->style("navbar.css") ?>">
    <link rel="stylesheet" href="<?= $GLOBALS['img']->style("style.css") ?>">
    <!-- Icons + Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">

    <style>
        /* Overall page setup */
        #courses-page {
            background: url('<?= $GLOBALS['img']->image($_SESSION['house'], "users") ?>.gif') no-repeat fixed;
            background-size: cover;
            color: #f5f5dc;
            font-family: 'Cinzel', serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        #courses-page .overlay {
            flex: 1;
            display: flex;
            justify-content: center;
            padding: 3rem 1rem;
        }

        /* Container styled like an ancient parchment */
        .container-all {
            background: rgba(0, 0, 0, 0.7);
            border: 3px solid #d4af37;
            border-radius: 20px;
            padding: 2rem;
            max-width: 1100px;
            width: 100%;
            box-shadow: 0 0 50px rgba(212, 175, 55, 0.5);
        }

        /* Header with ancient scroll effect */
        .courses-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            border-bottom: 2px solid goldenrod;
            padding-bottom: 1rem;
        }

        .courses-header h3 {
            font-size: 2rem;
            color: goldenrod;
            text-shadow: 2px 2px 5px black;
        }

        /* Enroll button - magical sparkle */
        .btn-enroll {
            background: linear-gradient(45deg, #b8860b, #ffd700);
            color: #000;
            font-weight: bold;
            padding: 0.6em 1.2em;
            border-radius: 50px;
            border: 2px solid #fff8dc;
            box-shadow: 0 0 15px #ffd700;
            transition: all 0.4s ease;
            font-family: 'Cinzel', serif;
            text-decoration: none;
        }

        .btn-enroll:hover {
            background: linear-gradient(45deg, #ffcc00, #daa520);
            box-shadow: 0 0 25px #ffd700, 0 0 5px #fff;
        }

        /* Grid layout for courses */
        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        /* Course Card - old spellbook feel */
        .course-card {
            background: rgba(0, 0, 0, 0.4);
            border: 2px solid goldenrod;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.2);
            transition: transform 0.4s, box-shadow 0.4s;
        }

        .course-card:hover {
            transform: scale(1.03);
            box-shadow: 0 0 20px rgba(255, 223, 0, 0.6);
        }

        /* Course Image */
        .course-img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-bottom: 2px solid goldenrod;
        }

        /* Fallback course image background */
        .course-img.bg-light {
            background: rgba(255, 215, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Course Body */
        .course-body {
            padding: 1rem;
            display: flex;
            flex-direction: column;
        }

        .course-body h5 {
            margin: 0 0 1rem;
            font-size: 1.4rem;
            color: #f0e68c;
            text-shadow: 1px 1px 3px black;
        }

        .course-meta {
            font-size: 1rem;
            color: #eee8aa;
        }

        /* Professor Badge */
        .professor-badge {
            background: #8b4513;
            color: #ffd700;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
        }


        /* Course Actions (Quiz / Unenroll buttons) */
        .course-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.8rem 1rem;
            border-top: 1px solid goldenrod;
            margin-top: auto;
            gap: 1rem;
        }

        /* Quiz Button */
        .btn-quiz {
            background: #228b22;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 0.7rem 1rem;
            font-family: 'Cinzel', serif;
            font-weight: bold;
            box-shadow: 0 0 10px #32cd32;
            transition: background 0.3s;
        }

        .btn-quiz:hover {
            background: #006400;
        }

        /* Unenroll Button */
        .btn-unenroll {
            background: rgba(139, 0, 0, 0.8) !important;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 0.7rem 1rem;
            font-family: 'Cinzel', serif;
            font-weight: bold;
            transition: background 0.3s;
        }

        .btn-unenroll:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            box-shadow: none;
        }

        .btn-unenroll:hover:not(:disabled) {
            background: rgba(178, 34, 34, 0.9) !important;
        }

        /* Empty Courses Notice */
        .no-courses {
            background: rgba(218, 165, 32, 0.2);
            border-left: 5px solid goldenrod;
            padding: 1.2rem;
            border-radius: 10px;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            color: #ffebcd;
            text-shadow: 1px 1px 2px black;
            text-align: left;
        }

        .no-courses i {
            color: #ffd700;
            font-size: 2rem;
        }
        .no-courses div>p{
            color: #bbb;
            margin-left: 10px;
        }
    </style>
</head>

<body>

    <?php require __DIR__ . "/../../layout/navbar.view.php"; ?>

    <section id="courses-page">
        <div class="overlay">
            <div class="container-all">

                <!-- Page Header -->
                <div class="courses-header">
                    <h3><i class="fas fa-hat-wizard"></i> My Courses</h3>
                    <a href="/enroll/create" class="btn-enroll">
                        <i class="fas fa-plus"></i> Enroll in New Course
                    </a>
                </div>

                <!-- Courses Grid -->
                <?php if (!empty($data)): ?>
                    <div class="courses-grid">
                        <?php foreach ($data as $course): ?>
                            <div class="course-card">

                                <?php if (!empty($course['img'])): ?>
                                    <img src="<?= $GLOBALS['img']->image($course['img'], 'courses') ?>"
                                        alt="<?= htmlspecialchars($course['name']) ?>" class="course-img">
                                <?php else: ?>
                                    <div class="course-img bg-light">
                                        <i class="fas fa-book text-muted fa-3x"></i>
                                    </div>
                                <?php endif; ?>

                                <div class="course-body">
                                    <h5><?= htmlspecialchars($course['name']) ?></h5>
                                    <div class="course-meta">
                                        <span
                                            class="professor-badge"><?= htmlspecialchars($course['professor']) ?></span><br><br>
                                        <a href="mailto:<?= htmlspecialchars($course['email']) ?>"
                                            style="color:#f7b924; text-decoration:none;">
                                            <i class="fas fa-envelope"></i> <?= htmlspecialchars($course['email']) ?>
                                        </a>
                                    </div>
                                </div>

                                <div class="course-actions">
                                    <?php if ((int) $course['quiz_count'] === 0): ?>
                                        <!-- No quizzes at all -->
                                        <span style="color:#bbb; font-style:italic;">
                                            No Quizzes Available
                                        </span>
                                    <?php elseif ($course['quizz_finish'] !== 'done'): ?>
                                        <a href="/quizz?course_id=<?= $course['cid'] ?>" class="btn-quiz">
                                            <i class="fas fa-pen-alt"></i> Take Quiz
                                        </a>

                                    <?php else: ?>
                                        <span style="color:#4ade80; font-weight:bold;">
                                            <i class="fas fa-check-circle"></i> Quiz Completed
                                        </span>
                                    <?php endif; ?>

                                    <form action="/enroll/delete" method="POST" style="margin:0;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($course['id']) ?>">
                                        <button type="submit" class="btn-unenroll btn" <?= $course['quizz_finish'] === 'done' ? 'disabled' : '' ?>>
                                            <i class="fas fa-trash-alt"></i> Unenroll
                                        </button>
                                    </form>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="no-courses">
                        <i class="fas fa-info-circle"></i>
                        <div>
                            <h4>No courses enrolled yet!</h4>
                            <p>Get started by enrolling in your first course.</p>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <!-- Optional JS for future magical interactions -->
</body>

</html>