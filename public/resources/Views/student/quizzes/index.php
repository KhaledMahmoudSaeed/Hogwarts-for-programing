<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Questions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $GLOBALS['img']->style("style.css") ?>">

    <style>
        /* General Reset */
        body {
            background: url('<?= $GLOBALS['img']->image($_SESSION['house'], "users") . ".gif" ?>') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Cinzel', serif;
            color: #fff;
        }

        /* Quiz Container Styling */
        .quiz-container {
            max-width: 800px;
            margin: auto;
            padding: 2rem;
        }

        /* Card Styling */
        .card {
            background: rgba(0, 0, 0, 0.7);
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        /* Card Header Styling */
        .card-header {
            background: linear-gradient(135deg, #f7b924, #d3a625);
            color: #fff;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            border-radius: 15px 15px 0 0;
        }

        .card-header h3 {
            font-family: 'Eagle Lake', cursive;
            font-size: 1.75rem;
        }

        /* Question Card Styling */
        .question-card {
            background: rgba(255, 255, 255, 0.1);
            border-left: 5px solid #f7b924;
            padding: 15px;
            border-radius: 10px;
            transition: transform 0.2s ease-in-out;
            margin-bottom: 1rem;
        }

        .question-card:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 20px rgba(255, 215, 0, 0.5);
        }

        .question-card h5 {
            font-size: 1.25rem;
            color: #fff;
        }

        .question-card p {
            font-size: 1rem;
            color: #ccc;
        }

        /* Radio Buttons Styling */
        .form-check-input {
            border: 2px solid #f7b924;
            background-color: transparent;
        }

        .form-check-input:checked {
            background-color: #f7b924;
            border-color: #f7b924;
        }

        .form-check-label {
            color: #fff;
        }

        /* Submit Button Styling */
        .btn-success {
            background: linear-gradient(135deg, #f7b924, #d3a625);
            border: none;
            color: #fff;
            font-weight: bold;
            padding: 0.8rem 1.5rem;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #e6a819, #c2951e);
        }

        /* Alert Styling */
        .alert-warning {
            background: rgba(255, 215, 0, 0.3);
            border-left: 4px solid #f7b924;
            color: #fff;
            font-family: 'Cinzel', serif;
        }
    </style>
</head>

<body>
    <?php
    require __DIR__ . "/../../layout/navbar.view.php"
        ?>
    <div class="container mt-5 quiz-container">
        <div class="card shadow-lg">
            <div class="card-header text-center">
                <h3>Quiz Questions</h3>
            </div>
            <div class="card-body">
                <?php if (!empty($data)): ?>
                    <form action="/quizz" method="POST">
                        <input type="hidden" name="user_id" value="<?= end($data);
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