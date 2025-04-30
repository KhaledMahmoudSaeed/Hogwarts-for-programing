<?php
// Start session and include necessary files

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recipient_email'])) {
    $recipient_email = trim($_POST['recipient_email']);

    if (!empty($recipient_email)) {
        // In a real app, you would validate the email and check if the user exists
        // $query = "SELECT id, email, username FROM users WHERE email = ? AND id != ?";
        // $stmt = $pdo->prepare($query);
        // $stmt->execute([$recipient_email, $_SESSION['user_id']]);
        // $recipient = $stmt->fetch(PDO::FETCH_ASSOC);

        // For demo purposes, we'll simulate a found user
        $recipient = [
            'id' => 2, // This would come from database
            'email' => $recipient_email,
            'username' => ucfirst(explode('@', $recipient_email)[0]) // Simulate username
        ];

        if ($recipient) {
            // Redirect to chat page with recipient info
            header("Location: owl_post.php?recipient=" . $recipient['id'] . "&email=" . urlencode($recipient['email']));
            exit();
        } else {
            $error = "No wizard found with that email address in our Owl Post records.";
        }
    } else {
        $error = "Please enter an email address";
    }
}// Check if there's an error message in the session
$errorMessage = isset($_SESSION['Owl_error']) ? $_SESSION['Owl_error'] : null;

// Clear the error message after displaying it (optional, to avoid showing it again on page refresh)
if ($errorMessage) {
    unset($_SESSION['Owl_error']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owl Post - Find Recipient</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?= $GLOBALS['img']->style("style.css") ?>">

    <style>
        /* Body Styling */
        body {
            background: url('<?= $GLOBALS['img']->image("landing.png") ?>') no-repeat center center fixed;
            background-size: cover;
        }

        /* Container Styling */
        .container-chat {
            background: rgba(0, 0, 0, 0.7);
            padding: 2rem;
            border-radius: 10px;
            max-width: 500px;
            width: 90%;
            margin: 3rem auto;
            border: 2px solid var(--gold);
            box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.8),
                0 0 40px rgba(212, 175, 55, 0.6);
        }

        /* Owl Icon Styling */
        .owl-icon-large {
            width: 150px;
            margin-bottom: 1rem;
            filter: drop-shadow(1px 1px 5px rgba(221, 133, 45, 0.7));
            animation: float 4s ease-in-out infinite;
        }

        /* Shadow under the Owl */
        .owl-shadow {
            width: 150px;
            height: 20px;
            background: rgba(0, 0, 0, 0.8);
            border-radius: 50%;
            margin: 0 auto 20px;
            margin-top: -20px;
            animation: shadowPulse 4s ease-in-out infinite;
        }

        /* Keyframes for Owl Floating */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        /* Keyframes for Shadow Pulsing */
        @keyframes shadowPulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.8;
            }

            50% {
                transform: scale(1.2);
                opacity: 0.6;
            }
        }

        /* Headings */
        h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #f4d35e;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        /* Instructions Text */
        .instructions {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            color: #ccc;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        label {
            font-size: 1rem;
            font-weight: bold;
            color: #f4d35e;
            text-align: left;
        }

        input[type="email"] {
            padding: 0.8rem;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.3);
            color: #fff;
            transition: background 0.3s ease;
        }

        input[type="email"]:focus {
            background: rgba(255, 255, 255, 0.5);
            outline: none;
        }

        input[type="email"]::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        /* Submit Button */
        .submit-button {
            padding: 0.8rem;
            font-size: 1rem;
            font-weight: bold;
            color: #fff;
            background: #f4d35e;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .submit-button:hover {
            background: #e0b83e;
        }

        /* Back Button */
        .back-button {
            margin-top: 1rem;
            font-size: 1rem;
            color: #f4d35e;
            text-decoration: none;
            border: 2px solid #f4d35e;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: color 0.3s ease, border-color 0.3s ease;
        }

        .back-button:hover {
            color: #fff;
            border-color: #fff;
        }

        /* Error Message */
        .error-message {
            background: rgba(180, 0, 0, 0.7);
            color: #fff;
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 1rem;
            border: 2px solid #8b0000;
        }
    </style>
</head>

<body>
    <?php
    require __DIR__ . "/../../layout/navbar.view.php"
        ?>
    <div>

    </div>
    <div class="container-chat">
        <img src="<?= $GLOBALS['img']->image("owl_post.png") ?>" alt="Owl Post" class="owl-icon-large"
            style="width: 200px; height: auto;">
        <div class="owl-shadow"></div>
        <h1>Owl Post</h1>

        <p class="instructions">Enter the email address of the witch or wizard you wish to send an owl to:</p>
        <!-- Display Error Message -->
        <?php if ($errorMessage): ?>
            <div id="error-message" class="error-message">
                <p><?= htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8') ?></p>
            </div>
        <?php endif; ?>
        <form method="POST" action="/chat">
            <div class="form-group">
                <label for="recipient_email">Recipient's Email:</label>
                <input type="hidden" name="sender_id" value="<?= $data['id'] ?>">
                <input type="email" id="recipient_email" name="email" required placeholder="e.g. hermione@hogwarts.com">
            </div>

            <button type="submit" class="submit-button">
                <i class="fas fa-feather-alt"></i> Find Recipient & Send Owl
            </button>
        </form>
        <br>
        <br>
        <a href="/home" class="back-button">return to greate hall</a>
    </div>
</body>

</html>