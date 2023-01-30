<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\B035_Controller;

class UserTest_B035Fixedvalue extends TestCase
{
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
   
}
