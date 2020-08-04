<?php

namespace Library;

final class SkypeAuth
{
    const BASE_API = 'https://apis.skype.com';
    const BASE_AUTH_URL = 'https://login.microsoftonline.com/botframework.com/oauth2/v2.0/token';

    public function __construct($groupIdentifier)
    {
        $this->groupIdentifier = $groupIdentifier;
    }

    public function getAccessToken()
    {
        //checking
        return 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsIng1dCI6Imh1Tjk1SXZQZmVocTM0R3pCRFoxR1hHaXJuTSIsImtpZCI6Imh1Tjk1SXZQZmVocTM0R3pCRFoxR1hHaXJuTSJ9.eyJhdWQiOiJodHRwczovL2FwaS5ib3RmcmFtZXdvcmsuY29tIiwiaXNzIjoiaHR0cHM6Ly9zdHMud2luZG93cy5uZXQvZDZkNDk0MjAtZjM5Yi00ZGY3LWExZGMtZDU5YTkzNTg3MWRiLyIsImlhdCI6MTU5NjUyNjA2MiwibmJmIjoxNTk2NTI2MDYyLCJleHAiOjE1OTY2MTI3NjIsImFpbyI6IkUyQmdZTmlUZFhWTlJZbFQ2a1d6R1F4K0I5enVBZ0E9IiwiYXBwaWQiOiI4ZjcwZWEzMC1mZGIxLTQ0NDUtOTI1ZC1iY2E3YTQyMDRhMmMiLCJhcHBpZGFjciI6IjEiLCJpZHAiOiJodHRwczovL3N0cy53aW5kb3dzLm5ldC9kNmQ0OTQyMC1mMzliLTRkZjctYTFkYy1kNTlhOTM1ODcxZGIvIiwidGlkIjoiZDZkNDk0MjAtZjM5Yi00ZGY3LWExZGMtZDU5YTkzNTg3MWRiIiwidXRpIjoiNU51Z21IelJ0RWFuNmluanBMQVRBQSIsInZlciI6IjEuMCJ9.rFBeoygJHRzHFXYy7OrFkssCd56MINhZwq-bBh5dT7vglPKmEhU3LPoHGfTq9BvqdGbbDbdJNkStzSY70fdmqcmuzmVcPi9XPRNl4xhbw5xogkKkI6HCKv3KZ_x-bfWrE0HbTsUA2KZtQHCxmb6shUXfR1hFZiXoe7YTdS_9cKe1WpYCiQzxXVGLipFSSGtpXPbqawGJfDhibXj3S9yiDhVQSKExnzL5GSzXIWwrDaizjV-FGeK5i9TbiJUBnMhQUfUbDn4dpInEr1hZOgdAHJC7WFBzHXOm5p6l8WgaeYKjeGTqSIljjnyQF8zCx8-QztWWFWWKjPOAvwmKqbRv3Q';
    }

    private function getConversationURI() {
        return self::BASE_API. '/v3/conversations/'. $this->groupIdentifier. '/activities';
    }

    public function send($message)
    {
        $postData = [
            'type' => 'message/text',
            'text' => $message
        ];

        return (new Common())->requestJWT($this->getAccessToken(), $this->getConversationURI(), $postData);
    }
}
