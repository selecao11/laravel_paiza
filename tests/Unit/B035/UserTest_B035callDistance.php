<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\B035_Controller;

class UserTest_B035callDistance extends TestCase
{
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
        $expected_value['alice'] = [7,''];
        $expected_value['franca'] = [3,''];
        $expected_value['ngng'] = [4,'New'];
        $expected_value['dad'] = [2,''];
        $expected_value['betty'] = [4,''];

        $this_months_joggings = array(
            array(3,'alice',6),
            array(4,'alice',1),
            array(4,'franca',3),
            array(8,'ngng',4),
            array(9,'dad',2),
            array(12,'betty',4)
        );
        $cumulative_distances['alice'] = [0,''];
        $cumulative_distances['ngng'] = [0,'New'];
        $cumulative_distances['franca'] = [0,''];
        $cumulative_distances['dad'] = [0,''];
        $cumulative_distances['betty'] = [0,''];

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
