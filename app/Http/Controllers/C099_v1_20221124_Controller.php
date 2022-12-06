<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator; // Validatorだけでも実行できる

class C099_v1_20221124_Controller extends Controller
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

    //処理件数を取得
/*     private function origami_count_get($header){
        $origami_count = $header['0']; 
        return  $origami_count;
    }
 */
/*     //折り紙の長さを取得
    private function origami_len_get($header){
        $one_len = $header['1']; 
        return  $one_len;
    }
 */
    //入力データからヘッダーを削除
    public function unset_overlap_len_datas($overlap_len_datas){
        unset($overlap_len_datas['0']);
        return $overlap_len_datas;
    }

    //入力データからheaderを取得
/*     public function get_header($overlap_len_datas){
        $overlap_len_datas['0'] = str_replace(array("\r\n", "\r", "\n"), "", $overlap_len_datas['0']);
        $header = $overlap_len_datas['0'];
        $header = explode(" ", $header);
        return $header;
    }
 */
    //入力データから改行を削除    
    public function kaigyou_del($overlap_len_datas){
        foreach ($overlap_len_datas as $i => $v){
            $v = trim($v);
            $overlap_len_datas["$i"] = $v;
        }
        return $overlap_len_datas;
    }

    public function store(Request $request)
    {

        //
    }

    public function input(){
        $file_name = "C:\\laravel_paiza\\app\Http\\Controllers\\C099.txt";
        $csv_file = file_get_contents($file_name);
        //データファイルの末尾改行の削除
        $csv_file = trim($csv_file);
        $overlap_lens = explode("\n", $csv_file);
        $overlap_len_datas = $this->kaigyou_del($overlap_lens);
        return $overlap_len_datas;
    }


    public function index(Request $request){
        return view('C099');
    }
    public function output(Request $request){
        $count = $request->input('title');
        $len = $request->input('count');

        $request->validate([
            'count' => 'numeric|between:1,10',
            'len' => 'numeric|between:1,10',
        ],
         [
            'count.numeric' => '枚数が数字ではない',      #validation.phpのnumericの内容を更新する
            'count.between' => '数がおおきい',      #validation.phpのnumericの内容を更新する
            'len.numeric' => '長さが数字ではない',      #validation.phpのnumericの内容を更新する
            'len.between' => '数がおおきい ',      #validation.phpのnumericの内容を更新する
        ]);

        $header[0] =(int)$len;
        $header[1] =(int)$count;
        #            return redirect('/errorpage')
#            ->withErrors($validator)
#            ->withInput();
/*           } else {
            return view('sample.index', ['msg' => 'OK']);
          }
 */
        //各折り紙の重なっている長さを取得
        $overlap_len_datas = $this->input();
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
