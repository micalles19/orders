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

    public static function isLogged()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION[SESSION_INDEX]) && $_SESSION[SESSION_INDEX]->isActive) {
            return true;
        }

        return false;
    }

    public static function checkSession()
    {
        if (!self::isLogged()) {
            $response = (object)[
                'status' => 401,
                'message' => 'Unauthorized'
            ];

            sendResponse($response);
        }
    }

    public static function getUserId()
    {
        if (self::isLogged()) {
            return $_SESSION[SESSION_INDEX]->id;
        }

        return 0;
    }

    public static function getUser_name()
    {
        if (self::isLogged()) {
            return $_SESSION[SESSION_INDEX]->firstname . ' ' . $_SESSION[SESSION_INDEX]->lastname;
        }

        return '';
    }

    public static function getUser_email()
    {
        if (self::isLogged()) {
            return $_SESSION[SESSION_INDEX]->email;
        }

        return '';
    }

    public static function getUser_photoFilename()
    {
        if (self::isLogged()) {
            return $_SESSION[SESSION_INDEX]->userPhotoFilename;
        }

        return '';
    }

    public static function getUser_rolename()
    {
        if (self::isLogged()) {
            return $_SESSION[SESSION_INDEX]->roleName;
        }

        return '';
    }
}
