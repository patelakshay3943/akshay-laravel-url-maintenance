<?php

namespace Akshay\Url_down\Helpers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class Helper {

    public static function getFileData(){
        $filePath = Config::get('urldown.routes_path');
        $jsonData = json_decode(File::get($filePath), true);
        return $jsonData;
    }

    public static function pushFileData($choice){
        $filePath = Config::get('urldown.routes_path');
        $jsonData = self::getFileData();
        $jsonData[] = $choice;
        $jsonString = json_encode($jsonData, JSON_PRETTY_PRINT);
        File::put($filePath, $jsonString);
        return true;
    }

    public static function removeFileData($choice)
    {
        $filePath = Config::get('urldown.routes_path');
        $jsonData = self::getFileData();
        $key = array_search ($choice, $jsonData);
        if(!empty($key) || $key == 0){
            unset($jsonData[$key]);
        }
        $jsonString = json_encode($jsonData, JSON_PRETTY_PRINT);
        File::put($filePath, $jsonString);
        return true;
    }
}
