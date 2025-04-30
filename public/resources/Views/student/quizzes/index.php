<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz Questions | Hogwarts Academy</title>

    <!-- Bootstrap (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons & Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Eagle+Lake&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $GLOBALS['img']->style("style.css") ?>">

    <style>
        /* === Full-page magical backdrop === */
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: url('<?= $GLOBALS['img']->image($_SESSION['house'], "users") ?>.gif') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Cinzel', serif;
            color: #f5f5dc;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* === Quiz wrapper === */
        .quiz-container {
            width: 90%;
            max-width: 800px;
            padding: 2rem;
            background: rgba(0, 0, 0, 0.6);
            border: 3px solid #d4af37;
            border-radius: 20px;
            box-shadow: 0 0 50px rgba(212, 175, 55, 0.6);
        }

        /* === Card styling === */
        .card {
            background-color: rgba(255, 255, 255, 0.09);
            border: none;
            border-radius: 15px;
        }

        .card-header {
            background: linear-gradient(45deg, #b8860b, #ffd700);
            border-radius: 15px 15px 0 0;
            text-align: center;
            padding: 1rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .card-header h3 {
            margin: 0;
            font-family: 'Eagle Lake', cursive;
            font-size: 2rem;
            color: #fff;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.3);
        }

        .card-body {
            padding: 2rem 1.5rem;
        }

        /* === Question blocks === */
        .question-card {
            background: rgba(0, 0, 0, 0.4);
            text-align: left;
            border-left: 5px solid #ffd700;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .question-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(255, 223, 0, 0.5);
        }

        .question-card h5 {
            font-size: 1.5rem;
            color: #eee8aa;
            margin-bottom: 0.5rem;
            text-shadow: 1px 1px 3px black;
        }

        .question-card p {
            font-size: 1rem;
            color: #ccc;
            margin-bottom: 1rem;
        }

        /* === Radio buttons === */
        .form-check-input {
            width: 1.2em;
            height: 1.2em;
            border: 2px solid #ffd700;
            background-color: transparent;
            transition: background 0.3s, border-color 0.3s;
        }

        .form-check-input:checked {
            background-color: #ffd700;
            border-color: #ffd700;
        }

        .form-check-label {
            font-size: 1rem;
            color: #f5f5dc;
            margin-left: 0.5rem;
        }

        /* === Submit button === */
        .btn-submit {
            font-weight: bold;
            background: linear-gradient(45deg, #b8860b, #ffd700);
            border: none;
            color: #000;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            box-shadow: 0 0 20px rgba(255, 223, 0, 0.6);
            transition: background 0.4s, box-shadow 0.4s;
        }

        .btn-submit:hover:not(:disabled) {
            background: linear-gradient(45deg, #ffcc00, #daa520);
            box-shadow: 0 0 30px rgba(255, 223, 0, 0.8);
        }

        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            box-shadow: none;
        }

        /* Back button */
        .btn-back {
            font-family: 'Cinzel', serif;
            font-weight: bold;
            background: none;
            color: #ffd700;
            border: 2px solid #ffd700;
            border-radius: 50px;
            padding: 0.6em 1.2em;
            box-shadow: 0 0 12px rgba(255, 223, 0, 0.5);
            transition: background 0.4s, color 0.4s, box-shadow 0.4s;
            text-decoration: none;
            margin-right: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4em;
        }

        .btn-back:hover {
            background: #ffd700;
            color: #000;
            box-shadow: 0 0 20px rgba(255, 223, 0, 0.8);
        }

        /* === Alert styling === */
        .alert-warning {
            background: rgba(255, 215, 0, 0.2);
            border-left: 5px solid #ffd700;
            color: #fff;
            font-size: 1.1rem;
            font-weight: 800;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="quiz-container">
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-scroll"></i> Quiz Questions</h3>
            </div>
            <div class="card-body">
                <form action="/quizz" method="POST">
                    <input type="hidden" name="user_id" value="<?= end($data);
                    array_pop($data) ?>">
                    <input type="hidden" name="course_id" value="<?= htmlspecialchars($_GET['course_id']) ?>">

                    <?php if (!empty($data)): ?>
                        <?php foreach ($data as $quizz): ?>
                            <div class="question-card">
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
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            No questions available.
                        </div>
                    <?php endif; ?>

                    <div class="text-center mt-4">
                        <a href="/enrolls" class="btn-back">
                            <i class="fas fa-arrow-left"></i> Back to Courses
                        </a>
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-paper-plane"></i> Submit Quiz
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>