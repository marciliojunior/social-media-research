<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Test if accounts table has the correct columns
 * Class AccountTest
 * @package Tests\Unit
 */
class AccountTest extends TestCase
{
    use DatabaseMigrations;

    private const table = 'accounts';

    public function test_example()
    {
        $columns = ['person_id', 'social_network_id'];
        $test = \Schema::hasColumns(self::table, $columns);
        $this->assertTrue($test);
    }
}
