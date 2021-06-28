<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    protected $model = Person::class;
    private $gender = ['M', 'F'];

    public function definition(): array
    {
        $date = $this->faker->dateTime();
        $gender = $this->gender[rand(0, 1)];
        $name = ($gender == 'M' ? $this->faker->firstNameMale : $this->faker->firstNameFemale).' '.$this->faker->lastName;

        return [
            'name' => $name,
            'gender' => $gender,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'created_at' => $date,
            'updated_at' => $date
        ];
    }

    public function configure(): PersonFactory
    {
        return $this->afterCreating(function(Person $person){
            $max = config('seeder.accounts', 1);
            Account::factory()->count(rand(1, $max))
                ->create(['person_id' => $person->id]);
        });
    }
}
