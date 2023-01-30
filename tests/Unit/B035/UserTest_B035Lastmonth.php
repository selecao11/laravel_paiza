<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\B035_Controller;

class UserTest_B035Lastmonth extends TestCase
{
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
}
