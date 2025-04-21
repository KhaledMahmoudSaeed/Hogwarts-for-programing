<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrolled Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= $GLOBALS['img']->style("style.css") ?>">

    <style>
        /* General Styles */
        body {
            background: url('<?= $GLOBALS['img']->image($_SESSION['house'], "users") . ".gif" ?>') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Cinzel', serif;
            /* Magical font */
            color: #fff;
        }

        /* Container Styling */
        .container-all {
            background: rgba(0, 0, 0, 0.7);
            /* Dark overlay */
            border-radius: 15px;
            padding: 2rem;
            margin-top: 2rem;
        }

        /* Header Styling */
        .card-header {
            background: linear-gradient(135deg, #f7b924, #d3a625);
            /* Golden yellow gradient */
            color: #fff;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .card-header h3 {
            font-family: 'Eagle Lake', cursive;
            /* Cursive font for title */
            font-size: 1.75rem;
        }

        /* Course Card Styling */
        .course-card {
            background: rgba(255, 255, 255, 0.1);
            /* Semi-transparent background */
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(255, 215, 0, 0.5);
            /* Golden shadow on hover */
        }

        .course-img {
            height: 180px;
            object-fit: cover;
            width: 100%;
        }

        .course-img.bg-light {
            background: rgba(255, 255, 255, 0.1);
            /* Match card background */
        }

        /* Professor Badge Styling */
        .professor-badge {
            background-color: rgba(255, 215, 0, 0.3);
            /* Golden yellow badge */
            color: #fff;
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 0.85rem;
        }

        /* Buttons Styling */
        .btn-success {
            background: linear-gradient(135deg, #f7b924, #d3a625);
            /* Golden yellow gradient */
            border: none;
            color: #fff;
            font-weight: bold;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #e6a819, #c2951e);
            /* Darker gradient on hover */
        }

        .quiz-btn {
            background: linear-gradient(135deg, #4ade80, #22c55e);
            /* Green gradient */
            border: none;
            color: #fff;
            font-weight: bold;
        }

        .quiz-btn:hover {
            background: linear-gradient(135deg, #34d399, #16a34a);
            /* Darker green gradient on hover */
        }

        .unenroll-btn {
            background: rgba(255, 0, 0, 0.3);
            /* Red tint */
            color: #fff;
            border: none;
            font-weight: bold;
        }

        .unenroll-btn:hover {
            background: rgba(255, 0, 0, 0.5);
            /* Brighter red on hover */
        }

        /* No Courses Alert Styling */
        .no-courses {
            background-color: rgba(255, 215, 0, 0.3);
            /* Golden yellow background */
            border-left: 4px solid #f7b924;
            /* Solid golden border */
            color: #fff;
            font-family: 'Cinzel', serif;
        }

        .no-courses i {
            color: #f7b924;
            /* Golden icon */
        }

        /* Hover Effects */
        a:hover {
            text-decoration: none;
            color: #f7b924;
            /* Golden text on hover */
        }
    </style>
</head>

<body>
    <?php
    require __DIR__ . "/../../layout/navbar.view.php"
        ?>
    <div class="container-all py-5">
        <div class="card border-0 shadow-lg overflow-hidden">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center text-black">
                    <h3 class="mb-0"><i class="fas fa-book-open me-2 text-black"></i>My Enrolled Courses</h3>
                    <a href="/enroll/create" class="btn btn-success btn-sm text-black">
                        <i class="fas fa-plus me-1 text-black"></i> Enroll in New Course
                    </a>
                </div>
            </div>

            <div class="card-body p-4 bg-black">
                <?php if (!empty($data) && count($data) > 0): ?>
                    <div class="row g-4">
                        <?php foreach ($data as $course): ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="course-card">
                                    <?php if (!empty($course['img'])): ?>
                                        <img src="<?= $GLOBALS['img']->image($course['img'], 'courses'); ?>" class="course-img"
                                            alt="<?= htmlspecialchars($course['name']) ?>">
                                    <?php else: ?>
                                        <div class="course-img bg-light d-flex align-items-center justify-content-center">
                                            <i class="fas fa-book text-muted fa-3x"></i>
                                        </div>
                                    <?php endif; ?>

                                    <div class="p-4 flex-grow-1">
                                        <h5 class="fw-bold text-white mb-3"><?= htmlspecialchars($course['name']) ?></h5>

                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-user-tie text-warning me-2"></i>
                                            <span class="professor-badge">
                                                <?= htmlspecialchars($course['professor']) ?>
                                            </span>
                                        </div>

                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fas fa-envelope text-warning me-2"></i>
                                            <a href="mailto:<?= htmlspecialchars($course['email']) ?>"
                                                class="text-decoration-none text-warning">
                                                <?= htmlspecialchars($course['email']) ?>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="px-4 pb-4 d-flex justify-content-between align-items-center">
                                        <?php if (empty($course['quizz_finish']) || $course['quizz_finish'] !== "done"): ?>
                                            <a href="/quizz?course_id=<?= htmlspecialchars($course['cid']) ?>"
                                                class="btn quiz-btn btn-sm">
                                                <i class="fas fa-pen-alt me-1"></i> Take Quiz
                                            </a>
                                        <?php else: ?>
                                            <span class="badge bg-success">
                                                <i class="fas fa-check-circle me-1"></i> Quiz Completed
                                            </span>
                                        <?php endif; ?>

                                        <form action="/enroll/delete" method="POST" class="d-inline">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($course['id']) ?>">
                                            <button type="submit" class="btn unenroll-btn btn-sm">
                                                <i class="fas fa-trash-alt me-1"></i> Unenroll
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="alert no-courses d-flex align-items-center" role="alert">
                        <i class="fas fa-info-circle fa-lg me-3"></i>
                        <div>
                            <h5 class="alert-heading mb-1">No courses enrolled yet!</h5>
                            <p class="mb-0">Get started by enrolling in your first course.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>