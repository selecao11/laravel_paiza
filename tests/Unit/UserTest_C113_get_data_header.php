<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\C113_Controller;

class UserTest_C113_get_data_header extends TestCase
{
    /**
     * A basic unit test example.  テスト2
     *
     * @return void
     */
    public function test_C113_get_data_header()
    /* 
    #C113_result.xmlファイル作成
    type nul > ./C113_get_data_header_result.xml

    #UT実行
    php artisan test --log-junit ./C113_get_data_header_result.xml tests/Unit/UserTest_C113_get_data_header.php --filter test_C113_get_data_header 
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
        print_r("masu = ".$headers['masu']."\n");
        print_r("saikoro = ".$headers['saikoro']."\n");
        $masu_correct = 5;
        $saikoro_correct = 3;
        print_r("masu_correct = ".$masu_correct."\n");
        print_r("saikoro_correct = ".$saikoro_correct."\n");
        $this->assertEquals($headers['masu'], $masu_correct);
        $this->assertEquals($headers['saikoro'], $saikoro_correct);
    }

}