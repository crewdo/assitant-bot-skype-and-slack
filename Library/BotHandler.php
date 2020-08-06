<?php

namespace Library;

include_once('Library/Translate.php');
include_once('Library/ConnectorInterface.php');
include_once('Library/Connector.php');
include_once('Library/SkypeAuth.php');
include_once('Library/SlackAuth.php');

class BotHandler
{
    public $groupIdentifier;
    public $message;
    public $translator;
    public $connectorType;
    public $serviceConnector;
    public $isTranslate;

    public function __construct(Translate $translator, $message, $connectorType = 'skype')
    {
        $this->message = $message;
        $this->translator = $translator;
        $this->isTranslate = $_POST['translate_status'] === "true";
        $this->connectorType = $connectorType;

        $this->serviceConnector = $this->chooseServiceConnector();
    }
    public function completeMessage()
    {
        $this->freshingMessage();
        if(!$this->message) return null;

        $translatedMessage = $this->isTranslate ?  $this->translator->translate($this->message) : null;
        if($translatedMessage) {
            return ucfirst($translatedMessage) . "\n" ."{{icon}} ".$this->message ;
        }
        return "{{icon}} ".$this->message;
    }

    private function freshingMessage(){
        $this->message = trim(preg_replace('/\s+/', ' ', $this->message));
    }

    public function send()
    {
        $messageToSend = $this->completeMessage();
        return $messageToSend ? $this->serviceConnector->send($messageToSend) : "Failed";
    }

    function chooseServiceConnector() {
        //later can switch case
        return $this->connectorType == 'skype' ? new SkypeAuth() : new SlackAuth();
    }
}
