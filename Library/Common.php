<?php
namespace Library;

class Common
{
    public function formatResponse($message, $code)
    {
        header('Content-type: application/json');
        return json_encode([
            'status' => 'success',
            'code' => $code
        ], JSON_UNESCAPED_UNICODE);
    }
}
