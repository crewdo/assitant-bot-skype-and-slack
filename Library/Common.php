<?php
namespace Library;

class Common
{
    public function formatResponse($message, $response)
    {
        if (!empty($response)) {
            header('Content-type: application/json');
            return json_encode([
                'status' => 200,
                'message' => $message. ' : ' .$response
            ], JSON_UNESCAPED_UNICODE);
        }
        return json_encode([
            'status' => 500,
            'message' => 'Can not get any Response'
        ]);
    }
}
