<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\C042_Controller;

class UserTest_C042_Aggregate_Grades extends TestCase
{

    public function test_C042_Aggregate_Grades_init(){
    /*
    #C042_result.xmlファイル作成
    type nul > ./C042_Aggregate_Grades_init_result.xml

    #UT実行
    php artisan test --log-junit ./C042_Aggregate_Grades_init_result.xml --filter test_C042_Aggregate_Grades_init tests/Unit/UserTest_C042_Aggregate_Grades.php
    */
        #期待値
        $expected_value[0][0] = '';
        $expected_value[0][1] = '';
        $expected_value[1][0] = '';
        $expected_value[1][1] = '';
        $expected_value[2][0] = '';
        $expected_value[2][1] = '';

        $headers['Total_participants']=3;
        $C042 = new C042_Controller() ;
        $Grades_Data = $C042->Aggregate_Grades_init($headers);
        print_r("\n");
        print_r("期待値 = ");
        print_r("\n");
        print_r($expected_value);
        print_r("処理結果 = ");
        print_r($Grades_Data);
        $this->assertEquals($Grades_Data, $expected_value);

    }
    /**
     * A basic unit test example.  テスト2
     *
     * @return void
     */
    public function test_C042_Aggregate_Grades()
    /*
    #C042_result.xmlファイル作成
    type nul > ./C042_Aggregate_Grades_result.xml

    #UT実行
    php artisan test --log-junit ./C042_Aggregate_Grades_result.xml --filter test_C042_Aggregate_Grades tests/Unit/UserTest_C042_Aggregate_Grades.php
    */    {

        $c042_datas[0]['f'] = 1;
        $c042_datas[0]['s'] = 3;
        $c042_datas[1]['f'] = 2;
        $c042_datas[1]['s'] = 1;
        $c042_datas[2]['f'] = 2;
        $c042_datas[2]['s'] = 3;

        #期待値
        $expected_value[1][3] = 'w';
        $expected_value[3][1] = 'L';
        $expected_value[2][1] = 'w';
        $expected_value[1][2] = 'L';
        $expected_value[2][3] = 'w';
        $expected_value[3][2] = 'L';

        #        $file_name = "C:\\laravel_paiza\\app\\Http\\Controllers\\C042.txt";
        $C042 = new C042_Controller() ;
        $Grades_Data = $C042->Aggregate_Grades($c042_datas);
        print_r("\n");
        print_r("期待値 = ");
        print_r("\n");
        print_r($expected_value);
        print_r("処理結果 = ");
        print_r($Grades_Data);
        $this->assertEquals($Grades_Data, $expected_value);
    }

}
