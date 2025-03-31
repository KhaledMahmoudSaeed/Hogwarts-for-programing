<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrolled Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .course-card {
            border-left: 5px solid #007bff;
            padding: 15px;
            border-radius: 10px;
            background-color: #f8f9fa;
            transition: transform 0.2s ease-in-out;
        }

        .course-card:hover {
            transform: scale(1.02);
        }

        .unenroll-btn {
            background-color: #dc3545;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.2s ease-in-out;
        }

        .unenroll-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h3>Enrolled Courses</h3>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                    <a href="/enroll/create" class="btn btn-success">➕ Enroll in a Course</a>
                </div>
                <?php if (!empty($data) && count($data) > 0): ?>
                    <div class="row">
                        <?php foreach ($data as $course): ?>
                            <div class="col-md-6 mb-3">
                                <div class="course-card p-3 shadow-sm">
                                    <h5 class="text-primary"> <?= htmlspecialchars($course['name']) ?> </h5>
                                    <p><strong>Professor:</strong> <?= htmlspecialchars($course['professor']) ?></p>
                                    <p><strong>Email:</strong>
                                        <a href="mailto:<?= htmlspecialchars($course['email']) ?>">
                                            <?= htmlspecialchars($course['email']) ?>
                                        </a>
                                    </p>

                                    <!-- "Go to Quiz" Button -->
                                    <?php if (empty($course['quizz_finish']) || $course['quizz_finish'] !== "done"): ?>
                                        <a href="/quizz?course_id=<?= htmlspecialchars($course['cid']) ?>" class="btn btn-primary">
                                            📝 Go to Quiz
                                        </a>
                                    <?php else: ?>
                                        <button class="btn btn-secondary" disabled>Quiz Completed</button>
                                    <?php endif; ?>


                                    <!-- Unenroll Form -->
                                    <form action="/enroll/delete" method="POST" class="mt-2">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($course['id']) ?>">
                                        <button type="submit" class="unenroll-btn text-white">Unenroll</button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning text-center">No courses enrolled.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>