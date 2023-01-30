<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\B035_Controller;

class UserTest_B035Grades extends TestCase
{
    public function testB035Grades(){
        /* 
        #B035judGrades_test_result.xmlファイル作成
            type nul > /home/user/docker-laravel/laravel_paiza/tests/Unit/B035judGrades_test_result.xml
            echo "" > /home/user/docker-laravel/laravel_paiza/tests/Unit/B035judGrades_test_result.xml
        #UT実行
        php artisan test    --log-junit /home/user/docker-laravel/laravel_paiza/tests/Unit/B035judGrades_test_result.xml --filter testB035Grades tests/Unit/UserTest_B035.php
        */
        $B035 = new B035_Controller();
        #期待値取得
        $expected_value['alice'] = [7,'UP!'];
        $expected_value['betty'] = [4,'UP!'];
        $expected_value['ngng'] = [4,'New'];
        $expected_value['franca'] = [3,'Down!'];
        $expected_value['dad'] = [2,'Down!'];

        $cumulative_distances['alice'] = [7,''];
        $cumulative_distances['betty'] = [4,''];
        $cumulative_distances['ngng'] = [4,'New'];
        $cumulative_distances['franca'] = [3,''];
        $cumulative_distances['dad'] = [2,''];
 
        $last_months_joggings['alice'] = 9;
        $last_months_joggings['betty'] = 6;
        $last_months_joggings['franca'] = 2;
        $last_months_joggings['dad'] = 1;

        $success_callLastmonth = $B035->callGrades($cumulative_distances,$last_months_joggings);

        print_r("\n");
        print_r("期待値 = ");
        print_r("\n");
        print_r($expected_value);
        print_r("処理結果 = ");
        print_r($success_callLastmonth);
        $this->assertEquals($success_callLastmonth, $expected_value);
    }
}
