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
    public function test_C113_input_file()
    /* 
    #C113_result.xmlファイル作成
    type nul > ./C113_result.xml

    #UT実行
    php artisan test --log-junit ./C113_result.xml --filter test_C113_input_file tests/Unit/UserTest.php
    */    {
        $file_name = "C:\\laravel_paiza\\app\\Http\\Controllers\\C113.txt";
        $C113 = new C113_Controller();
        $c113_datas = $C113->input_file($file_name);
        print_r($c113_datas['data']);
        $this->assertTrue($c113_datas['is_success'], true);
    }

    public function test_C113_get_data_header()
    /* 
    #C113_result.xmlファイル作成
    type nul > ./C113_get_data_header_result.xml

    #UT実行
    php artisan test --log-junit ./C113_get_data_header_result.xml --filter test_C113_get_data_header tests/Unit/UserTest.php
    */
    {
        $input_datas[0] = '5 3';
        $input_datas[1] = 'x';
        $input_datas[2] = '-';
        $input_datas[3] = '+';
        $input_datas[4] = '1';
        $input_datas[5] = '1';
        $input_datas[6] = '6';
        $C113 = new C113_Controller();
        $headers = $C113->get_data_header($input_datas);
        print_r("\n");
        print_r("input_datas=");
        print_r($input_datas);
        print_r("\n");
        print_r("masu=".$headers['masu']."\n");
        print_r("saikoro=".$headers['saikoro']."\n");
        $this->assertTrue($headers['is_success'], true);
    }

    public function test_C113_unset_data_head()
    /* 
    #C113_unset_data_head_result.xmlファイル作成
    type nul > ./C113_unset_data_head_result.xml

    #UT実行
    php artisan test --log-junit ./C113_unset_data_head_result.xml --filter test_C113_unset_data_head tests/Unit/UserTest.php
    */
    {
        $input_datas[0] = '5 3';
        $input_datas[1] = 'x';
        $input_datas[2] = '-';
        $input_datas[3] = '+';
        $input_datas[4] = '1';
        $input_datas[5] = '1';
        $input_datas[6] = '6';
        $C113 = new C113_Controller();
        $c113_datas = $C113->unset_data_head($input_datas);
        print_r("\n");
        print_r("input_datas=");
        print_r($input_datas);
        print_r("\n");
        print_r("c113_datas=");
        print_r($c113_datas);
        print_r("\n");
        $this->assertTrue($c113_datas['is_success'], true);
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