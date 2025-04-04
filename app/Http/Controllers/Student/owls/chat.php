<?php

if (isset($_POST['message'])) {
    $messages = $clean_message = htmlspecialchars(trim($_POST['message']), ENT_QUOTES, 'UTF-8');
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
    var_dump('this email doesnot exits');
    exit;
}
$receiver_id = $id[0]['id'];
$sender_id = $_POST['sender_id'];
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
array_push($data, [$sender_id, $receiver_id, $email, $messages]);
$path->view("student/owls/chat.php", $data);
