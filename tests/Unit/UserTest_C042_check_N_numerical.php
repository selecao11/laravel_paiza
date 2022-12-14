<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\C042_Controller;
#use Exception;
use App\Http\Controllers\Exception;
class UserTest_C042_check_N_numerical extends TestCase
{
    /**
     * A basic unit test example.  テスト2
     *
     * @return void
     */
    public function test_C042_check_N_numerical_err()
    /*
    #C066_result.xmlファイル作成
    type nul > ./C042_check_N_numerical_err_result.xml

    #UT実行
    php artisan test --log-junit ./C042_check_N_numerical_err_result.xml --filter test_C042_check_N_numerical_err tests/Unit/UserTest_C042_check_N_numerical.php
    #https://mutimutisan.com/phpunit-error-exception
    */    {
        #期待値
        $expected_value = "参加者データに数字以外が入力されている。";
        #入力値
        $c042_datas = '3ss';

        try {
            $C042 = new C042_Controller() ;
            $C042->check_Head_data($c042_datas);
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

    public function test_C042_check_N_numerical_normal()
    /*
    #C066_result.xmlファイル作成
    type nul > ./C042_check_N_numerical_normal_result.xml

    #UT実行
    php artisan test --log-junit ./C042_check_N_numerical_normal_result.xml --filter test_C042_check_N_numerical_normal tests/Unit/UserTest_C042_check_N_numerical.php
    #https://mutimutisan.com/phpunit-error-exception
    */    {
        #期待値
        $expected_value['Total_participants'] = 3;
        #入力値
        $c042_datas = '3';

        $C042 = new C042_Controller() ;
        $headers['Total_participants'] = $C042->check_N_numerical($c042_datas);
#            $this->sut->テスト対象メソッド();       //   ２：メソッド実行
        print_r("\n");
        print_r("期待値 = ");
        print_r($expected_value);
        print_r("\n");
        print_r("処理結果 = ");
        print_r($headers['Total_participants']);
        $this->assertEquals($headers['Total_participants'], $expected_value);
    }

}
