<?php

namespace Akshay\Url_down\Commands;

use Akshay\Url_down\Helpers\Helper;
use Config;
use File;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Route;
use function Laravel\Prompts\search;
use function Laravel\Prompts\select;


class Down extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'route:down';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->promptForProviderOrTag();
    }


    protected function promptForProviderOrTag()
    {
        $choices = $this->publishableChoices();

        $choice = windows_os()
            ? select(
                "Which route would you like to down?",
                $choices,
                scroll: 40,
            )
            : search(
        label: "Which route would you like to down?",
                placeholder: 'Search...',
                options: fn($search) => array_values(array_filter(
        $choices,
        fn($choice) => str_contains(strtolower($choice), strtolower($search))
    )),
                scroll: 40,
            );

        if (is_null($choice)) {
            return;
        }

        $this->down($choice);
        $this->info($choice.':  The route is now in maintenance mode.');
    }

    protected function publishableChoices()
    {
        $routes = Route::getRoutes();
        return array_keys($routes->getRoutesByName());
    }

    protected function down($choice){
        // Your JSON data
        $jsonData = Helper::getFileData();
        if(in_array($choice,$jsonData)){
            $this->info('The routes is already down.');
            return;
        }
        Helper::pushFileData($choice);
    }
}
