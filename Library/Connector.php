<?php

abstract class Connector
{
    protected $icon;
    public function replaceIcon($message)
    {
        return str_replace("{{icon}}", $this->icon, $message);
    }
}