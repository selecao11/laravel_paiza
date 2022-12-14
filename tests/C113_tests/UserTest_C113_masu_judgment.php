<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\C113_Controller;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.  テスト2
     *
     * @return void
     */
    public function test_C113_masu_judgment(){
        $C113 = new C113_Controller();
        $masu_len = 5;
        $player_position = 0;
        $saikoro = 3;
        $masu_saikoro_array =array("x","-","+");
        $masu_judgment = $C113->masu_judgment( $masu_len,
                                                    $player_position,
                                                    $saikoro,
                                                    $masu_saikoro_array);

    }
}