<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\B035_Controller;

class UserTest_B035init extends TestCase
{

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
}
