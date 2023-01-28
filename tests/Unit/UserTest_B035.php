<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\B035_Controller;

class UserTest_B035 extends TestCase
{
    /**
     * A basic unit test example.  テスト2
     *
     * @return void
     */
    public function test_B035init()
    /* 
    #B035init_test_result.xmlファイル作成
        type nul > /home/user/docker-laravel/laravel_paiza/tests/Unit/B035init_test_result.xml
        echo "" > /home/user/docker-laravel/laravel_paiza/tests/Unit/B035init_test_result.xml
    #UT実行
    php artisan test    --log-junit /home/user/docker-laravel/laravel_paiza/tests/Unit/B035init_test_result.xml                         --filter test_B035init tests/Unit/UserTest_B035.php
    */    {
        $B035 = new B035_Controller();
        $success_callB035 = $B035->callB035();
        #期待値取得
        $expected_file_name = "/home/user/docker-laravel/laravel_paiza/app/Http/Controllers/b035.txt";
        $expected_handle = fopen ( $expected_file_name, "r" );
        $expected_value['file_name'] = $expected_file_name;
        print_r("\n");
        print_r("期待値 = ");
        print_r("\n");
        print_r($expected_value);
        print_r("処理結果 = ");
        print_r($success_callB035);
        $this->assertEquals($success_callB035['file_name'], $expected_value['file_name']);
    }

    public function testB035Fixedvalue(){
    /* 
    #B035Fixedvalue_test_result.xmlファイル作成
        type nul > /home/user/docker-laravel/laravel_paiza/tests/Unit/B035Fixedvalue_test_result.xml
        echo "" > /home/user/docker-laravel/laravel_paiza/tests/Unit/B035Fixedvalue_test_result.xml
    #UT実行
    php artisan test    --log-junit /home/user/docker-laravel/laravel_paiza/tests/Unit/B035Fixedvalue_test_result.xml --filter testB035Fixedvalue tests/Unit/UserTest_B035.php
    */
        $B035 = new B035_Controller();

        #期待値取得
        $success_file_name = "/home/user/docker-laravel/laravel_paiza/app/Http/Controllers/b035.txt";
        $success_handle = fopen ( $success_file_name, "r" );
        $success_callFixedvalue = $B035->callFixedvalue($success_handle);
        $expected_value['N'] = 6;
        $expected_value['M'] = 7;
        $expected_value['T'] = 4;
        print_r("\n");
        print_r("期待値 = ");
        print_r("\n");
        print_r($expected_value);
        print_r("処理結果 = ");
        print_r($success_callFixedvalue);
        $this->assertEquals($success_callFixedvalue['N'], $expected_value['N']);
        $this->assertEquals($success_callFixedvalue['M'], $expected_value['M']);
        $this->assertEquals($success_callFixedvalue['T'], $expected_value['T']);
    }

    public function testB035readLastmonth(){
        /* 
        #B035Fixedvalue_test_result.xmlファイル作成
            type nul > /home/user/docker-laravel/laravel_paiza/tests/Unit/B035readLastmonth_test_result.xml
            echo "" > /home/user/docker-laravel/laravel_paiza/tests/Unit/B035readLastmonth_test_result.xml
        #UT実行
        php artisan test    --log-junit /home/user/docker-laravel/laravel_paiza/tests/Unit/B035readLastmonth_test_result.xml --filter testB035readLastmonth tests/Unit/UserTest_B035.php
        */
            $B035 = new B035_Controller();
    
            #期待値取得
            $success_file_name = "/home/user/docker-laravel/laravel_paiza/app/Http/Controllers/b035.txt";
            $success_handle = fopen ( $success_file_name, "r" );
            $invalid_data= fgets( $success_handle );
            $Lastmonth_value['N'] = 6;
            $Lastmonth_value['M'] = 7;
            $Lastmonth_value['T'] = 4;
            $Lastmonth_value['handle'] = $success_handle;

            $expected_value['cathy'] = 4;
            $expected_value['eijiro'] = 2;
            $expected_value['alice'] = 6;
            $expected_value['dad'] = 3;
            $success_callLastmonth = $B035->callLastmonth($Lastmonth_value);
            print_r("\n");
            print_r("期待値 = ");
            print_r("\n");
            print_r($expected_value);
            print_r("処理結果 = ");
            print_r($success_callLastmonth);
            $expected_value['cathy'] = 4;
            $expected_value['eijiro'] = 2;
            $expected_value['alice'] = 6;
            $expected_value['dad'] = 3;
            $this->assertEquals($success_callLastmonth, $expected_value);
        }
        public function testB035readThisMonthValue(){#作成中
            /* 
            #B035Fixedvalue_test_result.xmlファイル作成
                type nul > /home/user/docker-laravel/laravel_paiza/tests/Unit/B035readLastmonth_test_result.xml
                echo "" > /home/user/docker-laravel/laravel_paiza/tests/Unit/B035readLastmonth_test_result.xml
            #UT実行
            php artisan test    --log-junit /home/user/docker-laravel/laravel_paiza/tests/Unit/B035readLastmonth_test_result.xml --filter testB035readLastmonth tests/Unit/UserTest_B035.php
            */
                $B035 = new B035_Controller();
        
                #期待値取得
                $success_file_name = "/home/user/docker-laravel/laravel_paiza/app/Http/Controllers/b035.txt";
                $success_handle = fopen ( $success_file_name, "r" );
                $invalid_data= fgets( $success_handle );
                $Lastmonth_value['N'] = 6;
                $Lastmonth_value['M'] = 7;
                $Lastmonth_value['T'] = 4;
                $Lastmonth_value['handle'] = $success_handle;
    
                $expected_value['cathy'] = 4;
                $expected_value['eijiro'] = 2;
                $expected_value['alice'] = 6;
                $expected_value['dad'] = 3;
                $success_callLastmonth = $B035->callThisMonthValue($Lastmonth_value);
                print_r("\n");
                print_r("期待値 = ");
                print_r("\n");
                print_r($expected_value);
                print_r("処理結果 = ");
                print_r($success_callLastmonth);
                $expected_value['cathy'] = 4;
                $expected_value['eijiro'] = 2;
                $expected_value['alice'] = 6;
                $expected_value['dad'] = 3;
                $this->assertEquals($success_callLastmonth, $expected_value);
            }
    
    }