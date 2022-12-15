<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Log;
#use PHPUnit\Framework\TestCase;
use App\Http\Controllers\C066_Controller;
use Tests\TestCase;

class UserTest_C066_Scoop_Goldfish extends TestCase
{
    /**
     * A basic unit test example.  テスト2
     *
     * @return void
     */
    public function test_C066_Scoop_Goldfish()
    /* 
    #C066_result.xmlファイル作成
    type nul > ./C066_Scoop_Goldfish_result.xml

    #UT実行
    php artisan test --log-junit ./C066_Scoop_Goldfish_result.xml --filter test_C066_Scoop_Goldfish tests/Unit/UserTest_C066_Scoop_Goldfish.php
    */    {
        #入力値
        $C066_headers['goldfish_number'] = 5;#金魚の数
        $C066_headers['fish_net'] = 2;#網の数
        $C066_headers['fish_net_durability'] = 10;

        $goldfish_weights[0] = 5;
        $goldfish_weights[1] = 5;
        $goldfish_weights[2] = 3;
        $goldfish_weights[3] = 1;
        $goldfish_weights[4] = 4;

        #期待値
        $expected_value = 5;

        $C066 = new C066_Controller();
        $C066_success_goldfish = $C066->Scoop_Goldfish($C066_headers,$goldfish_weights);
        print_r("\n");
        print_r("期待値 = ");
        print_r($expected_value);
        print_r("\n");
        print_r("処理結果 = ");
        print_r($C066_success_goldfish);
        print_r("\n");
        $this->assertEquals($C066_success_goldfish, $expected_value);
    }
}