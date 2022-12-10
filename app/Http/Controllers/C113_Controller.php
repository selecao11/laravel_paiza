<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator; // Validatorだけでも実行できる

class C113_Controller extends Controller
{
    /**
    * プレイヤの位置編集
    *
    * @param    int     $player_position        プレイヤの位置
    * @param    string  $edit_mode              コマの内容
    * @return   int     $edit_player_position   処理結果配列
    * @todo             到着マスの内容を判断してプレイヤの位置を移動する
    */
    public function edit_player_position($player_position,$edit_mode){
        /**
        * edit_player_position
        *
        * @var ini      $edit_mode          プレイヤーの編集フラグ   
        * @var ini      $edit_player_position['player_position']
        *               編集済プレイヤーの位置
        * @var boolean  $edit_player_position['is_success']   
        *               処理結果 true:false
        */
        if ($edit_mode=='zero'){
            $player_position = 0;
        }elseif($edit_mode=='add') {
            $player_position += 1;
        }elseif($edit_mode=='sub') {
            $player_position -= 1;
        }elseif($edit_mode=='start') {
            $player_position = 0;
        }
        $edit_player_position['player_position'] = $player_position;
        $edit_player_position['is_success'] = true;
        return $edit_player_position;
    }

    /**
    * ゴールの編集
    *
    * @param    int     $saikoros_i
    * @return   strng   $goal_judgments
    * @todo             ゴール到着時の文字を設定する
    */
    public function judgment_goal($saikoros_i){
        /**
        * judgment_goal
        *
        * @var string   goal_judgments['sugoroku_goal']
        *               Goal文字配列
        * @var string   $goal_judgments['goal_saikoro_count']
        *               Goal時のサイコロを振った回数配列
        * @var boolean  $goal_judgments['is_success']   
        *               処理結果 true:false
        */
        $goal_judgments['sugoroku_goal'] = "goal";
        $goal_judgments['goal_saikoro_count']=$saikoros_i;
        $goal_judgments['is_success'] = true;
        return $goal_judgments;
    } 

    /**
    * 到着マスでの判断
    *
    * @param strng  $masu_len           スゴロクの長さ
    * @param int    $player_position    プレイヤーの現在位置
    * @param string $masu_saikoros      スゴロクの内容
    * @param int    $saikoro            サイコロの内容
    * @return strng $masu_judgment['player_position']  
    * @todo         到着マスの内容を判断する
    */
    public function judgment_masu(  $masu_len,
                                    $player_position,
                                    $saikoros,
                                    $masu_saikoros){
        /**
        * judgment_masu
        *
        * @var ini      $masus              マスの内容配列   
        * @var ini      $player_position    プレイヤーの進行状況 
        * @var ini      $goal_judgments     ゴールした場合の結果配列
        * @var ini      $masu_judgments['player_position']   
        *               プレイヤーの現在位置配列
        * @var ini      $masu_judgments['sugoroku_goal']   
        *               'goal'の設定配列
        * @var ini      $edit_mode          プレイヤーの編集フラグ   
        * @var boolean  $masu_judgment['is_success']   
        *               処理結果 true:false
        */
        $masus = $masu_saikoro_datas['masu'];
        #サイコロを順次実行する
        foreach($saikoros as $saikoros_i=>$sa){
            $player_position +=$sa;
            if ($masu[$player_position] >= $masu_len){
                #スゴロクでゴールした場合。
                $goal_judgments = $this->judgment_goal( $saikoros_i,
                                                        $masu_saikoro_datas);
                $masu_judgments['sugoroku_goal'] = $goal_judgment['sugoroku_goal'];
                $masu_judgments['sugoroku_saikoro'] = $goal_judgment['sugoroku_saikoro']=$i;
                break;
            } elseif($masu[$player_position] <= 0){
                #スタートよりさらに戻る
                $edit_mode='zero';
                $player_position = $this->edit_player_position($player_position,$edit_mode);
            } elseif($masu[$player_position] == "+"){
                #マスを1つ進む
                $edit_mode='add';
                $player_position = $this->edit_player_position($player_position,$edit_mode);
            } elseif ($masu[$player_position] == "-"){
                #マスを1つ戻る
                $edit_mode='sub';
                $player_position = $this->edit_player_position($player_position,$edit_mode);
            } elseif ($masu[$player_position] == "r"){
                #スタートに戻る
                $edit_mode='start';
                $player_position = $this->edit_player_position($player_position,$edit_mode);
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
        * @var boolean  $masu_saikoros['is_success']   処理結果 true:false 
        */
        #スゴロク実行結果初期化
        $saikoro_move_on_init = $this->init_sugoroku();
        #プレイヤー初期化
        $player_position = $saikoro_move_on_init['player_position'];
        #スゴロクの長さ
        $masu_len= $head['masu'];
        #サイコロの内容
        $saikoros = $masu_saikoros['saikoros'];
        #マスの判断
        $masu_judgment = $this->judgment_masu( $masu_len,
                                                $player_position,
                                                $saikoro,
                                                $masu_saikoros);
        return  $masu_saikoro_datas;
    }

    /**
    * サイコロ数値セット
    *
    * @param    strng $masu_set         初期化済マス配列
    * @param    strng $c113_datas       全データ配列
    * @return   strng $saikoro_sets      サイコロ数値設定済配列
    * @todo  各サイコロ数値を配列に設定する
    */
    public function set_saikoro($masu_set,$c113_datas){
        /**
        * set_masu
        *
        * @var string   $saikoro_position   サイコロ配列の開始位置
        * @var string   $c113_v             $c113_datasの要素
        * @var string   $saikoros           設定済サイコロ配列
        * @var boolean  $goal_judgments['is_success']   
        *               処理結果 true:false
        */
        #マス配列の最後のindexを設定する
        $saikoro_position = $set_masu['masu_end_p'];
        #$c113_datasからmasu_saikoroにサイコロデータをコピーする
        $saikoros = array_slice($c113_datas, $saikoro_position);
        #サイコロ配列のindexを0から振り直す。
        $saikoro_set['saikoro']=array_map('intval', $saikoros);
        $$saikoro_set['is_success'] = true;
        return $saikoro_sets;
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
            if ($ms == "+"){
                $masu[$c113_i]="+";
            } elseif ($ms == "-"){
                $masu[$c113_i]="-";
            } elseif ($ms == "r"){
                $masu[$c113_i]="r";
            } elseif ($ms == "x"){
                $masu[$c113_i]="x";
            }
        }
        $set_masu['masu']=$masu;
        $set_masu['masu_end_p']=$c113_i+1;
        return $masu_set;
    }

    /**
    * 全データを分割前にマス配列をサイコロ配列を初期化
    *
    * @param    int     $head ヘッダ配列
    * @return   string  $masu_saikoros マスとサイコロデータ初期化済配列
    * @todo             スゴロクとサイコロ配列を初期化する
    */
    public function init_split_masu_saikoro($head){
        /**
        * split_masu_saikoro_init
        *
        * @var ini      $ARRAY_INIT 配列の開始indexを0に定義
        * @var ini      $ARRAY_VALUE 配列の内容を0に定義
        * @var ini      $masu_saikoros['masu'] 初期化済マス配列
        * @var ini      $masu_saikoros['saikoros'] 初期化済サイコロ配列
        * @var boolean  $masu_saikoros['is_success']   処理結果 true:false 
        */
        $ARRAY_INIT = 0;
        $ARRAY_VALUE = 0;
        $masu_saikoros[] =  array(
                            'masu'=>array_fill($ARRAY_INIT, $headers['masu'], ""),
                            'saikoros'=>array_fill($ARRAY_INIT,$ARRAY_VALUE,0),
                            'is_success'=>true
                        );
        return $masu_saikoros;
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
        * @var boolean  $masu_saikoro_splits['is_success']   処理結果 true:false 
        */
        #配列のindexを振り直し
        $c113_datas = array_merge($c113_datas);
        #マスデータとサイコロデータ配列を初期化
        $masu_saikoros = $this->init_split_masu_saikoro();

        #マス、サイコロデータ分割
        $masu_saikoro_splits['masu'] = $this->set_masu($masu_saikoro,$c113_datas);
        $masu_saikoro_splits['saikoro'] = $this->set_saikoro($masu_saikoro,
                                            $c113_datas,
                                            $saikoro_shake_datas);
        $masu_saikoro_splits['is_success']=true;
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
        $c113_datas['is_success'] = true;
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
        * @var int      $space_count          正常な半角空白の数
        * @var string   $space                正常な半角空白
        * @var int      $w_masu_saikoro       分割されたマスの数とサイコロを振った数
        * @var boolean  $headers['is_success'] 処理が正常終了したか。 
        */
        $SPACE_COUNT = 1;
        $SPACE = " ";
        if (substr_count( $c113_datas[0],$SPACE)!=$SPACE_COUNT){
            #半角空白２つ以上か半角空白が存在しない
            throw new Exception('半角空白２つ以上か半角空白が存在しない。');
        }elseif(preg_match('/^[a-zA-Z]+$/', $c113_datas[0])) {
            #英字の場合
            throw new Exception('コマ数かサイコロに英字が入力されている。');
        }else{
            $w_masu_saikoro = explode(" ", $c113_datas[0]);
            $headers['masu']=intval($w_masu_saikoro[0]);
            $headers['saikoro']=intval($w_masu_saikoro[1]);
            $headers['is_success'] = true;
            return $headers;
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
        $c113_datas['data'] = explode("\r\n", $c113_file);
        $c113_datas['is_success'] = true;
        return $c113_datas;
    }

    public function output__C113(){
        //C113データを全て読み込み
        $file_name = "C:\\laravel_paiza\\app\\Http\\Controllers\\C113.txt";
        try {
            $input_datas = $this->input_file($file_name);
            $head = $this->get_data_header($input_datas);
        } catch (Exception $e) {
            echo '捕捉した例外: ',  $e->getMessage(), "\n";
        }
        //入力データからヘッダーを削除
        $unset_head = $this-> unset_data_head($input_datas);

        //データファイルからマスとサイコロデータを分割取得
        $masu__saikoro_datas = $this-> split_masu_saikoro($head,$masu_saikoro);

        //すごろく開始
        $masu_saikoro_datas=$this-> shake_saikoro($head,$masu__saikoro_datas);

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
