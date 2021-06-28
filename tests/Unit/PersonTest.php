<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Test if persons table has the correct columns
 * @package Tests\Unit
 */
class PersonTest extends TestCase
{
    use DatabaseMigrations;

    private const table = 'persons';

    public function test_example()
    {
        $columns = ['id', 'name', 'gender', 'city', 'state'];
        $test = \Schema::hasColumns(self::table, $columns);
        $this->assertTrue($test);
    }
}
