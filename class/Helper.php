<?php

class Helper
{

    public function randamId()
    {

        $today = time();
        $startDate = date('YmdHi', strtotime('1912-03-14 09:06:00'));
        $range = $today - $startDate;
        $rand = rand(0, $range);
        $randam = $rand . "_" . ($startDate + $rand) . '_' . $today . "_n";
        return $randam;
    }

    public function calImgResize($newHeight, $width, $height)
    {


        $percent = $newHeight / $height;
        $result1 = $percent * 100;

        $result2 = $width * $result1 / 100;

        return array($result2, $newHeight);
    }

    public function getSitePath()
    {

        $path = str_replace('class', '', dirname(__FILE__));
        return $path;
    }
    function random_password()
    {

        // String of all alphanumeric character
        $str_result1 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str_result2 = '0123456789';

        // Shuffle the $str_result and returns substring
        // of specified length
        $random_pw = substr(str_shuffle($str_result1),0,3) . '' . substr(str_shuffle($str_result2),0,3);
        return $random_pw;
    }
    function encryptData($data)
    {

        $encryptionKey = "w239hedr216nbd0"; // Change this to a strong, random key

        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encryptedData = openssl_encrypt($data, 'aes-256-cbc', $encryptionKey, 0, $iv);
        return $encryptedData;
    }
    function decryptData($data)
    {
        $encryptionKey = "w239hedr216nbd0"; // Change this to a strong, random key

        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        // Decryption
        $decryptedData = openssl_decrypt($data, 'aes-256-cbc', $encryptionKey, 0, $iv);
        if ($decryptedData === false) {
            $error = openssl_error_string();
            echo "Decryption failed: $error";
        } else {
            // Successfully decrypted data
            echo "Decrypted data: $decryptedData";
        }
dd($decryptedData);
        return $decryptedData;
    }
}
