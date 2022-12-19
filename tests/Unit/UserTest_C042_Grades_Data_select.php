<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\C042_Controller;

class UserTest_C042_Grades_Data_select extends TestCase
{
    /**
     * A basic unit test example.  テスト2
     *
     * @return void
     */
    public function test_C042_Grades_Data_select()
    /*
    #C042_result.xmlファイル作成
    type nul > ./C042_Grades_Data_select_result.xml

    #UT実行
    php artisan test --log-junit ./C042_Grades_Data_select_result.xml --filter test_C042_Grades_Data_select tests/Unit/UserTest_C042_Grades_Data_select.php
    */    {

        $c042_datas[0] = '3';
        $c042_datas[1] = '1 3';
        $c042_datas[2] = '2 1';
        $c042_datas[3] = '2 3';

        #期待値
        $expected_value[0]['f'] = 1;
        $expected_value[0]['s'] = 3;
        $expected_value[1]['f'] = 2;
        $expected_value[1]['s'] = 1;
        $expected_value[2]['f'] = 2;
        $expected_value[2]['s'] = 3;

        #        $file_name = "C:\\laravel_paiza\\app\\Http\\Controllers\\C042.txt";
        $C042 = new C042_Controller() ;
        $Grades_Data = $C042->Grades_Data_select($c042_datas);
        print_r("\n");
        print_r("期待値 = ");
        print_r("\n");
        print_r($expected_value);
        print_r("処理結果 = ");
        print_r($Grades_Data);
        $this->assertEquals($Grades_Data, $expected_value);
    }

}
