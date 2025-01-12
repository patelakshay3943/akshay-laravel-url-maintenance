<?php
namespace Akshay\Url_down;

use Illuminate\Filesystem\Filesystem;

class PackageCleanup
{
    public static function cleanup()
    {
        $fileSystem = new Filesystem();

        // Path to the configuration file or other related files
        $configFilePath = config_path('urldown.php');
        $configDir = config_path();  // If you want to remove all package-related files

        // Check if config file exists, then delete it
        if ($fileSystem->exists($configFilePath)) {
            $fileSystem->delete($configFilePath);
        }

        // You can add other cleanup actions here, like removing views, migrations, etc.
    }
}
