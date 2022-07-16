<?php

namespace App\Console\Commands;

use App\Http\Controllers\NameController;
use Illuminate\Console\Command;

class FetchNikoNames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'names:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return (new NameController())->getNamesListOfNamesFromNiko();
    }
}
