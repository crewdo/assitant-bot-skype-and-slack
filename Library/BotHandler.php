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
        $tranlatedMessage = $this->translator->translate($this->message);
        return $this->message . ' : ' . $tranlatedMessage;
    }

    public function send()
    {
        return $this->skypeAuth->send($this->completeMessage());
    }
}
