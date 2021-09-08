<?php

if (!function_exists('get_ip_server')) {
    function get_ip_address() {
        return $_SERVER['SERVER_ADDR'];
    }
}
