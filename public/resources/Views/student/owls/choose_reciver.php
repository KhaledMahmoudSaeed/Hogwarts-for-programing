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
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owl Post - Find Recipient</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            background-color: #f0e6cc;
            color: #372e29;
            margin: 0;
            padding: 20px;
            background-image: url('images/parchment-texture.jpg');
            background-size: cover;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: rgba(255, 248, 220, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border: 1px solid #8b7355;
            text-align: center;
        }

        h1 {
            color: #5d2906;
            text-align: center;
            font-size: 2.2em;
            margin-bottom: 30px;
            text-shadow: 1px 1px 2px #ccc;
        }

        .owl-icon-large {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #5d2906;
        }

        input[type="email"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #d4c9a8;
            border-radius: 5px;
            font-family: inherit;
            background-color: #fff9e6;
            font-size: 1em;
        }

        .submit-button {
            background-color: #5d2906;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 1.1em;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-family: inherit;
            margin-top: 10px;
        }

        .submit-button:hover {
            background-color: #3a1a03;
        }

        .error-message {
            color: #d32f2f;
            margin-top: 10px;
            font-style: italic;
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 8px 15px;
            background-color: #5d2906;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #3a1a03;
        }

        .instructions {
            font-style: italic;
            color: #666;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="<?= $GLOBALS['img']->image("Hogwarts_Owl.png") ?>" alt="Owl Post" class="owl-icon-large"
            style="width: 200px; height: auto;">
        <h1>Owl Post</h1>

        <p class="instructions">Enter the email address of the witch or wizard you wish to send an owl to:</p>

        <form method="POST" action="/chat">
            <div class="form-group">
                <label for="recipient_email">Recipient's Email:</label>
                <input type="hidden" name="sender_id" value="<?= $_POST['user_id'] ?>">
                <input type="email" id="recipient_email" name="email" required placeholder="e.g. hermione@hogwarts.com">
            </div>

            <button type="submit" class="submit-button">
                Find Recipient & Send Owl
            </button>
        </form>

        <a href="/home" class="back-button">Back to Dashboard</a>
    </div>
</body>

</html>