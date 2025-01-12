<?php

namespace Akshay\Url_down;

use Akshay\Url_down\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class UrlDownController extends Controller
{
    public function add($a, $b){
        echo $a + $b;
    }

    public function subtract($a, $b){
        echo $a - $b;
    }

    /**
     * Get the current route name.
     */
    public function getRouteName(): ?string
    {
        foreach (Route::getRoutes()->getRoutes() as $route) {
            if ($route->uri == request()->getPathInfo()) {
                return $route->getName();
            }
        }

        return null;
    }

    /**
     * Check if the route is down.
     */
    public function isRouteDown(string $routeName): bool
    {
        $jsonData = Helper::getFileData();
        return in_array($routeName, $jsonData);
    }
}
