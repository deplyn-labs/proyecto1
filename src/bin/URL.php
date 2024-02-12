<?php

class URL {

    public static function base() {
        $base_dir = str_replace(basename($_SERVER["SCRIPT_NAME"]), "", $_SERVER["SCRIPT_NAME"]);
        $baseURL = (isset($_SERVER["HTTPS"]) ? "https" : "http") . "://{$_SERVER["HTTP_HOST"]}{$base_dir}";
        return trim($baseURL, "/");
    }

    public static function to($url) {
        $url = trim($url, "/");
        return URL::base() . "/{$url}?v=".time();
    }

    public static function getFull() {
        return (isset($_SERVER["HTTPS"]) ? "https" : "http") . "://{$_SERVER["HTTP_HOST"]}{$_SERVER["REQUEST_URI"]}";
    }

}
