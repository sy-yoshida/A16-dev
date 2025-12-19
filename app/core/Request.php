<?php

class Request
{
    public function getAcessPath(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public static function getRequestData(): array
    {
        $raw = file_get_contents('php://input');
        return json_decode($raw, true);
    }
}