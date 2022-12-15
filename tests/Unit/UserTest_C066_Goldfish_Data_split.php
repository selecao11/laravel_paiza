<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\C066_Controller;

class UserTest_C066_Goldfish_Data_split extends TestCase
{
    /**
     * A basic unit test example.  テスト2
     *
     * @return void
     */
    public function test_C066_Goldfish_Data_split()
    /* 
    #C066_result.xmlファイル作成
    type nul > ./C066_Goldfish_Data_split_result.xml

    #UT実行
    php artisan test --log-junit ./C066_Goldfish_Data_split_result.xml --filter test_C066_Goldfish_Data_split tests/Unit/UserTest_C066_Goldfish_Data_split.php
    */    {

        #入力値
        $C066_datas[0] = '5 2 10';
        $C066_datas[1] = '5';
        $C066_datas[2] = '5';
        $C066_datas[3] = '3';
        $C066_datas[4] = '1';
        $C066_datas[5] = '4';

        #期待値
        $expected_value[0] = '5';
        $expected_value[1] = '5';
        $expected_value[2] = '3';
        $expected_value[3] = '1';
        $expected_value[4] = '4';

        $C066 = new C066_Controller();
        $goldfish_weights = $C066->Goldfish_Data_split($C066_datas);
        print_r("\n");
        print_r("期待値 = ");
        print_r($expected_value);
        print_r("\n");
        print_r("処理結果 = ");
        print_r($goldfish_weights);
        print_r("\n");
        $this->assertEquals($goldfish_weights, $expected_value);
    }

}