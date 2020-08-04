<?php
header('Content-Type: application/json');
include_once('Library/Common.php');
include_once('Library/BotHandler.php');

$commomLib = new \Library\Common();

if (!empty($_POST['message']) && !empty($_POST['group_identifier'])) {
    $translator = new \Library\Translate();
    $botHandler = new \Library\BotHandler($translator, $_POST['message'], $_POST['group_identifier']);
    echo $commomLib->formatResponse($botHandler->send(), 200);
}
