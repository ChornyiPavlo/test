<?php
// TELEGRAM
// Only process POST requests.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form fields and remove whitespace.
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = strip_tags(trim($_POST["message"]));
    // Check that data was sent to the bot.
    if (empty($email)  || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Set a 400 (bad request) response code and exit.
        http_response_code(400);
        echo "Please correct your email";
        exit;
    }

    // Replace with your Telegram Bot API token and chat ID.
//    $botToken = '6412738203:AAFC61mJZ5oMs9ZtY7-FxQR3r2NANuYDHV8';
    $botToken = '6509670447:AAFB112H-fqnr-2XLLICW-nRh2i_rslTZiU';
    $chatId = '-1001940014354';
    // Compose the message for the Telegram bot.
    $telegramMessage = "Name: $name\n";
    $telegramMessage .= "Email: $email\n";
    $telegramMessage .= "Message: $message\n";

    // Create the URL for sending the message to the Telegram bot.
    $telegramApiUrl = "https://api.telegram.org/bot{$botToken}/sendMessage";
    $telegramParameters = [
        'chat_id' => '188865453',
//        'chat_id' => $chatId,
        'text' => $telegramMessage,
    ];

    // Send the message to the Telegram bot using cURL.
    $ch = curl_init($telegramApiUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $telegramParameters);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $telegramResponse = curl_exec($ch);
    curl_close($ch);

    // Check if the message was sent successfully to the Telegram bot.
    if ($telegramResponse && json_decode($telegramResponse)->ok) {
        // Set a 200 (okay) response code.
        http_response_code(200);
        echo "Message has been sent.";
    } else {
        // Set a 500 (internal server error) response code.
        http_response_code(500);
        echo "Something went wrong :(";
    }
} else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}