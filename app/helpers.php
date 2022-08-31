<?php

if ( !function_exists('numberFormatLocaleValue') )
{
    function numberFormatLocaleValue(float $value, int $decimals = 2)
    {
        $decimalSeparator = app()->getLocale() === 'en' ? '.' : ',';
        $thousandSeparator = app()->getLocale() === 'en' ? ',' : '.';

        return number_format($value, $decimals, $decimalSeparator, $thousandSeparator);
    }
}