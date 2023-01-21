<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\C066_Controller;

class UserTest_B023_get_data_header extends TestCase
{
    /**
     * A basic unit test example.  テスト2
     *
     * @return void
     */
    public function test_C066_get_data_header()
    /* 
    #C066_result.xmlファイル作成
    type nul > ./C066_get_data_header_result.xml

    #UT実行
    php artisan test --log-junit ./C066_get_data_header_result.xml --filter test_C066_get_data_header tests/Unit/UserTest_C066_get_data_header.php
    */    {

        #入力値
        $C066_header_datas[0] = '5 2 10';
        $C066_header_datas[1] = '5';
        $C066_header_datas[2] = '5';
        $C066_header_datas[3] = '3';
        $C066_header_datas[4] = '1';
        $C066_header_datas[5] = '4';

        #期待値
        $expected_value['goldfish_number'] = 5;
        $expected_value['fish_net'] = 2;
        $expected_value['goldfish_weight'] = 10;

        $C066 = new C066_Controller();
        $c066_headers = $C066->get_data_header($C066_header_datas);
        print_r("\n");
        print_r("期待値 = ");
        print_r($expected_value);
        print_r("\n");
        print_r("処理結果 = ");
        print_r($c066_headers);
        print_r("\n");
        $this->assertEquals($c066_headers, $expected_value);
    }

}