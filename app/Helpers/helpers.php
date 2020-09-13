<?php

use Carbon\Carbon;

/**
 * @param Carbon $datetime
 * @param string $format
 * @param bool $fixNumbers
 * @return string
 */
function jDate(Carbon $datetime, $format = 'yyyy/MM/dd HH:mm:ss', $fixNumbers = false): string
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

/**
 * @param string $string
 * @return string
 */
function fixNumbers(string $string): string
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];
    $num = range(0, 9);
    $convertedPersianNums = str_replace($persian, $num, $string);
    return str_replace($arabic, $num, $convertedPersianNums);
}

/**
 * @param string $jDate
 * @param string $format
 * @return Carbon
 */
function gDate(string $jDate, $format = 'yyyy-MM-dd HH:mm:ss'): Carbon
{
    $fmt = new IntlDateFormatter(
        'fa_IR@calendar=persian',
        IntlDateFormatter::SHORT, //date format
        IntlDateFormatter::NONE, //time format
        'Asia/Tehran',
        IntlDateFormatter::TRADITIONAL,
        $format
    );
    $time = $fmt->parse($jDate);

    $formatter = IntlDateFormatter::create("en_US@calendar=GREGORIAN",
        IntlDateFormatter::FULL,
        IntlDateFormatter::FULL,
        'Asia/Tehran',
        IntlDateFormatter::TRADITIONAL,
        'yyyy-MM-dd HH:mm:ss'
    );

    return Carbon::parse($formatter->format($time));
}

/**
 * @param string $string
 * @return string|string[]|null
 */
function parse_number(string $string)
{
    return preg_replace('/[^0-9]/', '', fixNumbers($string));
}

/**
 * @param $content
 * @return string|string[]|null
 */
function preventXSS($content)
{
    return preg_replace('/(script.*?(?:\/|&#47;|&#x0002F;)script)/ius', '', $content);
}

/**
 * @param $string
 * @param string $separator
 * @param int $limit
 * @return string
 */
function slugify($string, $separator = '-', $limit = 10)
{
    $string = strtolower($string);
    $string = str_replace('‌', ' ', $string);
    $string = Str::words($string, $limit, '');
    $string = mb_ereg_replace('([^آ-ی۰-۹a-z0-9]|-)+', $separator, $string);
    $string = strtolower($string);

    return trim($string, $separator);
}
