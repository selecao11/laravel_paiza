<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Validator; // Validatorだけでも実行できる

class C066_Controller extends Controller
{
    /**
    * 金魚すくい
    *
    * @param strng  $goldfish_weights 金魚の重さ配列
    * @return strng $headers ヘッダデータ配列
    * @todo         ポイがなくなるまで金魚すくいをする
    */
    public function Scoop_Goldfish($headers,$goldfish_weights){
        /**
        * Scoop_Goldfish
        *
        * @var string   $masu_saikoro_counts
        *               ヘッダ分割配列
        */
        $success_goldfish = 0;
        $gw_index = 0;
        $goldfish_number = $headers['goldfish_number'];#金魚の数
        $fish_net = $headers['fish_net'];#網の数
        $fish_net_durability = $headers['fish_net_durability'];#網の耐久性
        while($gw_index<=$goldfish_number - 1){
            Log::error($goldfish_weights[$gw_index]);
            if($fish_net<=0){
                return $success_goldfish;
            }
            if ($fish_net_durability > $goldfish_weights[$gw_index]){
                $success_goldfish = $success_goldfish +1;
                #網の耐久がすくなくなる
                $fish_net_durability = $fish_net_durability - 
                            $goldfish_weights[$gw_index];
                $gw_index=$gw_index + 1;
            }else{
                #網がぼろぼろ
                $fish_net = $fish_net-1;
                $fish_net_durability = 
                    $headers['fish_net_durability'];#網の耐久性
            }
        }
        return $success_goldfish;
    }

    /**
    * 全データから金魚の重さデータの取得
    *
    * @param strng  $c066_datas         全データ配列
    * @return strng $goldfish_weights   金魚の重さ配列
    * @todo         読み込んだ全データ配列から金魚の重さだけを抜き取る
    */
    public function Goldfish_Data_split($c066_datas){
        unset($c066_datas['0']);
        #配列のindexを振り直し
        $c066_datas = array_merge($c066_datas);
        foreach($c066_datas as $c066_dv){
            $goldfish_weights[] = intval($c066_dv);
        }
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
    * 金魚すくいヘッダの複数空白チェック
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
    * 金魚すくいデータの数字チェック
    *
    * @param    strng   $c113_datas 全データ配列
    * @todo             金魚すくいデータの数字チェック
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
    * @param strng $c066_file_name  データファイルPath
    * @return strng $c066_datas     全データ配列
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

    public function output_C066(){
        //C066データを全て読み込み
        $file_name = "C:\\laravel_paiza\\app\\Http\\Controllers\\C066.txt";
        try {
            $c066_datas = $this->input_file($file_name);
            $this->check_multiple_blanks($c066_datas);
            $this->check_numerical($c066_datas);
            $headers = $this->HeadData_Split($c066_datas);
        } catch (Exception $e) {
            echo '捕捉した例外: ',  $e->getMessage(), "\n";
        }
        //入力データからヘッダーを削除
        $c113_datas = $this-> unset_data_head($c113_datas);
        //データファイルからマスと金魚の重さデータを分割取得
        $goldfish_weights = $this->Goldfish_Data_split($c066_datas);

        //金魚すくい開始
        $goldfish_number = $this->Scoop_Goldfish($headers,$goldfish_weights);

        //金魚すくい結果整理
        $C066['goldfish_number']=$goldfish_number;

        //金魚すくい結果画面表示
        return view_C066('C066',compact('C066'));
    }

    public function index_C066(Request $request){
        return view('C066');
    }
}
