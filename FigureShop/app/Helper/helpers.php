<?php

use Illuminate\Support\Facades\Session;

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

// status 0: 'published', draft
if (!function_exists('format_posts_status')) {
    /**
     * Format an order status into a human-readable string.
     *
     * @param int $status
     * @return string
     */
    function format_posts_status($status)
    {
        switch ($status) {
            case 'published':
                return 'Đã xuất bản';
            case 'draft':
                return 'bản nháp';
            default:
                return 'Unknown';
        }
    }
}
