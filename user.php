<?php


class User
{
    public static function getAccessToken($subdomain, $user) {
        $url = 'https://' . $subdomain . '.amocrm.ru/oauth2/access_token';
        return Curl::request($url, 'POST', $user);
    }
}