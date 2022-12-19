<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\C042_Controller;

class UserTest_C042_HeadData_Split extends TestCase_a
{
    /**
     * A basic unit test example.  テスト2
     *
     * @return void
     */
    public function test_C042_HeadData_Split()
    /*
    #C066_result.xmlファイル作成
    type nul > ./C042_HeadData_Split_result.xml

    #UT実行
    php artisan test --log-junit ./C042_HeadData_Split_result.xml --filter test_C042_HeadData_Split tests/Unit/UserTest_C042_HeadData_Split.php
    */    {
        #期待値
        $expected_value['Total_participants'] = 3;

        $c042_datas[0] = '3';
        $c042_datas[1] = '1 3';
        $c042_datas[2] = '2 1';
        $c042_datas[3] = '2 3';


#        $file_name = "C:\\laravel_paiza\\app\\Http\\Controllers\\C042.txt";
        $C042 = new C042_Controller() ;
        $headers = $C042->HeadData_Split($c042_datas);
        print_r("\n");
        print_r("期待値 = ");
        print_r("\n");
        print_r($expected_value);
        print_r("処理結果 = ");
        print_r($headers);
        $this->assertEquals($headers['Total_participants'], $expected_value['Total_participants']);
    }

}
