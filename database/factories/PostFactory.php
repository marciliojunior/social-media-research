<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'account_id' => Account::factory(),
            'post_date' => $this->faker->dateTime,
            'content' => $this->faker->text()
        ];
    }
}
