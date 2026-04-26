<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST,GET');
header('Content-Type: text/plain');

$input = file_get_contents('php://input');
$data = json_decode($input, true) ?: $_POST ?: $_GET;

$logEntry = [
    'timestamp' => date('Y-m-d H:i:s'),
    'remote_ip' => $_SERVER['REMOTE_ADDR'],
    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
    'data' => $data
];

$logLine = json_encode($logEntry, JSON_UNESCAPED_UNICODE) . "\n";
file_put_contents('visitors.json', $logLine, FILE_APPEND | LOCK_EX);

echo "LOGGED: " . $_SERVER['REMOTE_ADDR'];
?>
