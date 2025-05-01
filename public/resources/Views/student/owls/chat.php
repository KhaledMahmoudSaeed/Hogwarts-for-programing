<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owl Post</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="<?= $GLOBALS['img']->style("style.css") ?>">
    <link rel="stylesheet" href="<?= $GLOBALS['img']->style("owl.css") ?>">
</head>

<body>
    <?php
    require __DIR__ . "/../../layout/navbar.view.php"
        ?>
    <div class="container-chat">
        <div class="chat-header">
            <h1>
                <img src="<?= $GLOBALS['img']->image("Hogwarts_Owl.png") ?>" alt="Owl Post" class="owl-icon-small">
                Owl Post
            </h1>
            <div class="recipient-email">To: <?= htmlspecialchars($data[0][2]) ?></div>
        </div>

        <div class="messages-container">
            <?php if (empty($data[0][3])): ?>
                <div class="no-messages">
                    No messages yet. Send your first owl post!<br>
                    The owl is waiting...
                </div>
            <?php else: ?>
                <?php foreach ($data[0][3] as $message): ?>
                    <div class="message <?= $message['sender_id'] == $data[0][0] ? 'sent' : 'received' ?>">
                        <div><?= htmlspecialchars($message['message']) ?></div>
                        <div class="message-time">
                            <?= date('H:i, M j', strtotime($message['created_at'])) ?>
                            <span class="message-status">
                                <?= $message['sender_id'] == $data[0][1] ? '(Sent)' : '(Received)' ?>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <form method="POST" class="message-form" action="/chat">
            <input type="hidden" name="sender_id" value="<?= $data[0][0] ?>">
            <input type="hidden" name="receiver_id" value="<?= $data[0][1] ?>">
            <input type="hidden" name="email" value="<?= $data[0][2] ?>">

            <textarea name="message" class="message-input" placeholder="Write your magical message here..."
                required></textarea>
            <button type="submit" class="send-button">Send<br>Owl</button>
        </form>

        <a href="/owl" class="back-link">Back to recipients</a>
    </div>
</body>

</html>