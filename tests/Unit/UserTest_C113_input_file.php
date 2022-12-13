<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\C113_Controller;

class UserTest_C113_input_file extends TestCase
{
    /**
     * A basic unit test example.  テスト2
     *
     * @return void
     */
    public function test_C113_input_file()
    /* 
    #C113_result.xmlファイル作成
    type nul > ./C113_input_file_result.xml

    #UT実行
    php artisan test --log-junit ./C113_input_file_result.xml --filter test_C113_input_file tests/Unit/UserTest_C113_input_file.php
    */    {
        $c113_file_name = "C:\\laravel_paiza\\app\\Http\\Controllers\\C113.txt";
        $c113_file = file_get_contents($c113_file_name);
        $input_datas[0] = '5 3';
        $input_datas[1] = 'x';
        $input_datas[2] = '-';
        $input_datas[3] = '+';
        $input_datas[4] = '1';
        $input_datas[5] = '1';
        $input_datas[6] = '6';
        $C113 = new C113_Controller();
        $c113_datas = $C113->input_file($c113_file_name);
        print_r("\n");
        print_r("ファイル生データ = ");
        print_r($c113_file);
        print_r("\n");
        print_r("c113_datas = ");
        print_r($c113_datas);
        print_r("\n");
        print_r("c113_datas_correct = ");
        print_r($input_datas);
        print_r("\n");
        $this->assertEquals($c113_datas, $input_datas);
    }
}