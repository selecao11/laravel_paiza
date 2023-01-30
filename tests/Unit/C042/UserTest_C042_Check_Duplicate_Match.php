<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\C042_Controller;

class UserTest_C042_Check_Duplicate_Match extends TestCase
{
    /**
     * A basic unit test example.  テスト2
     *
     * @return void
     */
    public function test_Check_Duplicate_Match()
    /*
    #C042_result.xmlファイル作成
    type nul > ./C042_Check_Duplicate_Match_result.xml

    #UT実行
    php artisan test --log-junit ./C042_Check_Duplicate_Match_result.xml --filter test_C042_Check_Duplicate_Match tests/Unit/UserTest_C042_Check_Duplicate_Match.php
    */    {

        $c042_datas[0] = '1 1';
        $c042_datas[1] = '1 3';
        $c042_datas[2] = '2 3';

        #期待値
        $expected_value = "試合データの重複がある";
        try {
            $C042 = new C042_Controller() ;
            $C042->Check_Duplicate_Match($c042_datas);
#            $this->sut->テスト対象メソッド();       //   ２：メソッド実行
            } catch  (\Exception $ex)  {
                print_r("\n");
                print_r("期待値 = ");
                print_r($expected_value);
                print_r("\n");
                print_r("処理結果 = ");
                print_r($ex->getMessage());
            $this->assertStringContainsString($expected_value, $ex->getMessage());
            }

    }

}
