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


class Up extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'route:up';

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
                "Which route would you like to up?",
                $choices,
                scroll: 40,
            )
            : search(
        label: "Which route would you like to up?",
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
        $this->up($choice);
        $this->info($choice.': The Route is now live.');
    }

    protected function publishableChoices()
    {
        return Helper::getFileData();
    }

    protected function up($choice){
        Helper::removeFileData($choice);
    }
}
