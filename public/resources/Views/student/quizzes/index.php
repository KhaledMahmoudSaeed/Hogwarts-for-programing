<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Questions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .quiz-container {
            max-width: 800px;
            margin: auto;
        }

        .question-card {
            border-left: 5px solid #007bff;
            padding: 15px;
            border-radius: 10px;
            background-color: #f8f9fa;
            transition: transform 0.2s ease-in-out;
        }

        .question-card:hover {
            transform: scale(1.02);
        }
    </style>
</head>

<body class="bg-light">
    <div class="container mt-5 quiz-container">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h3>Quiz Questions</h3>
            </div>
            <div class="card-body">
                <?php if (!empty($data)): ?>
                    <form action="/quizz" method="POST">
                        <input type="hidden" name="user_id" value="<?= $data[2]['user_id'];
                        array_pop($data) ?>"><!-- get the user id-->
                        <input type="hidden" name="course_id" value="<?= $_GET['course_id'] ?>">
                        <?php foreach ($data as $quizz): ?>
                            <div class="mb-3 question-card shadow-sm">
                                <h5><?= htmlspecialchars($quizz['question']) ?></h5>
                                <p><strong>Points:</strong> <?= htmlspecialchars($quizz['points']) ?></p>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer[<?= $quizz['id'] ?>]" value="true"
                                        required>
                                    <label class="form-check-label">True</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer[<?= $quizz['id'] ?>]"
                                        value="false" required>
                                    <label class="form-check-label">False</label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <button type="submit" class="btn btn-success">Submit Quiz</button>
                    </form>
                <?php else: ?>
                    <div class="alert alert-warning text-center">No questions available.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>