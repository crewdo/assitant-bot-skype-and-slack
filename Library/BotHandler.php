<?php

namespace Library;

include_once('Library/Translate.php');
include_once('Library/SkypeAuth.php');

class BotHandler
{
    public $groupIdentifier;
    public $message;
    public $translator;

    public function __construct(Translate $translator, $message, $groupIdentifier)
    {
        $this->message = $message;
        $this->translator = $translator;
        $this->skypeAuth = new SkypeAuth($groupIdentifier);
    }

    private function completeMessage()
    {
        $this->freshingMessage();
        if(!$this->message) return null;
        $tranlatedMessage = $this->translator->translate($this->message);
        return ucfirst($tranlatedMessage) . "\n" ."(star) ".$this->message ;
    }

    private function freshingMessage(){
        $this->message = trim(preg_replace('/\s+/', ' ', $this->message));
    }

    public function send()
    {
        $messageToSend = $this->completeMessage();
        return $messageToSend && $this->skypeAuth->send($messageToSend);
    }
}
