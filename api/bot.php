<?php

function GetStr($string, $start, $end) {    
    $startPos = strpos($string, $start) + strlen($start);
    $endPos = strpos($string, $end);
    $newSubstring = substr($string, $startPos, $endPos - $startPos);
    return $newSubstring;
}

$BOT = "6796859704:AAEzQfRx6EGO2LiY5FgQi-RePNoIgm0eFGo";

$data = file_get_contents('php://input');
$logFile = "messageLogs.json";
$log = fopen($logFile, 'a');
fwrite($log, $data);
fclose($log);
$data = json_decode($data, true);
$userId = $data['message']['from']['id'];
$userMessage = $data['message']['text'];

$readings = file_get_contents('Readings.json');
$values = json_decode($readings, true);

$temperature = $values['temperature'];
$temperaturef = $temperature*9/5+32;
$humidity = $values['humidity'];
$pressure = $values['pressure'];

if ($userMessage == "/start") {
    $botMessage = urlencode("🌦️ Welcome to Weather Station Bot! 🤖\n\nI'm here to proide you with real-time updates on the current atmospheric conditions.\nStay informed about the temperature, humidity, and barometric pressure. 🌡️💧⛅\n\nUse /help to view all commands.");
    file_get_contents("https://api.telegram.org/bot$BOT/sendMessage?chat_id=$userId&parse_mode=MarkDown&text=$botMessage");
}
else if ($userMessage == "/help") {
    $botMessage = urlencode("Here's a list of all the commands for Weather Station 🌦️\n\n• /start - Start the bot.\n• /help - Show this list.\n• /temperature - Get the current temperature readings. 🌡️\n• /humidity - Get the current humidity readings. 💧\n• /pressure - Get the current Barometric Pressure readings.\n");
    file_get_contents("https://api.telegram.org/bot$BOT/sendMessage?chat_id=$userId&parse_mode=MarkDown&text=$botMessage");
}
else if ($userMessage == "/temperature") {
    $botMessage = urlencode("🌡️ The current temperature readings are: ".$temperature."°C or ".$temperaturef."°F.");
    file_get_contents("https://api.telegram.org/bot$BOT/sendMessage?chat_id=$userId&parse_mode=MarkDown&text=$botMessage");
}
else if ($userMessage == "/humidity") {
    $botMessage = urlencode("💧 The current humidity readings are: ".$humidity."%");
    file_get_contents("https://api.telegram.org/bot$BOT/sendMessage?chat_id=$userId&parse_mode=MarkDown&text=$botMessage");
}
else if ($userMessage == "/pressure") {
    $botMessage = urlencode("⏲️ The current barometric pressure readings are: ".$pressure." hPa");
    file_get_contents("https://api.telegram.org/bot$BOT/sendMessage?chat_id=$userId&parse_mode=MarkDown&text=$botMessage");
}
else {
    $botMessage = urlencode("I'm sorry, I didn't understand that command.");
    file_get_contents("https://api.telegram.org/bot$BOT/sendMessage?chat_id=$userId&parse_mode=MarkDown&text=$botMessage");
}
