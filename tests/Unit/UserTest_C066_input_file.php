<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\C066_Controller;

class UserTest_C066_input_file extends TestCase
{
    /**
     * A basic unit test example.  テスト2
     *
     * @return void
     */
    public function test_C066_input_file()
    /* 
    #C066_result.xmlファイル作成
    type nul > ./C066_input_file_result.xml

    #UT実行
    php artisan test --log-junit ./C066_input_file_result.xml --filter test_C066_input_file tests/Unit/UserTest_C066_input_file.php
    */    {
        #期待値
        $expected_value[0] = '5 2 10';
        $expected_value[1] = '5';
        $expected_value[2] = '5';
        $expected_value[3] = '3';
        $expected_value[4] = '1';
        $expected_value[5] = '4';

        $file_name = "C:\\laravel_paiza\\app\\Http\\Controllers\\C066.txt";
        $C066 = new C066_Controller();
        $c066_datas = $C066->input_file($file_name);
        print_r("\n");
        print_r("期待値 = ");
        print_r("\n");
        print_r($expected_value);
        print_r("処理結果 = ");
        print_r($c066_datas);
        $this->assertEquals($c066_datas, $expected_value);
    }

}