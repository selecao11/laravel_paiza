<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\A015;

class UserTest_A015 extends TestCase
{
    public function testA015(){
        /* 
        #A015_test_result.xmlファイル作成
            type nul > /home/user/docker-laravel/laravel_paiza/tests/Unit/A015/A015_test_result.xml
            echo "" > /home/user/docker-laravel/laravel_paiza/tests/Unit/A015/A015_test_result.xml
        #UT実行
        php artisan test    --log-junit /home/user/docker-laravel/laravel_paiza/tests/Unit/A015_test_result.xml --filter testA015 tests/Unit/A015/UserTest_A015.php
        */
        $A015 = new A015();
        #期待値取得
        $expected_value = 'yes';

        $cumulative_distances['dad'] = [2,''];
 
        $last_months_joggings['dad'] = 1;

        $success_callLastmonth = $A015->callA015();

        print_r("\n");
        print_r("期待値 = ");
        print_r("\n");
        print_r($expected_value);
        print_r("処理結果 = ");
        print_r($success_callLastmonth);
        $this->assertEquals($success_callLastmonth, $expected_value);
    }
}
