<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\B035_Controller;

class UserTest_B035Gradebook extends TestCase
{
    /**
     * A basic unit test example.  テスト2
     *
     * @return void
     */
    public function testB035Gradebook(){
        /* 
        #B035createGradebook_test_result.xmlファイル作成
            type nul > /home/user/docker-laravel/laravel_paiza/tests/Unit/B035createGradebook_test_result.xml
            echo "" > /home/user/docker-laravel/laravel_paiza/tests/Unit/B035createGradebook_test_result.xml
        #UT実行
        php artisan test    --log-junit /home/user/docker-laravel/laravel_paiza/tests/Unit/B035createGradebook_test_result.xml --filter testB035Gradebook tests/Unit/UserTest_B035.php
        */
        $B035 = new B035_Controller();
        #期待値取得
        $expected_value=array(
            array('alice',7,'UP!'),
            array('betty',4,'UP!'),
            array('ngng',4,'New'),
            array('franca',3,'Down!')
        );

        $fixed_value_read['N'] = 6;
        $fixed_value_read['M'] = 7;
        $fixed_value_read['T'] = 4;

        $cumulative_distances['alice'] = [7,'UP!'];
        $cumulative_distances['betty'] = [4,'UP!'];
        $cumulative_distances['ngng'] = [4,'New'];
        $cumulative_distances['franca'] = [3,'Down!'];
        $cumulative_distances['dad'] = [2,'Down!'];


        $success_callLastmonth = $B035->callGradebook($cumulative_distances,$fixed_value_read);

        print_r("\n");
        print_r("期待値 = ");
        print_r("\n");
        print_r($expected_value);
        print_r("処理結果 = ");
        print_r($success_callLastmonth);
        $this->assertEquals($success_callLastmonth, $expected_value);
    }
}