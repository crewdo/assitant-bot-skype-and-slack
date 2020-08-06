<?php

interface ConnectorInterface
{
    public function send($message);
    public function validate();
}