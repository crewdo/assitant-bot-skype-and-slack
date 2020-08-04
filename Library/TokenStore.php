<?php

namespace Library;

class TokenStore
{
    const TOKEN_FILE_PATH = __DIR__ . '/token/store.json';
    public static function get($key)
    {
        $tokenData = self::getAll();
        return !empty($tokenData[$key]) ? $tokenData[$key] : [];
    }

    public static function getAll()
    {
        return json_decode(file_get_contents(self::TOKEN_FILE_PATH), true);
    }

    public static function set($key, $value)
    {
        $tokenData = self::getAll();
        $tokenData[$key] = $value;
        file_put_contents(self::TOKEN_FILE_PATH, json_encode($tokenData));
    }

    public static function store($json)
    {
        file_put_contents(self::TOKEN_FILE_PATH, json_encode($json));
    }

}
