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

    public function testB035Lastmonth(){
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
            $fixed_read_value['N'] = 6;
            $fixed_read_value['M'] = 7;
            $fixed_read_value['T'] = 4;
            $fixed_read_value['handle'] = $success_handle;

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
    public function testB035ThisMonthValue(){
    /* 
    #B035ThisMonthValue_test_result.xmlファイル作成
        type nul > /home/user/docker-laravel/laravel_paiza/tests/Unit/B035readThisMonthValue_test_result.xml
        echo "" > /home/user/docker-laravel/laravel_paiza/tests/Unit/B035readThisMonthValue_test_result.xml
    #UT実行
    php artisan test    --log-junit /home/user/docker-laravel/laravel_paiza/tests/Unit/B035readThisMonthValue_test_result.xml --filter testB035ThisMonthValue tests/Unit/UserTest_B035.php
    */
        $B035 = new B035_Controller();

        #期待値取得
        $success_file_name = "/home/user/docker-laravel/laravel_paiza/app/Http/Controllers/b035.txt";
        $success_handle = fopen ( $success_file_name, "r" );
        $invalid_value= fgets( $success_handle );
        for ($i =0 ;$i<7;$i++){
            $invalid_data= fgets( $success_handle );
        }
        $fixed_read_value['N'] = 6;
        $fixed_read_value['M'] = 7;
        $fixed_read_value['T'] = 4;
        $fixed_read_value['handle'] = $success_handle;

        $expected_value = array(
            array(3,'alice',6),
            array(4,'alice',1),
            array(4,'franca',3),
            array(5,'cathy',7),
            array(9,'dad',2),
            array(12,'betty',4)
        );
        $success_callLastmonth = $B035->callThisMonthValue($fixed_read_value);
        print_r("\n");
        print_r("期待値 = ");
        print_r("\n");
        print_r($expected_value);
        print_r("処理結果 = ");
        print_r($success_callLastmonth);
        $this->assertEquals($success_callLastmonth, $expected_value);
    }

    public function testB035callMemberName(){
        /* 
        #B035callMemberName_test_result.xmlファイル作成
            type nul > /home/user/docker-laravel/laravel_paiza/tests/Unit/B035callMemberName_test_result.xml
            echo "" > /home/user/docker-laravel/laravel_paiza/tests/Unit/B035callMemberName_test_result.xml
        #UT実行
        php artisan test    --log-junit /home/user/docker-laravel/laravel_paiza/tests/Unit/B035callMemberName_test_result.xml --filter testB035callMemberName tests/Unit/UserTest_B035.php
        */
        $B035 = new B035_Controller();
        $last_months_joggings = array(
            array('aaaaa',4),
            array('eijiro',2),
            array('alice',6),
            array('dad',3),
            array('betty',5),
            array('franca',1)
        );
        $this_months_joggings = array(
            array(3,'alice',6),
            array(4,'alice',1),
            array(4,'franca',3),
            array(5,'aaaaa',7),
            array(9,'dad',2),
            array(12,'betty',4)
        );
        
        #期待値取得
        $expected_value = array('ngng');
        $success_callLastmonth = $B035->callMemberName($last_months_joggings,$this_months_joggings);
        print_r("\n");
        print_r("期待値 = ");
        print_r("\n");
        print_r($expected_value);
        print_r("処理結果 = ");
        print_r($success_callLastmonth);
        $this->assertEquals($success_callLastmonth, $expected_value);
    }

    public function testB035callNewLabel(){
        /* 
        #B035callNewLabel_test_result.xmlファイル作成
            type nul > /home/user/docker-laravel/laravel_paiza/tests/Unit/B035callNewLabel_test_result.xml
            echo "" > /home/user/docker-laravel/laravel_paiza/tests/Unit/B035callNewLabel_test_result.xml
        #UT実行
        php artisan test    --log-junit /home/user/docker-laravel/laravel_paiza/tests/Unit/B035callNewLabel_test_result.xml --filter testB035callNewLabel tests/Unit/UserTest_B035.php
        */
        $B035 = new B035_Controller();
        #期待値取得
        $newLabel_value = array('ngng');
        $expected_value['ngng'] = [0,'new'];
        $cumulative_distances = array();
        $success_callLastmonth = $B035->callNewLabel($cumulative_distances,$newLabel_value);
        print_r("\n");
        print_r("期待値 = ");
        print_r("\n");
        print_r($expected_value);
        print_r("処理結果 = ");
        print_r($success_callLastmonth);
        $this->assertEquals($success_callLastmonth, $expected_value);
    }

    public function testB035callDistance(){
        /* 
        #B035callDistance_test_result.xmlファイル作成
            type nul > /home/user/docker-laravel/laravel_paiza/tests/Unit/B035callDistance_test_result.xml
            echo "" > /home/user/docker-laravel/laravel_paiza/tests/Unit/B035callDistance_test_result.xml
        #UT実行
        php artisan test    --log-junit /home/user/docker-laravel/laravel_paiza/tests/Unit/B035callDistance_test_result.xml --filter testB035callDistance tests/Unit/UserTest_B035.php
        */
        $B035 = new B035_Controller();
        #期待値取得
        $expected_value['ngng'] = [4,'new'];
        $expected_value['alice'] = [7,'new'];
        $expected_value['franca'] = [3,'new'];
        $expected_value['aaaaa'] = [7,'new'];
        $expected_value['dad'] = [2,'new'];
        $expected_value['betty'] = [4,'new'];

        $this_months_joggings = array(
            array(3,'alice',6),
            array(4,'alice',1),
            array(4,'franca',3),
            array(5,'aaaaa',7),
            array(8,'ngng',4),
            array(9,'dad',2),
            array(12,'betty',4)
        );
        $cumulative_distances['ngng'] = [0,'new'];
        $success_callLastmonth = $B035->callDistance($this_months_joggings,$cumulative_distances);

        print_r("\n");
        print_r("期待値 = ");
        print_r("\n");
        print_r($expected_value);
        print_r("処理結果 = ");
        print_r($success_callLastmonth);
        $this->assertEquals($success_callLastmonth, $expected_value);
    }

}