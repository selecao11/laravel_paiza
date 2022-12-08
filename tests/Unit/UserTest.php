<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\C113_Controller;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_B039_example()
    {
        $file_name = "C:\\laravel_paiza\\app\\Http\\Controllers\\C113.txt";
        $C113 = new C113_Controller();
        $rC113 = $C113->input($file_name);
        print_r($rC113['data']);
        $this->assertTrue($rC113['success'], true);
    }
}
