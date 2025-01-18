<?php

use App\Models\Order;
use Illuminate\Support\Facades\Route;
use Illuminate\Notifications\DatabaseNotification;


if (!function_exists('isEmail')) {
    function isEmail($email)
    {
        $find1 = strpos($email, '@');
        
        $find2 = strpos($email, '.');
       
        return ($find1 !== false && $find2 !== false);
    }
}

if (!function_exists('hasAnyPermissions')) {

    function hasAnyPermissions($permission)
    {
        return auth()->user()->hasPermission($permission);
    }
}


if (!function_exists('isRouteActive')) {
    function isRouteActive($patterns): string
    {
        if (Route::is($patterns)) {
            return 'bg-gray-200';
        }

        return '';
    }
}


if (!function_exists('getAllRoutesInArray')) {
    function getAllRoutesInArray(): array
    {
        $data = [];
        foreach (Route::getRoutes() as $key => $route) {
            if ($route->getName() && $route->getPrefix() != '' && $route->getPrefix() != '_ignition') {
                $data[$key] = [
                    'name' => $route->getName(),
                    'prefix' => $route->getPrefix(),
                ];
            }
        }
        $arr = array();
        foreach ($data as $key => $item) {
            $arr[$item['prefix']][$key] = $item;
        }
        ksort($arr, SORT_NUMERIC);
        return $arr;
    }
}


if (!function_exists('getProgressPercentage')) {
    function getProgressPercentage($status)
    {
        if($status==Order::PENDING)
        {
            return 0.30;
        }elseif($status==Order::CONFIRM)
        {
            return 0.50;
        }elseif($status==Order::PROCESSING)
        {
            return 0.70;
        }elseif($status==Order::DISPATCH)
        {
            return 0.80;
        }elseif($status==Order::SUCCESS)
        {
            return 1.0;
        }else{
            return 0.0;
        }
        
    }
}






