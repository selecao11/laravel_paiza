<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator; // Validatorだけでも実行できる

class C113_Controller extends Controller
{

    /**
    * ゴールの編集
    *
    * @param    int     $saikoros_i
    * @return   strng   $goal_judgments
    * @todo             ゴール到着時の文字を設定する
    */
    public function judgment_goal($saikoros_i,$player_position){
        /**
        * judgment_goal
        *
        * @var string   $goal_judgments['sugoroku_goal']
        *               Goal文字配列
        * @var string   $goal_judgments['goal_saikoro_count']
        *               Goal時のサイコロを振った回数配列
        * @var boolean  $goal_judgments['is_success']   
        *               処理結果 true:false
        */
        if($player_position >= $headers['masu']){
            $goal_judgments['sugoroku_goal'] = "goal";
            $goal_judgments['goal_saikoro_count']=$saikoros_i;
            return $goal_judgments;
        }else{
            $goal_judgments['saikoro_count']=$saikoros_i;
            return $goal_judgments;
        }
    } 
    /**
    * マスの条件が+プラスの場合
    * @param    string  $masus                  マス条件の配列
    * @param    int     $sk                     サイコロ
    * @param    int     $player_position        プレイヤの位置
    * @return   int     $headers                サイコロの長さ
    * @todo             プレイヤの位置を+1する
    */
    public function add_position_one($masus,$sk,$player_position,$headers){
        /**
        * add_position_one
        *
        * @var ini      $ADD_1              加算の１を定義   
        */
        $ADD_1 = 1;
        if($masus[$player_position + $sk] == '+'){
            $player_position += $ADD_1;
            if($masu[$player_position] + $ADD_1 >= $headers['masu']){
                #ゴール到着
                $player_position = $headers['masu'];
            }
        }
        return $player_position;
    }

    /**
    * マスの条件が-マイナスの場合
    *
    * @param    string  $masus                  マス条件の配列
    * @param    int     $sk                     サイコロ
    * @param    int     $player_position        プレイヤの位置
    * @return   int     $player_position        処理結果配列
    * @todo             プレイヤの位置を-1する
    */
    public function sub_position_one($masus,$sk,$player_position){
        /**
        * sub_position_one
        *
        * @var ini      $SUB_1              減算の1を定義   
        * @var ini      $SET_ZERO           スタートの0を定義   
        */
        $SUB_1 = 1;
        $SET_ZERO = 0;
        if($masus[$player_position + $sk] == '-'){
            $player_position -= $SUB_1;
            if($player_position <= 0){
                #スタートよりさらに戻る
                $player_position = $SET_ZERO;
            }
        }
        return $player_position;
    }
    /**
    * マスの条件がrプラスの場合
    *
    * @param    string  $masus                  マス条件の配列
    * @param    int     $sk                     サイコロ
    * @param    int     $player_position        プレイヤの位置
    * @return   int     $player_position        処理結果配列
    * @todo             プレイヤの位置をスタートに戻す
    */
    public function start_position($masus,$sk,$player_position){
        /**
        * start_position
        *
        * @var ini      $SET_ZERO           スタートの0を定義   
        */
        $SET_ZERO = 0;
        if($masus[$player_position + $sk] == 'r'){
            $player_position = $SET_ZERO;
        }
        return $player_position;
    }
    public function zero_less($saikoros_i){
    }


    /**
    * 到着マスでの判断
    *
    * @param int    $player_position    プレイヤーの現在位置
    * @param string $masu_saikoros      スゴロクの内容
    * @param int    $saikoro            サイコロの内容
    * @return strng $goal_judgments  
    * @todo         到着マスの内容を判断する
    */
    public function judgment_masu(  $player_position,
                                    $saikoros,
                                    $masu_saikoros){
        /**
        * judgment_masu
        *
        * @var ini      $masus              マスの内容配列   
        * @var ini      $player_position    プレイヤーの進行状況 
        * @var ini      $goal_judgments['sugoroku_goal']
        *               ゴールした場合の'Goal'文字
        */
        $masus = $masu_saikoro_datas['masu'];
        $goal_judgments = null;
        #サイコロを順次実行する
        foreach($saikoros as $saikoros_i=>$sk){
            $player_position +=$sa;
            $player_position = $this->start_position($masus,$sk,$player_position); 
            $player_position = $this->add_position_one($masus,$sk,$player_position);
            $player_position = $this->sub_position_one($masus,$sk,$player_position);
            $goal_judgments = $this->judgment_goal($saikoros_i,$player_position);
            if ($goal_judgments['sugoroku_goal'] != null){
                break;
            }
        }
        $masu_judgment['player_position'] = $player_position;
        $masu_judgment['is_success'] = true;
        return $masu_judgment;
    }

    /**
    * スゴロク実行前初期化
    *
    * @return array strng $saikoro_move_on_init 
    * @todo         プレイヤー、ゴールフラグを初期化する
    */
    public function init_sugoroku(){    
        /**
        * init_sugoroku
        *
        * @var ini      $saikoro_move_on_init['player_position']   
        *               プレイヤ位置初期化 
        * @var ini      $saikoro_move_on_init['sugoroku_goal']   
        *               スゴロクゴールフラグ初期化 
        * @var boolean  $masu_saikoros['is_success']   処理結果 true:false 
        */
        $saikoro_move_on_init['player_position']=0;
        $saikoro_move_on_init['sugoroku_goal']="";
        $saikoro_move_on_init['is_success']=true;
        return $saikoro_move_on_init; 
    }

    /**
    * スゴロクを進める
    *
    * @param int        $head           ヘッダ配列
    * @param strng      $masu_saikoros  マスとサイコロデータ初期化済配列
    * @return　array    strng $input 配列格納済データ
    * @todo             サイコロを振る
    */
    public function shake_saikoro($head,$masu_saikoros){
        /**
        * shake_saikoro
        *
        * @var ini      $saikoro_move_on_init   プレイヤ初期の位置とゴール判定の配列 
        * @var ini      $player_position        プレイヤの位置
        * @var ini      $masu_len               スゴロクの長さ
        * @var ini      $saikoros                サイコロの内容配列
        * @var ini      $saikoro_move_on_init['player_position']   
        *               プレイヤ位置初期化 
        * @var ini      $saikoro_move_on_init['sugoroku_goal']   
        *               スゴロクゴールフラグ初期化 
        * @var boolean  $masu_saikoros['is_success']   処理結果 true:false 
        */
        #スゴロク実行結果初期化
        $saikoro_move_on_init['player_position']=0;
        $saikoro_move_on_init['sugoroku_goal']="";
        #プレイヤー初期化
        $player_position = $saikoro_move_on_init['player_position'];
        #スゴロクの長さ
        $masu_len= $head['masu'];
        #サイコロの内容
        $saikoros = $masu_saikoros['saikoros'];
        #マスの判断
        $goal_judgments = $this->judgment_masu( $player_position,
                                                $saikoro,
                                                $masu_saikoros);
        if($goal_judgments==null){
            $goal_judgments['sugoroku_goal'] = null;
        }
        return  $goal_judgments;
    }

    /**
    * サイコロ数値セット
    *
    * @param    string $masu_set         初期化済マス配列
    * @param    string $c113_datas       全データ配列
    * @return   int $saikoro_datas      サイコロ数値設定済配列
    * @todo     各サイコロ数値を配列に設定する
    */
    public function set_saikoro($set_masu,
                                $masu_saikoros,
                                $c113_datas){
        /**
        * set_masu
        *
        * @var string   $saikoro_position   サイコロ配列の開始位置
        * @var string   $c113_v             $c113_datasの要素
        * @var string   $saikoro_datas           設定済サイコロ配列
        * @var boolean  $goal_judgments['is_success']   
        *               処理結果 true:false
        */
        #マス配列の最後のindexを設定する
        $saikoro_position = $set_masu['masu_end_p'];
        $saikoros = $masu_saikoros['saikoros']; 
        #$c113_datasからmasu_saikoroにサイコロデータをコピーする
        $saikoros = array_slice($c113_datas, $saikoro_position);
        #サイコロ配列のindexを0から振り直す。
        $saikoro_datas=array_map('intval', $saikoros);
        return $saikoro_datas;
    }
    
    /**
    * すごろくマス条件セット
    *
    * @param    strng $c113_datas       全データ配列
    * @param    strng $masu_saikoros    初期化済マス配列
    * @return   strng $set_masus        マス条件設定済配列
    * @todo     各マス条件を配列に設定する
    */
    public function set_masu($masu_saikoros,$c113_datas){
        /**
        * set_masu
        *
        * @var string   $masu   初期化済マス配列
        * @var string   $c113_v $c113_datasの要素
        * @var string   $c113_i $c113_datas配列のindex
        * @var string   goal_judgments['sugoroku_goal']
        *               Goal文字配列
        * @var string   $goal_judgments['goal_saikoro_count']
        *               Goal時のサイコロを振った回数配列
        * @var boolean  $goal_judgments['is_success']   
        *               処理結果 true:false
        */
        $masu = $masu_saikoros['masu'];
        foreach ($c113_datas as $c113_i => $c113_v){
            #サイコロデータになったら終了
            if(is_numeric($c113_v)){
                break;
            }
            if ($c113_v == "+"){
                $masu[$c113_i]="+";
            } elseif ($c113_v == "-"){
                $masu[$c113_i]="-";
            } elseif ($c113_v == "r"){
                $masu[$c113_i]="r";
            } elseif ($c113_v == "x"){
                $masu[$c113_i]="x";
            }
        }
        $set_masu['masu']=$masu;
        $set_masu['masu_end_p']=$c113_i;
        return $set_masu;
    }

    /**
    * 全データからスゴロクとサイコロデータを分割
    *
    * @param    string  $head ヘッダ配列
    * @param    string  $c113_datas 全データ配列
    * @return   string  $masu_saikoro_splits マスとサイコロデータ分割済配列
    * @todo             全データからスゴロクとサイコロデータを分割
    */
    public function split_masu_saikoro($head,$c113_datas){
        /**
        * split_masu_saikoro
        *
        * @var string   $masu_datas マスデータ配列
        * @var ini      $ARRAY_INIT 配列の開始indexを0に定義
        * @var ini      $ARRAY_VALUE 配列の内容を0に定義
        * @var ini      $masu_saikoros['masu'] 初期化済マス配列
        * @var ini      $masu_saikoros['saikoros'] 初期化済サイコロ配列
        */
        #マスデータとサイコロデータ配列を初期化
        $ARRAY_INIT = 0;
        $ARRAY_VALUE = 0;
        $masu_saikoros[] =  array(
                            'masu'=>array_fill($ARRAY_INIT, $headers['masu'], ""),
                            'saikoros'=>array_fill($ARRAY_INIT,$ARRAY_VALUE,0),
                            'is_success'=>true
                        );
        #マス、サイコロデータ分割実行
        $set_masu = $this->set_masu(    $masu_saikoro,
                                        $c113_datas);
        $set_saikoro= $this->set_saikoro(   $set_masu,
                                            $masu_saikoros,
                                            $c113_datas);
        $masu_saikoro_splits['masu'] = $set_masu; 
        $masu_saikoro_splits['saikoro'] = $set_saikoro;
        return $masu_saikoro_splits;
    }

    /**
    * 全データからヘッダー要素を削除
    *
    * @param    strng   $c113_datas 全データ配列
    * @return   strng   $c113_datas ヘッダデータ削除済データ配列
    * @todo             全データからヘッダー要素を削除
    */
    public function unset_data_head($c113_datas){
        /**
        * unset_data_head
        *
        * @var boolean  $c113_datas['is_success']   処理結果 true:false 
        */
        unset($c113_datas['0']);
        #配列のindexを振り直し
        $c113_datas = array_merge($c113_datas);
        return $c113_datas;
    }


    /**
    * 全データからヘッダデータの取得
    *
    * @param strng  $c113_datas 全データ配列
    * @return strng $headers ヘッダデータ配列
    * @todo         読み込んだ全データ配列からヘッダデータだけを抜き取る
    */
    public function get_data_header($c113_datas){
        /**
        * get_data_header
        *
        * @var string   $headers['masu']      マスの数
        * @var string   $headers['saikoro']   サイコロの内容
        * @var int      $masu_saikoro_count   分割されたマスの数とサイコロを振った数
        * @var boolean  $headers['is_success'] 処理が正常終了したか。 
        */
        #データの空白が２つ以上かCHECK
        $masu_saikoro_count = explode(" ", $c113_datas[0]);
        $headers['masu']=intval($masu_saikoro_count[0]);
        $headers['saikoro']=intval($masu_saikoro_count[1]);
        return $headers;
    }

    /**
    * マスデータの複数空白チェック
    *
    * @param    strng   $c113_datas 全データ配列
    * @todo             全データの空白数のCHECK
    */
    public function check_multiple_blanks($c113_datas){
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
    * @param strng $c113_file_name データファイルPath
    * @return array strng $c113_datas 全データ配列
    * @todo 	 読み込んだファイルデータを配列にいれる
    */
    public function input_file($c113_file_name){
        //$file_name = "/var/www/html/laravel_app/app/Http/Controllers/C113.txt";
        $c113_file = file_get_contents($c113_file_name);
        //データファイルのファイル末尾改行の削除
        $c113_file = trim($c113_file);
        $c113_datas = explode("\r\n", $c113_file);
        return $c113_datas;
    }

    public function output__C113(){
        //C113データを全て読み込み
        $file_name = "C:\\laravel_paiza\\app\\Http\\Controllers\\C113.txt";
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
        return view_C113('C099',compact('area'));
    }

    public function index_C113(Request $request){
        return view('C113');
    }
}
