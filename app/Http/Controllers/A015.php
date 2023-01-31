<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class A015 extends Controller
{



    /**
    * A015初期処理
    *
    * @param        なし
    * @return int       $A015_Init      SORT済の各地点別距離配列
    * @return string    $File_Name      入力ファイルＰａｔｈ
    * @return           $Handle         ファイルハンドル
    * @todo             ファイルハンドルを作成する。
    */
    private function initA015(){
        $file_name = "/home/user/docker-laravel/laravel_paiza/app/Http/Controllers/A015.txt";
        $handle = fopen ( $file_name, "r" );
        $A015_Init['file_name'] =$file_name;
        $A015_Init['handle']    =$handle;
        return $B035_Init;
    }

    //　データファイルからM_ijを取得する。    
    public function readCompletePuzzles(){

    }

    //　M_ijを２次元の配列Mにする
    public function makeCompletePuzzles(){

    }

    //　データファイルからB_ijを取得する。
    public function readPuzzleBlocks(){

    }
    
    //　B_ijを２次元の配列Bにする
    public function makePuzzleBlocks(){
    }

    //　スライス
    public function selectBlock($complete_puzzles){
        $LEN_2 = 2;
        $w[] = substr($complete_puzzles[$low], $col,$LEN_2);
        $w[] = substr($complete_puzzles[$low+1], $col,$LEN_2);
        $r['data']=$w;
        return array('data'=>$w,'low'=>$low,'col'=>$col);
    }    
    //　LIST文字列の１文字ずつシフトして先頭要素を削除する。    
    public function copy($s){
        $s[] =$s[0];
        array_shift( $s );
    }
    //　文字列からLIST文字を作成する。    
    public function split($j){
        return str_split($j,1);
    }
    //　４ブロックを１次元に変換して１次元配列Mとする
    public function test($m){
        $t = array_reduce($m, 'array_merge', array());
        $j = join('', $t);
        $s = $this->split($j);
        $r = $this->copy($s);
        return $r;
    }
//　A015初期処理呼び出し
//
//
    public function callA015(){
#        return $this->initA015();
        $m=array(
            array('12'),
            array('34')
        );
        $r = $this->test($m);
        return $r;
    }

}
