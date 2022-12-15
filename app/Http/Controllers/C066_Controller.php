<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator; // Validatorだけでも実行できる

class C066_Controller extends Controller
{

    /**
    * 全データからヘッダデータの取得
    *
    * @param strng  $c066_datas 全データ配列
    * @return strng $headers ヘッダデータ配列
    * @todo         読み込んだ全データ配列から金魚の重さだけを抜き取る
    */
    public function Goldfish_Data_split($c066_datas){
        /**
        * Goldfish_Data_split
        *
        * @var string   $masu_saikoro_counts
        *               ヘッダ分割配列
        * @var int      $headers['goldfish_number']
        *               金魚の数
        * @var int      $headers['fish_net']
        *               パイの数
        * @var int      $headers['goldfish_weight']
        *               金魚の重さ
        */
        unset($c066_datas['0']);
        $goldfish_weights = $c066_datas;
        return $goldfish_weights;
    }
    /**
    * 全データからヘッダデータの取得
    *
    * @param strng  $c066_datas 全データ配列
    * @return strng $headers ヘッダデータ配列
    * @todo         読み込んだ全データ配列からヘッダデータだけを抜き取る
    */
    public function HeadData_Split($c066_datas){
        /**
        * HeadData_Split
        *
        * @var string   $masu_saikoro_counts
        *               ヘッダ分割配列
        * @var int      $headers['goldfish_number']
        *               金魚の数
        * @var int      $headers['fish_net']
        *               パイの数
        * @var int      $headers['goldfish_weight']
        *               金魚の重さ
        */
        $masu_saikoro_count = explode(" ", $c066_datas[0]);
        $headers['goldfish_number']=intval($masu_saikoro_count[0]);
        $headers['fish_net']=intval($masu_saikoro_count[1]);
        $headers['goldfish_weight']=intval($masu_saikoro_count[2]);
        return $headers;
    }

    /**
    * マスデータの複数空白チェック
    *
    * @param    strng   $c113_datas 全データ配列
    * @todo             全データの空白数のCHECK
    */
    public function check_multiple_blanks($c066_datas){
        /**
        * check_multiple_blanks
        *
        * @var int      $SPACE_COUNT_ONE      正常な半角空白の数
        * @var string   $SPACE                正常な半角空白
        */
        $SPACE_COUNT_ONE= 1;
        $SPACE_COUNT_ZERO= 0;
        $SPACE = " ";
        foreach($c113_datas as $c113_i =>$c113_v){
            #ヘッダであり半角空白２つ以上ある半角空白が存在しない
            if (substr_count(   $c113_v,$SPACE)!=$SPACE_COUNT_ONE and
                                $c113_i == 0){
                throw new Exception('半角空白２つ以上か半角空白が存在しない。');
            }
            #データであり半角空白1以上ある
            if (substr_count(   $c113_v,$SPACE)!=$SPACE_COUNT_ZERO and
                                $c113_i >= 1){
                    throw new Exception('半角空白1つ以上ある。');
            }
        }
    }

    /**
    * サイコロデータの数字チェック
    *
    * @param    strng   $c113_datas 全データ配列
    * @todo             ヘッダーとサイコロデータの数字チェック
    */
    public function check_numerical($datas){
        /**
        * check_numerical_saikoro
        *
        */
        foreach ($datas as $v){
            if(!preg_match('/^[0-9]+$/', $v)){
                #英字の場合
                throw new Exception('コマ数かサイコロに数字以外が入力されている。');
            }
        }
    }

    /**
    * ファイルの読み込みと配列への格納
    *
    * @param strng $c066_file_name データファイルPath
    * @return array strng $c066_datas 全データ配列
    * @todo 	 読み込んだファイルデータを配列にいれる
    */
    public function input_file($c066_file_name){
        //$file_name = "/var/www/html/laravel_app/app/Http/Controllers/C113.txt";
        $c066_file = file_get_contents($c066_file_name);
        //データファイルのファイル末尾改行の削除
        $c066_file = trim($c066_file);
        $c066_datas = explode("\r\n", $c066_file);
        return $c066_datas;
    }

    public function output__C066(){
        //C066データを全て読み込み
        $file_name = "C:\\laravel_paiza\\app\\Http\\Controllers\\C066.txt";
        try {
            $c113_datas = $this->input_file($file_name);
            $this->check_multiple_blanks($c113_datas);
            $this->check_numerical($c113_datas);
            $head = $this->get_data_header($c113_datas);
        } catch (Exception $e) {
            echo '捕捉した例外: ',  $e->getMessage(), "\n";
        }
        //入力データからヘッダーを削除
        $c113_datas = $this-> unset_data_head($c113_datas);
        //データファイルからマスとサイコロデータを分割取得
        $masu_saikoro_datas = $this->split_masu_saikoro($head,$c113_datas);

        //すごろく開始
        $masu_saikoro_datas=$this-> shake_saikoro($head,$masu_saikoro_datas);

        //すごろく結果判断
        if ($masu_saikoro_datas['sugoroku_goal'] == ""){
            $masu_saikoro_datas['player_position']=$player_position;
        } 

        //抽出結果で面積を計算する
        return view_C066('C066',compact('area'));
    }

    public function index_C066(Request $request){
        return view('C066');
    }
}
