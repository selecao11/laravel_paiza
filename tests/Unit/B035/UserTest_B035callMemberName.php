<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\B035_Controller;

class UserTest_B035callMemberName extends TestCase
{
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
}
