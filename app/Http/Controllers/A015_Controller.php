<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class A015_Controller extends Controller
{

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
