<?php
namespace Library;

include_once('Library/Translate.php');
class BotHandler
{
    public $groupIdentifier;
    public $message;
    public $translator;

    public function __construct(Translate $translator, $message, $groupIdentifier)
    {
        $this->message = $message;
        $this->groupIdentifier = $groupIdentifier;
        $this->translator = $translator;
    }

    protected static function getAuthenticate()
    {

    }

    private function completeMessage() {
        $tranlatedMessage = $this->translator->translate($this->message);
        return $this->message . ' : ' . $tranlatedMessage;
    }

    public function send() {
        $sendData = [
            'type' => 'message/text',
            'text' => $this->completeMessage()
        ];

        //call API
    }
}
