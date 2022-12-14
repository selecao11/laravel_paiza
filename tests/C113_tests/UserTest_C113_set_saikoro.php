<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\C113_Controller;

class UserTest_C113_set_saikoro extends TestCase
{
    /**
     * A basic unit test example.  テスト2
     *
     * @return void
     */
    public function test_C113_set_saikoro()
    /* 
    #C113_set_saikoro_result.xmlファイル作成
    type nul > ./C113_set_saikoro_result.xml

    #UT実行 
    php artisan test --log-junit ./C113_set_saikoro_result.xml --filter test_C113_set_saikoro tests/Unit/UserTest_C113_set_saikoro.php
    */    {
#        $c113_file_name = "C:\\laravel_paiza\\app\\Http\\Controllers\\C113.txt";
#        $c113_file = file_get_contents($c113_file_name);
#        $input_datas[0] = '5 3';
        $c113_datas[0] = 'x';
        $c113_datas[1] = '-';
        $c113_datas[2] = '+';
        $c113_datas[3] = '1';
        $c113_datas[4] = '1';
        $c113_datas[5] = '6';
        $set_masu['masu'] = array("x","-","+","","");
        $set_masu['masu_end_p'] = 3;
        $saikoro_correct=array(1,1,6);
        $masu_saikoros['saikoros']=array(0,0,0);
        $C113 = new C113_Controller();
        $saikoro_datas = $C113->set_saikoro(    $set_masu,
                                                $masu_saikoros,
                                                $c113_datas);
        print_r("\n");
        print_r("c113_datas = ");
        print_r($c113_datas);
        print_r("\n");
        print_r("saikoro_correct = ");
        print_r($saikoro_correct);
        print_r("\n");
        print_r("saikoro_datas = ");
        print_r($saikoro_datas);
        print_r("\n");
        $this->assertEquals($saikoro_datas, $saikoro_correct);
    }
}