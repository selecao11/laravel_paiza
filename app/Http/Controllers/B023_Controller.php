<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class B023_Controller extends Controller
{

    private $Match_Stick = array();
    private $Tmp_Stick = array();
    private $out_Stick = array();

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
        for ($i = $Ms_i + 1;$i < count($this->Match_Stick);$i++){#取ったマッチの次の位置から開始する。
            print_r("this->Match_Stick");
            print_r($this->Match_Stick[$i]);
            $Result_Match_Stick=$this->Match_Stick;#
            foreach ($this->Give_Match_Sticks as $Give_i => $Gms_Value){#追加可能配列を検索する
#                print_r("this->Give_Match_Sticks");
#                print_r($this->Give_Match_Sticks);
                if ($this->Match_Stick[$i] == $Gms_Value ){    #追加可能か判断する
                    #追加可能文字配列を検索する
                    foreach ($this->Give_Match_Stick_Values[$Gms_Value] as $Gmsv_i => $Gmsv_Value){
                        $Result_Match_Stick[$i]=$Gmsv_Value;
                        $out[]=$Result_Match_Stick;
                        print_r("Give_Match_Stick_Values");
                        print_r($this->Give_Match_Stick_Values);
                        print_r("Result_Match_Stick");
                        print_r($Result_Match_Stick);
                    }
                }
            }
        }
        return  $out;
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
        $Result_Match_Stick=$this->Match_Stick;
        foreach($this->Take_Match_Sticks as $Take_i => $Tms_Value){#取る１本のマッチを選択
            if ($Ms==$Tms_Value){
                break;
            }
        } 
        foreach ($this->Take_Match_Stick_Values[$Tms_Value] as $Tmsv_i => $Tmsv_Value){
            if (count($this->Match_Stick) >=2){
                $Result_Match_Stick = $this->Give_Match_Stick($Ms_i);
                $Result_Match_Stick[$Ms_i]=$Tmsv_Value;
            }
        }       
        return $Result_Match_Stick; 
    }
    /**
    * １本移動データの検索処理
    *
    * @param strng  $Ms_i               ヘッダデータ配列
    * @param strng  $Ms                 ヘッダデータ配列
    * @return strng $Result_Match_Stick 初期化済成績表配列
    * @todo         マッチ棒から１本移動可能か判断する。
    */
    private function Move_Search_match_stick($Ms_i,$Ms){
        $Result_Match_Stick=$this->Match_Stick;
        foreach($this->Move_Match_Sticks as $Move_i => $Mms_Value){
            if ($Mms_Value==$Ms){
                break;
            }
        }
        if ($Mms_Value==$Ms){                               #移動する１本のマッチを選択
            foreach ($this->Move_Match_Stick_Values[strval($Mms_Value)] as $Mmsv_i => $Mmsv_Value){
                $Result_Match_Stick=$this->Match_Stick;
                $Result_Match_Stick[$Ms_i]=$Mmsv_Value;
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

    public function B023_init(){
        #Take
        $this->Take_Match_Sticks = [1,7,8,9];
        $Stick_Values=[7];
        $this->Take_Match_Stick_Values['1'] = $Stick_Values;
        $Stick_Values=[1];
        $this->Take_Match_Stick_Values['7'] = $Stick_Values;
        $Stick_Values=[0,6,9];
        $this->Take_Match_Stick_Values['8'] = $Stick_Values;
        $Stick_Values=[8];
        $this->Take_Match_Stick_Values['9'] = $Stick_Values;

        #Give
        $this->Give_Match_Sticks = [1,3,5,6,9];
        $Stick_Values=[7];
        $this->Give_Match_Stick_Values['1'] = $Stick_Values;
        $Stick_Values=[9];
        $this->Give_Match_Stick_Values['3'] = $Stick_Values;
        $Stick_Values=[9];
        $this->Give_Match_Stick_Values['5'] = $Stick_Values;
        $Stick_Values=[8];
        $this->Give_Match_Stick_Values['6'] = $Stick_Values;
        $Stick_Values=[8];
        $this->Give_Match_Stick_Values['9'] = $Stick_Values;

        #move
        $this->Move_Match_Sticks = [2,3,5,6];
        $Stick_Values=[3];
        $this->Move_Match_Stick_Values['2'] = $Stick_Values;
        $Stick_Values=[2];
        $this->Move_Match_Stick_Values['3'] = $Stick_Values;
        $Stick_Values=[3];
        $this->Move_Match_Stick_Values['5'] = $Stick_Values;
        $Stick_Values=[9];
        $this->Move_Match_Stick_Values['6'] = $Stick_Values;

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
#        array_push($this->Match_Stick,'0');
        array_push($this->Match_Stick,7);
        array_push($this->Match_Stick,1);
#;
        #        array_push($this->Match_Stick,1);
        $this->B023_init();
        foreach ($this->Match_Stick as $ms_i => $ms) {
            $Return_Match_Stick = $this->Move_Search_match_stick($ms_i,$ms);
            if (count($this->Match_Stick) >=2){
                $Return_Match_Stick = $this->Take_Search_match_stick($ms_i,$ms);
            }
        }
        // $this_month_data = array_values($this_month_data);//今月の成績のindex降り直し
        // $r_input['last_month_data'] = $last_month_data;
        // $r_input['this_month_data'] = $this_month_data;
        $r_input = true;
        return view('b023');
        #        return view('b023',compact('comp_Top10','last_Month_total','this_month_data'));
    }
}
