<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class B035_v1_20221012_Controller extends Controller
{
//先月の順位の検索
//
//
    private function search_last_Month($last_Month_total,$the_Month_key,$the_Month_index){
        $last_Month_index = 0;
        foreach ($last_Month_total as $last_Month_key => $lasst_Month_data) {            
            if ($last_Month_key == $the_Month_key){
                if ($last_Month_index > $the_Month_index){//先月より順位UP
                    $r_search_last_Month = "UP";
//                    dd('ok_UP',$the_Month_key,$last_Month_key);
                    return $r_search_last_Month;
                }elseif($last_Month_index < $the_Month_index){//先月より順位Down
                    $r_search_last_Month = "Down";
//                   dd('ok_Down');
                    return $r_search_last_Month;
                }else{//先月より順位変わらず
                    $r_search_last_Month = "変動なし";
//                    dd('ok_other');
                    return $r_search_last_Month;
                }
            }
        $last_Month_index ++;
        }
    }

//　今月のデータの検索
// @last_Month_total 先月の集計データ
// @the_Month_total 今月の集計データ
// return $comp_Top10 順位結果
private function comp_Top10($last_Month_total,$the_Month_total){
        $comp_Top10 = [];
        $the_Month_index = 0 ;//順位
        foreach ($the_Month_total as $the_Month_key => $the_Month_data) {            
            $Contents_of_ranking =[];
            if (array_key_exists($the_Month_key, $last_Month_total)){
                $r_search_last_Month = $this->search_last_Month(//先月の順位の検索
                                        $last_Month_total,
                                        $the_Month_key,
                                        $the_Month_index);
                array_push($Contents_of_ranking,$the_Month_key);//抽出結果を編集
                array_push($Contents_of_ranking,$the_Month_data);
                array_push($Contents_of_ranking,$r_search_last_Month);
                $comp_Top10[(string)$the_Month_index] = $Contents_of_ranking;
            }
            $the_Month_index ++;//順位カウントup
        }
         return $comp_Top10;
    }

//　先月の合計のソート
//
//
    private function Last_month_s_TOP10($last_month_data){
        $last_Month_total = [];
        foreach ($last_month_data as $data) {
            $last_Month_total[(string)$data[0]]=$data[1];
        }
        arsort($last_Month_total);
        return $last_Month_total;
    }

//　各自の合計の算出
//
//
    private function Your_Total_for_the_Month($datas){
        $the_Month_total = [];
        $key = null;
        foreach ($datas as $data) {
            if ($key!=$data[0]) {
                $key = $data[0];
                $the_Month_total[$key] = 0;
            }
            $the_Month_total[$key] += $data[1];
        }
        arsort($the_Month_total);
        return $the_Month_total;
    }

//　データの入力と振り分け
//
//
    private function input(){
        //$file_name = "C:\\test_laravel\\app\Http\\Controllers\\B035.txt";
        $file_name = "/var/www/html/laravel_app/app/Http/Controllers/b035.txt";
        $lines = file($file_name,FILE_IGNORE_NEW_LINES);
        $last_month_data =[];
        $this_month_data =[];
        foreach ($lines as $i => $value){
            $d =[];
            $s = substr_count( $value," ");
            if ($s == 1){//先月の成績読み込み
                $w = explode(" ", $value);
                $d[0]=$w[0];
                $d[1] = (int)$w[1];
                $last_month_data[(string)$i] = $d;
            }elseif($s == 2){//今月の成績読み込み
                $w = explode(" ", $value);
                $d[0]=$w[0];
                $d[1] = (int)$w[2];
                $this_month_data[(string)$i] = $d;
            }
        }
        $this_month_data = array_values($this_month_data);//今月の成績のindex降り直し
        $r_input['last_month_data'] = $last_month_data;
        $r_input['this_month_data'] = $this_month_data;
        return $r_input;
    } 

    public function index(){

        $r_input = $this->input();
        $last_month_data = $r_input['last_month_data'];
        $last_Month_total = $this->Last_month_s_TOP10($last_month_data);//先月の各自の合計のソート
        $this_month_data = $r_input["this_month_data"];
        $the_Month_total = $this->Your_Total_for_the_Month($this_month_data);//各自の合計の算出とソート
        $comp_Top10 = $this->comp_Top10($last_Month_total,$the_Month_total);
        return view('b035',compact('comp_Top10','last_Month_total','this_month_data'));
    }
}
