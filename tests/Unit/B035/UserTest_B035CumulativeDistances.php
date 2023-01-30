<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\B035_Controller;

class UserTest_B035CumulativeDistances extends TestCase
{
    public function testB035CumulativeDistances(){
        /* 
        #B035sortCumulativeDistances_test_result.xmlファイル作成
            type nul > /home/user/docker-laravel/laravel_paiza/tests/Unit/B035sortCumulativeDistances_test_result.xml
            echo "" > /home/user/docker-laravel/laravel_paiza/tests/Unit/B035sortCumulativeDistances_test_result.xml
        #UT実行
        php artisan test    --log-junit /home/user/docker-laravel/laravel_paiza/tests/Unit/B035sortCumulativeDistances_test_result.xml --filter testB035CumulativeDistances tests/Unit/UserTest_B035.php
        */
        $B035 = new B035_Controller();
        #期待値取得
        $expected_value['alice'] = [7,''];
        $expected_value['betty'] = [4,''];
        $expected_value['ngng'] = [4,'New'];
        $expected_value['franca'] = [3,''];
        $expected_value['dad'] = [2,''];

        $cumulative_distances['alice'] = [7,''];
        $cumulative_distances['franca'] = [3,''];
        $cumulative_distances['ngng'] = [4,'New'];
        $cumulative_distances['dad'] = [2,''];
        $cumulative_distances['betty'] = [4,''];

        $success_callLastmonth = $B035->callCumulativedistances($cumulative_distances);

        print_r("\n");
        print_r("期待値 = ");
        print_r("\n");
        print_r($expected_value);
        print_r("処理結果 = ");
        print_r($success_callLastmonth);
        $this->assertEquals($success_callLastmonth, $expected_value);
    }
}
