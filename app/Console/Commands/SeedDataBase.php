<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SeedDataBase extends Command
{
    protected $signature = 'seed:database {persons} {lists} {accounts?} {maxposts?}';

    protected $description = 'Seed database with fake data';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            $params = [
                'persons' => $this->argument('persons'),
                'lists' => $this->argument('lists'),
                'accounts' => $this->argument('accounts'),
                'maxposts' => $this->argument('maxposts')
            ];
            config(['seeder' => $params]);

            $this->call('db:seed');

            return 'Operation successfull';
        }
        catch (\Exception $exception){
            return null;
        }
    }
}
