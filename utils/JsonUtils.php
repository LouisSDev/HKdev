<?php

class JsonUtils {
    public static function decodeJsonFileOrFail(
                $path,
                $errorMessage = "JsonUtils::decodeJsonFileOrFail : Could not open given file") {
        try {
            return self::decodeJsonFileOrThrow($path);
        } catch (Exception $err) {
            die($errorMessage);
        }
    }

    public static function decodeJsonFileOrThrow($path) {
        $message = "Could not parse input file";

        // The instances config file is located one level upper of the current directory so it is not
        // exposed by the web server (for security reasons) :
        $file = @file_get_contents($path); // warning suppressed because error is handled below
        if ($file === false) {
            throw new Exception($message);
        }
        $decodedJson = json_decode(file_get_contents($path));
        if($decodedJson === null) {
            // if it fails here use json_last_error_msg() to understand what happened
            throw new Exception($message);
        }
        return $decodedJson;
    }
}