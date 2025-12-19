<?php

class Response
{
    public function __construct(
        private int $statusCode,
        private string $header,
        private string $content = ''
    ) {}

    public static function html($statusCode, $content = ''): Response
    {
        $header = 'Content-Type: text/html; charset=utf-8';
        return new self($statusCode, $header, $content);
    }

    public static function json($statusCode, $content = ''): Response
    {
        $header = 'Content-Type: application/json';
        $json = json_encode($content);
        return new self($statusCode, $header, $json);
    }

    public function send(): void
    {
        http_response_code($this->statusCode);
        header($this->header);
        echo $this->content;
    }
}
