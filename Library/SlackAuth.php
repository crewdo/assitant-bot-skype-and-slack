<?php

namespace Library;

use \Exception;

final class SlackAuth extends \Connector implements \ConnectorInterface
{
    public $userId;
    public $hookURL;
    public $commonService;
    protected $icon = ':star:';

    public function __construct()
    {
        $this->validate();
        $this->userId = $_POST['userid_identifier'];
        $this->hookURL = $_POST['hook_identifier'];
        $this->commonService = new CommonService();
    }


    public function validate()
    {
        if(empty($_POST['userid_identifier']) || empty($_POST['hook_identifier'])) {
            throw new Exception('Missing info');
        }
    }

    public function send($message)
    {
        $message = $this->replaceIcon($message);
        if ($this->userId && $this->hookURL) {
            $data = [
                'channel' => '@' . $this->userId,
                'username' => 'Noting Bot',
                'text' => $message
            ];
            $postData = ['payload' => json_encode($data)];
            return $this->commonService->request($this->hookURL, $postData);
        }
        return "Missing authentication";
    }
}
