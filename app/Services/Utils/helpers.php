<?php

use Carbon\Carbon;

if (!function_exists('jDate')) {
    /**
     * @param Carbon|null $datetime
     * @param string $format
     * @param false $fixNumbers
     * @return string
     */
    function jDate(Carbon $datetime = null, string $format = 'yyyy/MM/dd - HH:mm:ss', bool $fixNumbers = false): string
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
}

if (!function_exists('fixNumbers')) {
    /**
     * @param string|null $string
     * @return string
     */
    function fixNumbers(?string $string): string
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];
        $num = range(0, 9);

        $convertedPersianNums = str_replace($persian, $num, $string);

        return str_replace($arabic, $num, $convertedPersianNums);
    }
}

if (!function_exists('gDate')) {
    /**
     * @param string $jDate
     * @param string $format
     * @param false $fixNumbers
     * @return string
     */
    function gDate(string $jDate, string $format = 'yyyy-MM-dd HH:mm:ss', bool $fixNumbers = false): string
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
}

if (!function_exists('m')) {
    /**
     * Append md5 hash to the given asset
     *
     * @param string $url
     * @return string
     */
    function m(string $url): string
    {
        return $url . '?md5=' . md5_file(public_path(parse_url($url)['path']));
    }
}

if (!function_exists('parseNumber')) {
    /**
     * @param string|null $string
     * @return string|string[]|null
     */
    function parseNumber(?string $string): string
    {
        return preg_replace('/[^0-9]/', '', fixNumbers($string));
    }
}

if (!function_exists('preventXSS')) {
    /**
     * @param $content
     * @return string|string[]|null
     */
    function preventXSS($content)
    {
        return preg_replace('/(script.*?(?:\/|&#47;|&#x0002F;)script)/ius', '', $content);
    }
}

if (!function_exists('slugify')) {
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
}
