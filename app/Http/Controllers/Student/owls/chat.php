<?php
// check if there is a new message sent or not ,beacause there is two views redirect here and redirect here with each message sent
if (isset($_POST['message'])) {
    $messages = $clean_message = htmlspecialchars(trim($_POST['message']), ENT_QUOTES, 'UTF-8');// sanitize the message
    // insert the message 
    $db->insert('owls', [
        'sender_id' => $_POST['sender_id'],
        'receiver_id' => $_POST['receiver_id'],
        'message' => $messages,
    ]);
}
$data = [];
$email = htmlspecialchars(trim($_POST['email']));
$id = $db->where("users", "email='$email'", ['id' => '']);
if (!$id) {
    $_SESSION['Owl_error'] = "This Email donesn't exits";
    header("Location: /owl");
}
$receiver_id = $id[0]['id'];
$sender_id = $_POST['sender_id'];
// to get all messages between sender and receiver
$messages = $db->where(
    "owls",
    "(sender_id=$sender_id  AND receiver_id=$receiver_id) 
OR
    (sender_id=$receiver_id  AND receiver_id=$sender_id) ",
    [
        'message' => '',
        'sender_id' => '',
        'receiver_id' => '',
        "created_at" => 'created_at'
    ]
);
// pass all needed data
array_push($data, [$sender_id, $receiver_id, $email, $messages]);
$path->view("student/owls/chat.php", $data);
