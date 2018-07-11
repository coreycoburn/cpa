<?php

use Illuminate\Support\Carbon;

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
