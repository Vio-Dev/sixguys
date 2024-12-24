<?php

if (!function_exists('format_currency')) {
    /**
     * Format a number into currency format.
     *
     * @param float|int $amount
     * @param string $currency
     * @param int $decimal
     * @return string
     */
    function format_currency($amount, $currency = 'VND', $decimal = 0)
    {
        // Add thousands separator and decimal points
        $formatted = number_format($amount, $decimal, '.', ',');

        // Append or prepend the currency symbol
        switch ($currency) {
            case 'USD':
                return '$' . $formatted;
            case 'EUR':
                return '€' . $formatted;
            case 'VND':
            default:
                return $formatted . ' ₫'; // Default to VND
        }
    }
}