<?php

namespace Database\Seeders;

use App\Models\ListName;
use App\Models\Person;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        \Artisan::call('migrate:refresh');

        self::CreateSocialNetworks();

        self::CreatePersons(config('seeder.persons'));

        self::CreateLists(config('seeder.lists'));
    }

    private static function CreateSocialNetworks()
    {
        \DB::table('social_networks')->insert([
            ['name' => 'Facebook', 'config' => '{}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Twitter', 'config' => '{}', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        ]);
    }

    private static function CreatePersons(int $quantity)
    {
        Person::factory($quantity)->create();
    }

    private static function CreateLists(int $quantity)
    {
        ListName::factory($quantity)->create();
    }
}
