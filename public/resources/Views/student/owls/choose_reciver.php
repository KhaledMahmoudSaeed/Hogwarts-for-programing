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

    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Cinzel', sans-serif;
        }

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
            margin: 0 auto;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        /* Owl Icon Styling */
        .owl-icon-large {
            width: 150px;
            height: auto;
            margin-bottom: 1rem;
            border-radius: 50%;
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
            color: #c0c0c0;
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
        }

        input[type="email"] {
            padding: 0.8rem;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            transition: background 0.3s ease;
        }

        input[type="email"]:focus {
            background: rgba(255, 255, 255, 0.4);
            outline: none;
        }

        input[type="email"]::placeholder {
            color: rgba(255, 255, 255, 0.6);
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

        /* Error Message Styling */
        .error-message {
            background: rgba(255, 0, 0, 0.8);
            color: #fff;
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .error-message p {
            margin: 0;
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <link rel="stylesheet" href="<?= $GLOBALS['img']->style("style.css") ?>">

    <?php
    require __DIR__ . "/../../layout/navbar.view.php"
        ?>
    <div>

    </div>
    <div class="container-chat">
        <img src="<?= $GLOBALS['img']->image("Hogwarts_Owl.png") ?>" alt="Owl Post" class="owl-icon-large"
            style="width: 200px; height: auto;">
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
                Find Recipient & Send Owl
            </button>
        </form>
        <br>
        <br>
        <a href="/home" class="back-button">Back to Dashboard</a>
    </div>
</body>

</html>