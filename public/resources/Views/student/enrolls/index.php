<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enrolled Courses</title>

    <!-- Global Styles -->
    <link rel="stylesheet" href="<?= $GLOBALS['img']->style("navbar.css") ?>">
    <link rel="stylesheet" href="<?= $GLOBALS['img']->style("style.css") ?>">
    <!-- Icons + Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">

    <style>
        /* Page background and default text */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Cinzel', serif;
            color: #fff;
        }
        
        /* Wrapper for the dark overlay + centered container */
        #courses-page {
            background: url('<?= $GLOBALS['img']->image($_SESSION['house'], "users") ?>.gif') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
        }

        #courses-page .overlay {
            flex: 1;
            display: flex;
            justify-content: center;
            padding: 3rem 1rem;
        }

        /* Main content box */
        .container-all {
            background: rgba(0, 0, 0, 0.85);
            border: 2px solid goldenrod;
            border-radius: 15px;
            width: 100%;
            max-width: 1000px;
            padding: 2rem;
            box-shadow: 0 0 30px rgba(255, 215, 0, 0.4);
        }

        /* Header Bar */
        .courses-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .courses-header h3 {
            margin: 0;
            font-size: 1.8rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .btn-enroll {
            font-family: 'Cinzel', serif;
            background: linear-gradient(135deg, #f7b924, #d3a625);
            border: none;
            color: #000;
            padding: 0.5em 1em;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .btn-enroll:hover {
            background: linear-gradient(135deg, #e6a819, #c2951e);
        }

        /* Grid of course‑cards */
        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        /* Individual course card */
        .course-card {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(255, 215, 0, 0.5);
        }

        .course-img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .course-img.bg-light {
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .course-body {
            flex: 1;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .course-body h5 {
            margin: 0 0 0.75rem;
            font-size: 1.2rem;
        }

        .course-meta {
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .professor-badge {
            background: rgba(255, 215, 0, 0.3);
            color: #fff;
            padding: 2px 6px;
            border-radius: 12px;
            font-size: 0.8rem;
        }

        /* Footer actions */
        .course-actions {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-quiz,
        .btn-unenroll {
            font-family: 'Cinzel', serif;
            padding: 0.4em 0.8em;
            border-radius: 6px;
            border: 1px solid transparent;
            color: #fff;
            transition: background 0.3s;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 0.3em;
        }

        .btn-quiz {
            background: #22c55e
        }

        .btn-quiz:hover {
            background: #16a34a
        }

        .btn-unenroll {
            background: rgba(255, 0, 0, 0.3);
        }

        .btn-unenroll:hover {
            background: rgba(255, 0, 0, 0.5);
        }

        /* No‑courses message */
        .no-courses {
            background: rgba(255, 215, 0, 0.3);
            border-left: 4px solid #f7b924;
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            border-radius: 8px;
            font-family: 'Cinzel', serif;
        }

        .no-courses i {
            font-size: 1.5rem;
            color: #f7b924;
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
                    <h3><i class="fas fa-book-open"></i> My Enrolled Courses</h3>
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
                                        <span class="professor-badge"><?= htmlspecialchars($course['professor']) ?></span><br>
                                        <a href="mailto:<?= htmlspecialchars($course['email']) ?>"
                                            style="color:#f7b924; text-decoration:none;">
                                            <i class="fas fa-envelope"></i> <?= htmlspecialchars($course['email']) ?>
                                        </a>
                                    </div>
                                </div>

                                <div class="course-actions">
                                    <?php if (empty($course['quizz_finish']) || $course['quizz_finish'] !== 'done'): ?>
                                        <a href="/quizz?course_id=<?= $course['cid'] ?>" class="btn btn-quiz">
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
                                        <button type="submit" class="btn btn-unenroll">
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
                            <strong>No courses enrolled yet!</strong><br>
                            Get started by enrolling in your first course.
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <!-- Optional JS for future interactions -->
</body>

</html>