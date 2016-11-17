<?php
function getFundraisingData() {
//
    $cacheFilePath = __DIR__ . '/cache/fundraising.json';

    if (file_exists($cacheFilePath)) {
        $fileModificationTime = filemtime($cacheFilePath);

        if (time() - $fileModificationTime < 3660) {
            return json_decode(file_get_contents($cacheFilePath), true);
        }
    }

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'https://www.generosity.com/generosity/api/fundraisers/help-roman-and-his-family-to-beat-cancer.json'
    ));

    $result = curl_exec($curl);
    curl_close($curl);

    file_put_contents($cacheFilePath, $result);

    return json_decode($result, true);
}

class Request
{
    public static function getRequestUri()
    {
        return trim(trim(str_replace('?' . $_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI'])), '/');
    }


    public static function getLanguage()
    {
        switch (substr(self::getRequestUri(), 0, 2)) {
            case 'ru':
                $lang = 'ru';
                break;
            case 'ro':
                $lang = 'ro';
                break;
            case 'en':
            default:
                $lang = 'en';
        }

        return $lang;
    }

    public static function getPage()
    {
        $page = trim(preg_replace('/^' . self::getLanguage() . '/', '', self::getRequestUri()), '/');

        if (empty($page)) {
            $page = 'about.html';
        }

        return $page;
    }

    public static function checkETag($etag)
    {
        header('Content-Type: text/html; charset=utf-8');
        header("Etag: $etag");
        header("Cache-Control: no-cache");

        if (trim($_SERVER['HTTP_IF_NONE_MATCH']) == $etag) {
            header("HTTP/1.1 304 Not Modified");
            exit;
        }
    }
}
