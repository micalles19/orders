<?php
class App
{
    public function __construct() {}

    public static function checkIsHttps(): void
    {
        // if ($_SERVER['HTTPS'] != "on") {
        //     $url = "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        //     header("Location: $url");
        //     exit;
        // }
    }

    public static function checkIsSessionStarted(): bool
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        return false; // temporary
    }
}
