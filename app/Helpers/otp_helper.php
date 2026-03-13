<?php

if (!function_exists('generate_otp')) {
    /**
     * Generate a random 6-digit OTP
     *
     * @return string
     */
    function generate_otp(): string
    {


        // Generate a 6-digit number between 100000 and 999999
        return strval(random_int(100000, 999999));
    }
}