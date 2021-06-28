<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetPostsDataTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    public function test_example()
    {
        $this->json('GET', route('posts'))
            ->seeJsonStructure([
                'current_page',
                'data' => ['*' => ['id', 'account_id', 'post_date', 'content', 'account']]
            ]);
    }
}
