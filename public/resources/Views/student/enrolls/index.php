<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrolled Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8fafc;
        }

        .course-card {
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: none;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .course-img {
            height: 180px;
            object-fit: cover;
            width: 100%;
        }

        .card-header {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            font-weight: 600;
        }

        .professor-badge {
            background-color: #e0f2fe;
            color: #0369a1;
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 0.85rem;
        }

        .unenroll-btn {
            background-color: #fee2e2;
            color: #b91c1c;
            border: none;
            transition: all 0.2s;
        }

        .unenroll-btn:hover {
            background-color: #fecaca;
        }

        .quiz-btn {
            transition: all 0.2s;
        }

        .no-courses {
            background-color: #fffbeb;
            border-left: 4px solid #f59e0b;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="card border-0 shadow-lg overflow-hidden">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="fas fa-book-open me-2"></i>My Enrolled Courses</h3>
                    <a href="/enroll/create" class="btn btn-success btn-sm">
                        <i class="fas fa-plus me-1"></i> Enroll in New Course
                    </a>
                </div>
            </div>

            <div class="card-body p-4">
                <?php if (!empty($data) && count($data) > 0): ?>
                    <div class="row g-4">
                        <?php foreach ($data as $course): ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="course-card bg-white">
                                    <?php if (!empty($course['img'])): ?>
                                        <img src="<?= $GLOBALS['img']->image($course['img'], 'courses'); ?>" class="course-img"
                                            alt="<?= htmlspecialchars($course['name']) ?>">
                                    <?php else: ?>
                                        <div class="course-img bg-light d-flex align-items-center justify-content-center">
                                            <i class="fas fa-book text-muted fa-3x"></i>
                                        </div>
                                    <?php endif; ?>

                                    <div class="p-4 flex-grow-1">
                                        <h5 class="fw-bold text-dark mb-3"><?= htmlspecialchars($course['name']) ?></h5>

                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-user-tie text-primary me-2"></i>
                                            <span class="professor-badge">
                                                <?= htmlspecialchars($course['professor']) ?>
                                            </span>
                                        </div>

                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fas fa-envelope text-primary me-2"></i>
                                            <a href="mailto:<?= htmlspecialchars($course['email']) ?>"
                                                class="text-decoration-none">
                                                <?= htmlspecialchars($course['email']) ?>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="px-4 pb-4 d-flex justify-content-between align-items-center">
                                        <?php if (empty($course['quizz_finish']) || $course['quizz_finish'] !== "done"): ?>
                                            <a href="/quizz?course_id=<?= htmlspecialchars($course['cid']) ?>"
                                                class="btn btn-primary quiz-btn btn-sm">
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
                        <i class="fas fa-info-circle fa-lg me-3 text-warning"></i>
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