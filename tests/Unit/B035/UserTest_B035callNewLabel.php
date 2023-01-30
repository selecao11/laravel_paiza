<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\B035_Controller;

class UserTest_B035callNewLabel extends TestCase
{
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
}
