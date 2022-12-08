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
    public function test_C113_input()
    {
        $file_name = "C:\\laravel_paiza\\app\\Http\\Controllers\\C113.txt";
        $C113 = new C113_Controller();
        $overlap_len_datas = $C113->input($file_name);
        print_r($overlap_len_datas['data']);
        $this->assertTrue($overlap_len_datas['success'], true);
    }

    public function test_C113_get_header()
    {
        $input_datas[0] = '4 2';
        $C113 = new C113_Controller();
        $head = $C113->get_header($input_datas);
        print_r("masu=".$head['masu']."\n");
        print_r("saikoro=".$head['saikoro']."\n");
        $this->assertTrue($head['success'], true);
    }

    public function test_C113_unset_overlap_len_datas()
    {
        $input_datas[0] = '4 2';
        $input_datas[1] = '+';
        $input_datas[2] = '1';
        $input_datas[3] = '1';
        $C113 = new C113_Controller();
        $unset = $C113->unset_overlap_len_datas($input_datas);
        print_r($unset['data']);
        $this->assertTrue($unset['success'], true);
    }    
}