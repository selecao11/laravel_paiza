<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\C042_Controller;

class UserTest_C042 extends TestCase
{
    /**
     * A basic unit test example.  テスト2
     *
     * @return void
     */
    public function test_C042()
    /*
    #C042_result.xmlファイル作成
    type nul > ./C042_result.xml

    #UT実行
    php artisan test --log-junit ./C042_result.xml --filter test_C042 tests/Unit/UserTest_C042.php
    */    {
        #期待値
        $expected_value[0][0] = '-';
        $expected_value[0][1] = 'L';
        $expected_value[0][2] = 'w';
        $expected_value[1][0] = 'w';
        $expected_value[1][1] = '-';
        $expected_value[1][2] = 'w';
        $expected_value[2][0] = 'L';
        $expected_value[2][1] = 'L';
        $expected_value[2][2] = '-';

        $file_name = "C:\\laravel_paiza\\app\\Http\\Controllers\\C042.txt";
        $C042 = new C042_Controller() ;
        $c042_datas = $C042->output_C042($file_name);
        print_r("\n");
        print_r("期待値 = ");
        print_r("\n");
        print_r($expected_value);
        print_r("処理結果 = ");
        print_r($c042_datas);
        $this->assertEquals($c042_datas, $expected_value);
    }

}
