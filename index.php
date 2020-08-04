<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: *');
include_once('Library/Common.php');
include_once('Library/BotHandler.php');

$commomLib = new \Library\CommonService();

if (!empty($_POST['message']) && !empty($_POST['group_identifier'])) {
    $translator = new \Library\Translate();
    $botHandler = new \Library\BotHandler($translator, $_POST['message'], $_POST['group_identifier']);
    echo $commomLib->formatResponse($botHandler->send(), 200);
}
