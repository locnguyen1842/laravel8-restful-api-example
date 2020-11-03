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

if (!function_exists('authenticatedUser')) {
    /**
     * @param string $guardName
     * 
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    function authenticatedUser($guardName = 'api')
    {
        return auth($guardName)->user();
    }
}