<?php
include_once('Library/BotHandler.php');
include_once('Library/Common.php');

$commomLib = new \Library\Common();

if (!empty($_POST['message']) && !empty($_POST['group_identifier'])) {
    $translator = new \Library\Translate();
    $botHandler = new \Library\BotHandler($translator, $_POST['message'], $_POST['group_identifier']);
    $botHandler->send();

    echo $commomLib->formatResponse($_POST['message'], 200);
}
