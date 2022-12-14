<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\C113_Controller;

class UserTest_C113_set_masu extends TestCase
{
    /**
     * A basic unit test example.  テスト2
     *
     * @return void
     */
    public function test_C113_set_masu()
    /* 
    #C113_set_masu_result.xmlファイル作成
    type nul > ./C113_set_masu_result.xml

    #UT実行 
    php artisan test --log-junit ./C113_set_masu_result.xml --filter test_C113_set_masu tests/Unit/UserTest_C113_set_masu.php
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
        $masu_correct=array("x","-","+","","");
        $masu_end_p_correct = 3;
        $masu_saikoros['masu']=array("","","","","");
        $C113 = new C113_Controller();
        $set_masu = $C113->set_masu($masu_saikoros,$c113_datas);
        print_r("\n");
        print_r("c113_datas = ");
        print_r($c113_datas);
        print_r("\n");
        print_r("masu_correct = ");
        print_r($masu_correct);
        print_r("\n");
        print_r("set_masu = ");
        print_r($set_masu['masu']);
        print_r("\n");
        print_r("masu_end_p_correct = ");
        print_r($masu_end_p_correct);
        print_r("\n");
        print_r("set_masu['masu_end_p'] = ");
        print_r($set_masu['masu_end_p']);
        print_r("\n");
        $this->assertEquals($set_masu['masu'], $masu_correct);
        $this->assertEquals($set_masu['masu_end_p'], $masu_end_p_correct);
        // print_r("masu_saikoros['saikoros'] = ");
        // print_r($masu_saikoros['saikoros']);
        // print_r("\n");
        // $this->assertEquals($masu_saikoro_splits['saikoros'], $masu_saikoros['saikoros']);
    }
}