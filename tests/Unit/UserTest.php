<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\paiza_b039Controller;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_B039_example()
    {
        $b039 = new paiza_b039Controller();
        $this->assertTrue($b039->b039_test(), true);
    }
}
