<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Test if lists table has the correct columns
 * @package Tests\Unit
 */
class ListNameTest extends TestCase
{
    use DatabaseMigrations;

    private const table = 'lists';

    public function test_example()
    {
        $columns = ['id', 'name'];
        $test = \Schema::hasColumns(self::table, $columns);
        $this->assertTrue($test);
    }
}
