<?php
$BOT = "6796859704:AAEzQfRx6EGO2LiY5FgQi-RePNoIgm0eFGo";
$webHookurl = "https://gear5.info/api/bot.php";
//$apiUrl = "https://api.telegram.org/bot$BOT/setWebhook?url=$webHookurl";
$apiUrl = "https://api.telegram.org/bot$BOT/getWebhookInfo";
$response = file_get_contents($apiUrl);
echo $response;
