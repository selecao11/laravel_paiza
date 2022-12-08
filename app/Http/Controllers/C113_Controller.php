<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator; // Validatorだけでも実行できる

class C113_Controller extends Controller
{
    //入力データからヘッダーを削除
    public function unset_overlap_len_datas($input_datas){
        unset($input_datas['0']);
        $unset['data']=$input_datas;
#        print_r($input_datas);
#        print_r($unset['data']);
        $unset['success'] = true;
        return $unset;
    }

    //入力データから改行を削除    
    public function kaigyou_del($overlap_len_datas){
        foreach ($overlap_len_datas as $i => $v){
            $v = trim($v);
            $overlap_len_datas["$i"] = $v;
        }
        return $overlap_len_datas;
    }

    public function saikoro_set($masu_saikoro,
                                $masu_saikoro_datas,
                                $saikoro_shake_datas){
        $p=$masu_saikoro_datas['saikoro_p'];
        $saikoro_shake_datas = array_slice($masu_saikoro, $p);
        $saikoro_shake_datas = array_map('intval', $saikoro_shake_datas);
        $masu_saikoro_datas['saikoro']=$saikoro_shake_datas;
        return $masu_saikoro_datas;
    }

    #マスデータセット
    public function masu_set($masu_saikoro,$masu_datas){
        foreach ($masu_saikoro as $i => $ms){
            if(is_numeric($ms)){
                break;
            }
            if ($ms == "+"){
                $masu_datas[$i]="+";
            } elseif ($ms == "-"){
                $masu_datas[$i]="-";
            } elseif ($ms == "r"){
                $masu_datas[$i]="r";
            } elseif ($ms == "x"){
                $masu_datas[$i]="x";
            }
        }
        $masu_saikoro_datas['masu']=$masu_datas;
        $masu_saikoro_datas['saikoro_p']=$i;
        return $masu_saikoro_datas;
    }

    public function masu_saikoro_split($head,$masu_saikoro){
        #マス　サイコロ混合データ
        $masu_saikoro = array_merge($masu_saikoro);
        #マスデータ初期化
        $masu_datas = array_fill(0, $head['masu'], "");
        #サイコロデータ初期化
        $saikoro_shake_datas = array_fill(0, $head['saikoro'], 0);
        $masu_saikoro_datas = $this->masu_set($masu_saikoro,$masu_datas);
        $masu_saikoro_datas = $this->saikoro_set($masu_saikoro,
                                    $masu_saikoro_datas,
                                    $saikoro_shake_datas);
        return $masu_saikoro_datas;
                                }

    public function get_header($input_datas){
        if (substr_count( $input_datas[0],' ')!=1){
            #半角空白２つ以上か半角空白存在しない
            $head['success'] = false;
            return $head;
        }elseif(preg_match('/^[a-zA-Z]+$/', $input_datas[0])) {
            #英字の場合
            $head['success'] = false;
            return $head;
        }else{
            $w = explode(" ", $input_datas[0]);
            $head['masu']=intval($w[0]);
            $head['saikoro']=intval($w[1]);
            $head['success'] = true;
            return $head;
        }
    }

    public function input($file_name){
        //$file_name = "/var/www/html/laravel_app/app/Http/Controllers/C113.txt";
        $csv_file = file_get_contents($file_name);
        //データファイルの末尾改行の削除
        $csv_file = trim($csv_file);
        $overlap_len_datas['data'] = explode("\r\n", $csv_file);
        $overlap_len_datas['success'] = true;
        return $overlap_len_datas;
    }


    public function index(Request $request){
        return view('C113');
    }

    #スゴロクゴールの編集
    public function player_goal_judgment($i,$masu_saikoro_datas){
        $masu_saikoro_datas['sugoroku_goal']="goal";
        $masu_saikoro_datas['sugoroku_saikoro']=$i;
        return $masu_saikoro_datas;
    }    

    #プレイヤの位置編集
    public function player_position_edit($player_position,$edit_mode){
        if ($edit_mode=='zero'){
            $player_position =0;
            return $player_position;
        }elseif($edit_mode=='add') {
            $player_position +=1;
            return $player_position;
        }elseif($edit_mode=='sub') {
            $player_position -=1;
            return $player_position;
        }elseif($edit_mode=='start') {
            $player_position=0;
            return $player_position;
        }
    }

    #マスの判断
    public function masu_judgment($masu_len,$player_position,$saikoro,$masu_saikoro_datas){
        $masu = $masu_saikoro_datas['masu'];
        foreach($saikoro as $i=>$sa){
            $player_position +=$sa;
            if ($masu[$player_position] >= $masu_len){
                $masu_saikoro_datas = $this->player_goal_judgment($i,$masu_saikoro_datas);
                break;
            } elseif($masu[$player_position] <= 0){
                #スタートよりさらに戻る
                $edit_mode='zero';
                $player_position = $this->player_position_edit($player_position,$edit_mode);
            } elseif($masu[$player_position] == "+"){
                #マスを1つ進む
                $edit_mode='add';
                $player_position = $this->player_position_edit($player_position,$edit_mode);
            } elseif ($masu[$player_position] == "-"){
                #マスを1つ戻る
                $edit_mode='sub';
                $player_position = $this->player_position_edit($player_position,$edit_mode);
            } elseif ($masu[$player_position] == "r"){
                #スタートに戻る
                $edit_mode='start';
                $player_position = $this->player_position_edit($player_position,$edit_mode);
            }
        }
        return $masu_saikoro_datas;
    }

    public function saikoro_move_on_init($masu_saikoro_datas){    
        $masu_saikoro_datas['player_position']=0;
        $masu_saikoro_datas['sugoroku_goal']="";
        return $masu_saikoro_datas; 
    }

    public function saikoro_move_on($head,$masu_saikoro_datas){
        #スゴロク結果初期化        
        $masu_saikoro_datas = $this->saikoro_move_on_init($masu_saikoro_datas);
        #プレイヤー初期化
        $player_position = $masu_saikoro_datas['player_position'];
        #スゴロクの長さ
        $masu_len= $head['masu'];
        #サイコロの内容
        $saikoro = $masu_saikoro_datas['saikoro'];
        #マスの判断
        $masu_saikoro_datas = $this->masu_judgment( $masu_len,
                                                    $player_position,
                                                    $saikoro,
                                                    $masu_saikoro_datas);
        return  $masu_saikoro_datas;
    }

    public function output(){
        //C113データを全て読み込み
        $file_name = "C:\\laravel_paiza\\app\\Http\\Controllers\\C113.txt";
        $input_datas = $this->input($file_name);
        $head = $this->get_header($input_datas);
        //入力データからヘッダーを削除
        $masu_saikoro = $this-> unset_overlap_len_datas($input_datas);

        //データファイルからマスとサイコロデータを分割取得
        $masu__saikoro_datas = $this-> masu_saikoro_split($head,$masu_saikoro);

        //すごろく開始
        $masu_saikoro_datas=$this-> saikoro_move_on($head,$masu__saikoro_datas);

        //すごろく結果判断
        if ($masu_saikoro_datas['sugoroku_goal'] == ""){
            $masu_saikoro_datas['player_position']=$player_position;
        } 

        //抽出結果で面積を計算する
    return view('C099',compact('area'));
    }
}
