<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Test if social_networks table has the correct columns
 * @package Tests\Unit
 */
class SocialNetworkTest extends TestCase
{
    use DatabaseMigrations;
    private const table = 'social_networks';

    public function test_example()
    {
        $columns = ['id', 'name'];
        $test = \Schema::hasColumns(self::table, $columns);
        $this->assertTrue($test);
    }
}
