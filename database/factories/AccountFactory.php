<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Person;
use App\Models\Post;
use App\Models\SocialNetwork;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition(): array
    {
        return [
            'person_id' => Person::factory(),
            'social_network_id' => SocialNetwork::all()->random()->id,
            'email' => $this->faker->email
        ];
    }

    public function configure(): AccountFactory
    {
        return $this->afterCreating(function(Account $account){
            //Creating 1 at 5 posts to the account
            $max = config('seeder.maxposts', 1);
            Post::factory()->count(rand(1, $max))
                ->create(['account_id' => $account->id]);
        });
    }
}
