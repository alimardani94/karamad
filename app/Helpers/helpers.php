<?php

use Carbon\Carbon;

function jDate(Carbon $datetime, $format = 'yyyy/MM/dd - HH:mm:ss', $fixNumbers = false): string
{
    $formatter = new IntlDateFormatter(
        "fa_IR@calendar=persian",
        IntlDateFormatter::FULL,
        IntlDateFormatter::FULL,
        'Asia/Tehran',
        IntlDateFormatter::TRADITIONAL,
        $format
    );
    $result = $formatter->format($datetime);
    return $fixNumbers ? fixNumbers($result) : $result;
}

function fixNumbers(string $string): string
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];
    $num = range(0, 9);
    $convertedPersianNums = str_replace($persian, $num, $string);
    return str_replace($arabic, $num, $convertedPersianNums);
}

function gDate(string $jDate, $format = 'yyyy-MM-dd HH:mm:ss', $fixNumbers = false): string
{
    $fmt = new IntlDateFormatter(
        'fa_IR@calendar=persian',
        IntlDateFormatter::SHORT, //date format
        IntlDateFormatter::NONE, //time format
        'Asia/Tehran',
        IntlDateFormatter::TRADITIONAL
    );
    $time = $fmt->parse($jDate);

    $formatter = IntlDateFormatter::create("en_US@calendar=GREGORIAN",
        IntlDateFormatter::FULL,
        IntlDateFormatter::FULL,
        'Asia/Tehran',
        IntlDateFormatter::TRADITIONAL,
        $format
    );
    $result = $formatter->format($time);

    return $fixNumbers ? fixNumbers($result) : $result;
}

function parse_number(string $string): int
{
    return  preg_replace('/[^0-9]/', '', $string);
}
