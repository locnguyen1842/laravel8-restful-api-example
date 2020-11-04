<?php

if (!function_exists('distance')) {
    function distance($coordinateFrom = [], $coordinateTo = [])
    {
        $theta = $coordinateFrom['longitude'] - $coordinateTo['longitude'];
        $dist = sin(deg2rad($coordinateFrom['latitude'])) * sin(deg2rad($coordinateTo['latitude'])) + cos(deg2rad($coordinateFrom['latitude'])) * cos(deg2rad($coordinateTo['latitude'])) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $meters = $miles * 1.609344 * 1000;
        return $meters;
    }
}

if (!function_exists('authenticated_user')) {
    /**
     * @param string $guardName
     * 
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    function authenticated_user($guardName = 'api')
    {
        return auth($guardName)->user();
    }
}

if (!function_exists('phone_number')) {
    /**
     * @param string $number
     * @param int $format
     * @param array $country
     * 
     * @return \Propaganistas\LaravelPhone\PhoneNumber|string
     */
    function phone_number($number, $format = null, $country = [])
    {
        if(empty($number)) return "";

        if(empty($country)) {
            $country = config('app.default_phone_country');
        }
        
        return phone($number, $country, $format);
    }
}