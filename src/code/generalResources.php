<?php

function sendResponse($response)
{
    $httpCode = !isset($response->status) ? 500 : $response->status;
    http_response_code($httpCode);
    echo json_encode($response);
    exit();
}

function getConnection()
{
    $connection = new MysqlConnection();
    return $connection;
}

function getClientAgent(): string
{
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $isMobileDevice = false;
    $versionAgent = '';

    if (preg_match('/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i', $userAgent)) {
        $isMobileDevice = true;
    }

    if (preg_match('/(edge|opera|chrome|safari|firefox|msie|trident)/i', $userAgent)) {
        preg_match('/(edge|opera|chrome|safari|firefox|msie|trident)\/(\d+)/i', $userAgent, $versionAgent);
        $versionAgent = $versionAgent[2];
    }

    return json_encode([
        'isMobileDevice' => $isMobileDevice,
        'versionAgent' => $versionAgent
    ]);
}

function getRandomStr($length = 6): string
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lengthCharacters = strlen($characters);

    $arr = [];

    for ($i = 0; $i < $length; $i++) {
        $arr[] = $characters[rand(0, $lengthCharacters - 1)];
    }

    return implode("", $arr);
}
