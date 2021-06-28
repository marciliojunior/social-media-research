<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class GetPostsViewTest
 * Test if the main view will load correctly
 * @package Tests\Feature
 */
class GetPostsViewTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    public function test_example()
    {
        $this->visit('/')->see(config('app.name'));
    }
}
