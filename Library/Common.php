<?php

namespace Library;

class CommonService
{
    public function formatResponse($message, $code)
    {
        return json_encode([
            'status' => 'success',
            'code' => $code,
            'skype_response' => $message
        ], JSON_UNESCAPED_UNICODE);
    }

    public function request($url, $data, $accessToken = null)
    {
        $ch = curl_init($url);
        $postData = $data;
        if($accessToken) {
            $postData = json_encode($data);
            $authorization = "Authorization: Bearer " . $accessToken;
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }

}
