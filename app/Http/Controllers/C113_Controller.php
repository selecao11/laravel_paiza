<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator; // Validatorだけでも実行できる

class C113_Controller extends Controller
{
    //折り紙を重ねた場合の面積の計算
    private function resurt_add($origamis_len,$one_len){
        $len_sum=0;
        foreach ($origamis_len as $i => $len_v){
            $len_sum += $len_v;
        }
        return $len_sum * $one_len;
    }

    //前の折り紙と重なっている長さを計算
    private function origami_half_div($overlap_len,$one_len){
        $len_add = $one_len -  intval($overlap_len);
        return $len_add;
    }

    //入力データからヘッダーを削除
    public function unset_overlap_len_datas($overlap_len_datas){
        unset($overlap_len_datas['0']);
        return $overlap_len_datas;
    }

    //入力データから改行を削除    
    public function kaigyou_del($overlap_len_datas){
        foreach ($overlap_len_datas as $i => $v){
            $v = trim($v);
            $overlap_len_datas["$i"] = $v;
        }
        return $overlap_len_datas;
    }


    public function input(){
        //$file_name = "/var/www/html/laravel_app/app/Http/Controllers/C113.txt";
        $file_name = "C:\\laravel_paiza\\app\\Http\\Controllers\\C113.txt";
        $csv_file = file_get_contents($file_name);
        //データファイルの末尾改行の削除
        $csv_file = trim($csv_file);
        $overlap_len_datas = explode("\n", $csv_file);
#        $overlap_len_datas = $this->kaigyou_del($overlap_lens);
        return $overlap_len_datas;
    }


    public function index(Request $request){
        return view('C113');
    }

    public function output(){
#    public function output(Request $request){
#        $count = $request->input('title');
#        $len = $request->input('count');

#        $header[0] =(int)$len;
#        $header[1] =(int)$count;

        //各折り紙の重なっている長さを取得
        $overlap_len_datas = $this->input();
        dd($overlap_len_datas);
        #        $header = $this->get_header($overlap_len_datas);
        //入力データからヘッダーを削除
        $overlap_len_datas = $this-> unset_overlap_len_datas($overlap_len_datas);

        //1枚目の折り紙の長さを取得
        $one_len = $header[0];
        $origami_count = $header[1];

        //各折り紙のデータを計算する
        foreach($overlap_len_datas as $i=> $overlap_len){
            //前の折り紙と重なっている長さを計算
            $origamis_len["$i"] = $this->origami_half_div($overlap_len,$one_len);
        }
        //抽出結果で面積を計算する
        $area = $this->resurt_add($origamis_len,$one_len);
    return view('C099',compact('area'));
    }
}
