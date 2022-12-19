<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\C066_Controller;

class UserTest_C066 extends TestCase
{
    /**
     * A basic unit test example.  テスト2
     *
     * @return void
     */
    public function test_C066_output()
    /* 
    #C066_result.xmlファイル作成
    type nul > ./C066_test_C066_output_result.xml

    #UT実行
    php artisan test --log-junit ./C066_test_C066_output_result.xml --filter test_C066_output tests/Unit/UserTest_C066.php
    */    {
        #期待値
        $expected_value = 4;

#        $file_name = "C:\\laravel_paiza\\app\\Http\\Controllers\\C066.txt";
        $C066 = new C066_Controller();
        $success_goldfish = $C066->output_C066();
        print_r("\n");
        print_r("期待値 = ");
        print_r("\n");
        print_r($expected_value);
        print_r("処理結果 = ");
        print_r($success_goldfish);
        $this->assertEquals($success_goldfish, $expected_value);
    }

}