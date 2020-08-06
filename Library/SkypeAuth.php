<?php

namespace Library;

use Exception;

include_once('Library/TokenStore.php');

final class SkypeAuth extends \Connector implements \ConnectorInterface
{
    const BASE_API = 'https://apis.skype.com';
    const BASE_AUTH_URL = 'https://login.microsoftonline.com/botframework.com/oauth2/v2.0/token';

    //This one never change
    const CREW_BOT_CLIENT_ID = '8f70ea30-fdb1-4445-925d-bca7a4204a2c';
    const CREW_BOT_CLIENT_SECRET = '&b||#:n68l*4eis;c=Yi&)%j';

    public $tokenStore;
    public $groupIdentifier;
    public $commonService;
    protected $icon = '(star)';

    public function __construct()
    {
        $this->validate();
        $this->groupIdentifier = $_POST['group_identifier'];
        $this->commonService = new CommonService();
        $this->tokenStore = new TokenStore();
    }

    public function validate()
    {
        if (empty($_POST['group_identifier'])) {
            throw new Exception('Missing info');
        }
    }


    public function auth()
    {
        $rs = $this->commonService->request(self::BASE_AUTH_URL,
            [
                'client_id' => self::CREW_BOT_CLIENT_ID,
                'client_secret' => self::CREW_BOT_CLIENT_SECRET,
                'grant_type' => 'client_credentials',
                'scope' => 'https://api.botframework.com/.default'
            ]);

        $now = new \DateTime('now', new \DateTimeZone('UTC'));

        $rs['expires_in'] = $now->getTimestamp() + $rs['expires_in'];

        $this->tokenStore->store($rs);

        return $rs;
    }

    public function getAccessToken()
    {
        $tokenData = $this->tokenStore->getAll();
        $now = new \DateTime('now', new \DateTimeZone('UTC'));
        if (empty($tokenData['expires_in']) || $tokenData['expires_in'] < ($now->getTimestamp() + 600)) {
            $tokenData = $this->auth();
        }
        return $tokenData['access_token'];
    }

    private function getConversationURI()
    {
        return self::BASE_API . '/v3/conversations/' . $this->groupIdentifier . '/activities';
    }

    public function send($message)
    {
        $message = $this->replaceIcon($message);
        $postData = [
            'type' => 'message/text',
            'text' => $message
        ];
        return $this->commonService->request($this->getConversationURI(), $postData, $this->getAccessToken());
    }
}
