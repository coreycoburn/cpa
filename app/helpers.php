<?php

use Illuminate\Support\Carbon;

function get($data, $items)
{
    if (is_array($items)) {
        $item_array = [];

        foreach ($items as $item)
        {
            $item_array[$item] = (isset($data[$item])) ? $data[$item] : NULL;
        }

        return $item_array;
    }

    if ($items) {
        return (isset($data[$items])) ? $data[$items] : NULL;
    }

    return $data;
}

function convert_time_to_decimal($time) {
    $time = explode(':', $time);
    $hours = $time[0];
    $minutes = $time[1];
    return $hours + round($minutes / 60, 2);
}

function convert_time_to_carbon($db_time) {
    $db_time = number_format($db_time, 2);
    $time = explode('.', $db_time);
    $hour = (int) $time[0];
    $minute = (isset($time[1])) ? $time[1] : 0;
    $minute = (int) ($minute * 60) / 100;
    $carbon = Carbon::createFromTime($hour, $minute, 0, 'America/Los_Angeles');

    return $carbon->format('g:ia');
}

function encrypt_decrypt($action, $string, $default = 'thevaletdude') {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = $default . ' key';
    $secret_iv = $default . ' iv';
    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}
