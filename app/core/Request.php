<?php

class Request
{
    public function getAcessPath(): string
    {
        return $_SERVER['REQUEST_URI'];
    }
}