<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\C113_Controller;

class UserTest_C113_start_position extends TestCase
{
    /**
     * A basic unit test example.  テスト2
     *
     * @return void
     */
    public function test_C113_start_position()
    /* 
    #C113_set_masu_result.xmlファイル作成
    type nul > ./C113_start_position_result.xml

    #UT実行 
    php artisan test --log-junit ./C113_start_position_result.xml --filter test_C113_start_position tests/Unit/UserTest_C113_start_position.php
    */    {
        $masus[0] = '';
        $masus[1] = 'r';
        $masus[2] = '';
        $masus[3] = '';
        $masus[4] = '';
        $player_position_correct=0;
        $player_position = 0;
        $sk = 1;
        $C113 = new C113_Controller();
        $player_position = $C113->start_position($masus,$sk,$player_position);
        print_r("\n");
        print_r("input_data = ");
        print_r($masus);
        print_r("\n");
        print_r("player_psosition_correct = ");
        print_r($player_position_correct);
        print_r("\n");
        print_r("player_position = ");
        print_r($player_position);
        print_r("\n");
        $this->assertEquals($player_position, $player_position_correct);
        // print_r("masu_saikoros['saikoros'] = ");
        // print_r($masu_saikoros['saikoros']);
        // print_r("\n");
        // $this->assertEquals($masu_saikoro_splits['saikoros'], $masu_saikoros['saikoros']);
    }
}