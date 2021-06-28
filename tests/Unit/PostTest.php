<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Test if posts table has the correct columns
 * @package Tests\Unit
 */
class PostTest extends TestCase
{
    use DatabaseMigrations;
    private const table = 'posts';

    public function test_example()
    {
        $columns = ['id', 'account_id', 'content', 'post_date'];
        $test = \Schema::hasColumns(self::table, $columns);
        $this->assertTrue($test);
    }
}
