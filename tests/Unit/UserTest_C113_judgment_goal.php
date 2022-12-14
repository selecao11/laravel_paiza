<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\C113_Controller;

class UserTest_C113_judgment_goal extends TestCase
{
    /**
     * A basic unit test example.  テスト2
     *
     * @return void
     */
    public function test_C113_judgment_goal(){
    /* 
    #C113_set_masu_result.xmlファイル作成
    type nul > ./C113_judgment_goal_result.xml

    #UT実行 
    php artisan test --log-junit ./C113_judgment_goal_result.xml --filter test_C113_judgment_goal tests/Unit/UserTest_C113_judgment_goal.php
    */    
        $masus[0] = 'start';
        $masus[1] = '';
        $masus[2] = '+';
        $masus[3] = 'Goal';
       //テスト予想設定定数        
        $goal_judgments_correct="goal";
        $goal_saikoro_count_correct=3;
       //テスト環境設定定数        
        $saikoros_i=3;
        $player_position = 3;
        $headers['masu']=4;
        $C113 = new C113_Controller();
        $goal_judgments = $C113->judgment_goal($headers,$saikoros_i,$player_position);
        //設定データ
        print_r("\n");
        print_r("input_data = ");
        print_r($masus);
        print_r("\n");
       //ゴール設定文字
        print_r("goal_judgments_correct = ");
        print_r($goal_judgments_correct);
        print_r("\n");
        print_r("'sugoroku_goal' = ");
        print_r($goal_judgments['sugoroku_goal']);
        print_r("\n");
        $this->assertEquals($goal_judgments['sugoroku_goal'], 
                            $goal_judgments_correct);
        //ゴールした位置
        print_r("goal_saikoro_count_correct = ");
        print_r($goal_saikoro_count_correct);
        print_r("\n");
        print_r("goal_saikoro_count = ");
        print_r($goal_judgments['goal_saikoro_count']);
        print_r("\n");
        $this->assertEquals($goal_judgments['goal_saikoro_count'], 
                            $goal_saikoro_count_correct);
    }
}