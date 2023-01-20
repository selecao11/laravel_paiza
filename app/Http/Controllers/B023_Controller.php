<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class B023_Controller extends Controller
{

    private $Match_sticks_Len = 0;
    private $Match_Stick = array();
    private $Tmp_Stick = array();

    /**
    * １本追加データの検索処理
    *
    * @param strng  $Ms_i                   データ配列の現在の位置
    * @return int   $Result_Match_Stick     編集済配列
    * @todo         追加可能データの検索と編集済配列へのデータ置換を行う。
    */
    private function Give_Match_Stick($Ms_i){
        /**
        * Give_Match_Stick
        *
        * @var string   
        *               データファイルパス
        * @var string   
        *               データ
        */

        $Give_Match_sticks = [1];
        $Stick_Values[]=('7');
        $Give_Match_stick_Values['1'] = $Stick_Values;
        $Result_Match_Stick=$Match_Stick;

        for ($i = $Ms_i + 1;$i <= $Match_sticks_Len;$i++){#取ったマッチの次の位置から開始する。
            foreach ($Give_Match_sticks as $Give_i => $Gms_Value){
                if ($this->$Match_Stick[$i] == $Gms_Value ){    #加えるマッチの有無を検索する
                    $Result_Match_Stick[$i]=$Give_Match_stick_Values[$Gms_Value];
                }
            }
            $Result_Match_Stick=$Match_Stick;
        }
        return $Result_Match_Stick;
    }
    /**
    * １本削除データの検索処理
    *
    * @param strng  $Ms_i               ヘッダデータ配列
    * @param strng  $Ms                 ヘッダデータ配列
    * @return strng $Result_Match_Stick 初期化済成績表配列
    * @todo         マッチ棒から１本削除可能か判断する。
    */
    private function Take_Search_match_stick($Ms_i,$Ms){
        /**
        * Take_Search_match_stick
        *
        * @var string   
        *               データファイルパス
        * @var string   
        *               データ
        */
        $Take_Match_Sticks = [7];
        $Stick_Values[]=('1');
        $Take_Match_Stick_Values['7'] = $Stick_Values;

 
        foreach($Take_Match_Sticks as $Take_i => $Tms_Value){#取る１本のマッチを選択
            if ($Ms==$Tms_value){
                $Result_Match_Stick = $this->Give_Match_Stick($Ms_i);
                $Result_Match_Stick[$Take_i]=$Tms_Value;
            }
        }
        return $Result_Match_Stick; 
    }
    /**
    * ファイル入力
    *
    * @param strng  なし
    * @return int   $lines 初期化済成績表配列
    * @todo         データファイルからすべてのデータを読み込む
    */
    private function input(){
        /**
        * input
        *
        * @var string   file_name
        *               データファイルパス
        * @var string   lines
        *               データ
        */
        $file_name = "/home/user/docker-laravel/laravel_paiza/app/Http/Controllers/b023.txt";
        $lines = file($file_name,FILE_IGNORE_NEW_LINES);
        return $lines;
    } 

    /**
    * main処理
    *
    * @param strng  $headers        ヘッダデータ配列
    * @return int   $Victory_Tables 初期化済成績表配列
    * @todo         マッチ棒を１本移動して別のに加えて数字文字にする
    */
    public function index(){
        /**
        * index
        *
        * @var string   file_name
        *               データファイルパス
        * @var string   lines
        *               データ
        */
#        $lines = $this->input();
#        $match_stick=wordwrap($lines[0], 1, ',',true);
#        $Result = explode(',', $match_stick);
        array_push($this->Match_Stick,'0');
        array_push($this->Match_Stick,'7');
        array_push($this->Match_Stick,'1');
        foreach ($this->Match_Stick as $ms_i => $ms) {
             $Return_Match_Stick = $this->Take_Search_match_stick($ms_i,$ms);
        }
        // $this_month_data = array_values($this_month_data);//今月の成績のindex降り直し
        // $r_input['last_month_data'] = $last_month_data;
        // $r_input['this_month_data'] = $this_month_data;
        $r_input = true;
        dd($Result_Match_Stick);

        return view('b023');
        #        return view('b023',compact('comp_Top10','last_Month_total','this_month_data'));
    }
}
