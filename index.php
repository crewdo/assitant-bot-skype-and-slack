<?php
include_once('Library/Translate.php');
include_once('Library/BotHandler.php');
include_once('Library/Common.php');
$commomLib =  new \Library\Common();

if (empty($_POST['message']) && empty($_POST['group_identifier'])) {
    $message = "Crew";
    $response = (new \Library\Translate())->translate($message);
    echo $commomLib->formatResponse($message, $response);
}
