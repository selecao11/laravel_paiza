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

    public function test_C113_unset_head()
    {
        $input_datas[0] = '4 2';
        $input_datas[1] = '+';
        $input_datas[2] = '1';
        $input_datas[3] = '1';
        $C113 = new C113_Controller();
        $unset_head = $C113->unset_head($input_datas);
        print_r($unset_head['data']);
        $this->assertTrue($unset_head['success'], true);
    }

    public function test_C113_masu_judgment(){
        $C113 = new C113_Controller();
/*         5 3
        x
        -
        +
        1
        1
        6
 */
        $masu_len = 5;
        $player_position = 0;
        $saikoro = 3;
        $masu_saikoro_array =array("x","-","+");
        $masu_judgment = $C113->masu_judgment( $masu_len,
                                                    $player_position,
                                                    $saikoro,
                                                    $masu_saikoro_array);

    }
}