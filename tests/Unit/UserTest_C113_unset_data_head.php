<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\C113_Controller;

class UserTest_C113_unset_data_head extends TestCase
{
    /**
     * A basic unit test example.  テスト2
     *
     * @return void
     */
    public function test_C113_unset_data_head()
    /* 
    #C113_unset_data_head_result.xmlファイル作成
    type nul > ./C113_unset_data_head_result.xml

    #UT実行
    php artisan test --log-junit ./C113_unset_data_head_result.xml --filter test_C113_unset_data_head tests/Unit/UserTest_C113_unset_data_head.php
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
        $datas_correct[0] = 'x';
        $datas_correct[1] = '-';
        $datas_correct[2] = '+';
        $datas_correct[3] = '1';
        $datas_correct[4] = '1';
        $datas_correct[5] = '6';
        print_r("\n");
        print_r("datas_correct = ");
        print_r($datas_correct);
        print_r("\n");
        $this->assertEquals($c113_datas, $datas_correct);
    }
}