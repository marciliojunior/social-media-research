<?php

namespace Database\Factories;

use App\Models\ListName;
use App\Models\Person;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListNameFactory extends Factory
{
    protected $model = ListName::class;

    public function definition(): array
    {
        return [
            'name' => 'List '.$this->faker->randomDigitNotNull,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }

    public function configure(): ListNameFactory
    {
        return $this->afterCreating(function(ListName $list){
            //Creating radom lists of persons
            $total = Person::all()->count();
            $persons = Person::all()->random(rand(10, $total));
            foreach ($persons as $person) {
                \DB::table('lists_persons')
                    ->insert(['person_id' => $person->id, 'list_id' => $list->id]);
            }
        });
    }
}
