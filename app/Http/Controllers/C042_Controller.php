<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Validator; // Validatorだけでも実行できる
use Exception;

class C042_Controller extends Controller
{
    /**
    * 成績表初期化
    *
    * @param strng  $headers        ヘッダデータ配列
    * @return int   $Victory_Tables 初期化済成績表配列
    * @todo         成績表の要素を全て"-"に初期化する。
    */
    public function Aggregate_Grades_init($headers){
        /**
        * Aggregate_Grades_init
        *
        * @var int      $headers['Total_participants']
        *               試合参加者数
        * @var int      $ARRAY_INIT
        *               初期化開始index位置
        * @var string   $Match_Result
        *               初期化済試合結果配列
        */
        $tp=$headers['Total_participants'];
        $ARRAY_INIT=0;
        for ($i=0;$i<$tp;++$i){
            #試合別初期化
            $Match_Result=array_fill($ARRAY_INIT, $tp, "-");
            $Victory_Tables[$i]=$Match_Result;
        }
        return $Victory_Tables;
    }
    /**
    * 成績表作成
    *
    * @param int    $headers        ヘッダデータ配列
    * @param int    $Grades_Data    ソート済成績データ配列
    * @return int   $Victory_Tables 成績処理結果配列
    * @todo         対戦成績により、「W」「L」を設定する
    */
    public function Aggregate_Grades($headers,$Grades_Data){
        /**
        * Aggregate_Grades
        *
        * @var int      $ARRAY_SUB_ONE  成績データindex調整用
        * @var string   $WINNER         勝者用記号 「W」
        * @var string   $ARRAY_SUB_ONE  敗者用記号 「L」
        */
        #定数
        $ARRAY_SUB_ONE=1;
        $WINNER="W";
        $LOSER="L";
        #変数
        $Victory_Tables = $this->Aggregate_Grades_init($headers);
        foreach($Grades_Data as $gd){
            $Victory_Tables [$gd['f']-$ARRAY_SUB_ONE]
                            [$gd['s']-$ARRAY_SUB_ONE]=$WINNER;#勝者
            $Victory_Tables [$gd['s']-$ARRAY_SUB_ONE]
                            [$gd['f']-$ARRAY_SUB_ONE]=$LOSER;#敗者
        }
        return $Victory_Tables;
    }
    /**
    * 取得成績データ配列のSORT
    *
    * @param strng  $c042_datas         全データ配列
    * @return strng $Grades_Data        SORT成績データ配列
    * @todo         抜き取った成績データを昇順にSORTする
    */
    public function Grades_Data_select_sort($Grades_Data){
        /**
        * Grades_Data_select_sort
        *
        * @var  int     $gdkey          成績データ配列のindex
        * @var  int     $tmp_f          SORT用成績データ配列
        * @var  int     $gd_row["f"]    勝利者の番号データ
        * @var  int     $gd_row["s"]    敗者の番号データ
        */
        foreach( $Grades_Data as $gdkey => $gd_row ) {
            $tmp_f[$gdkey] = $gd_row["f"];
            $tmp_s[$gdkey] = $gd_row["s"];
          }
            array_multisort(    $tmp_f, SORT_ASC,
                                $tmp_s, SORT_ASC,
                                $Grades_Data);
        return $Grades_Data;
    }
    /**
    * 全データから成績データの取得
    *
    * @param strng  $c042_datas     全データ配列
    * @return strng $Grades_Data    金魚の重さ配列
    * @todo         読み込んだ全データ配列から成績だけを抜き取る
    */
    public function Grades_Data_select($c042_datas){
        /**
        * Grades_Data_select
        *
        * @var  int     $c042_datas_i
        *               成績データのindex
        */
        foreach($c042_datas as $c042_datas_i=> $c042_dv){
            $w = explode(" ", $c042_dv);
            $Grades_Data[$c042_datas_i]['f'] = intval($w[0]);
            $Grades_Data[$c042_datas_i]['s'] = intval($w[1]);
            #一時領域解放
            unset($w);
        }
        return $Grades_Data;
    }
    /**
    * 全データからヘッドデータの削除
    *
    * @param strng  $c042_datas     全データ配列
    * @return strng $c042_datas     ヘッドデータ削除済成績配列
    * @todo         読み込んだ全データ配列からヘッドデータを削除する
    */
    public function Unset_Head_data($c042_datas){
        /**
        * Unset_Head_data
        */
        unset($c042_datas['0']);#ヘッダを削除し配列のindexを振り直し
        $c042_datas = array_merge($c042_datas);
        return $c042_datas;
    }
    /**
    * 成績データの重複試合チェック
    *
    * @param    int    $c042_datas チェック未成績データ
    * @todo             成績データの重複試合のチェックを行う。
    */
    public function Check_Duplicate_Match($c042_datas){
        /**
        * Check_Duplicate_Match
        * @var  int $MAX_ONE        重複なし
        * @var  int $list           重複検査用LIST
        * @var  int $value_count    要素別重複検査結果配列
        * @var  int $max            最大重複数
        *
        */
        $MAX_ONE = 1;
        foreach($c042_datas as $cd){
            $list = explode(" ", $cd);
            $value_count = array_count_values($list);
            $max = max($value_count); // 最大の出現回数を取得する
            if ($max != $MAX_ONE){
                throw new Exception('試合データの重複がある');
            }
        }
    }
    /**
    * 成績データの重複要素チェック
    *
    * @param    int    $c042_datas チェック未成績データ
    * @todo             成績データの重複要素チェックを行う。
    */
    public function Check_Duplication($c042_datas){
        /**
        * Check_Duplication
        *
        */
        $c042_datas_len = count($c042_datas);
        $unique_c042_datas = array_unique($c042_datas);
        $unique_c042_datas_len = count($unique_c042_datas);
        if ($unique_c042_datas_len != $c042_datas_len){
            throw new Exception('成績データの重複がある');
        }
    }
    /**
    * データの範囲チェック
    *
    * @param    strng   $c042_datas 全データ配列
    * @return   int     $data　     チェック済成績データ
    * @todo     データの範囲チェックを行う。
    */
    public function Check_Numerical_Between($stage,$check_data){
        /**
        * Check_Numerical_Between
        *
        */
        if ($check_data <= 0 or $check_data >= 21 ) {
            // 数字の場合
            throw new Exception($stage.'の数字が1から20の範囲ではない。');
        }else {
            $data = intval($check_data);
            return $data;
        }
    }
    /**
    * データの数字チェック
    *
    * @param    strng   $c042_datas 全データ配列
    * @return   int     $data　     チェック済成績データ
    * @todo     データの数字チェックを行う。
    */
    public function check_numerical($stage,$check_data){
        /**
        * check_N_numerical
        *
        */
        if (!preg_match('/[0-9]+$/', $check_data)) {
            // 数字の場合
            throw new Exception($stage.'に数字以外が入力されている。');
        }else {
            $data = intval($check_data);
            return $data;
        }
    }
    /**
    * 成績データの数字と範囲チェック
    *
    * @param    strng   $c042_datas 全データ配列
    * @todo             成績データの数字と範囲チェック
    */
    public function Check_C042_Data($c042_datas){
        $STAGE="成績データ";
        foreach($c042_datas as $match){
            $match_list = explode(" ", $match);
            foreach($match_list as $match){
                $this->Check_Numerical_Between($STAGE,$match);
            }
        }
    }
    /**
    * ヘッダの数字と範囲チェック
    *
    * @param    strng   $c042_datas 全データ配列
    * @return   int     $match_result_data
    *                   数字チェック済ヘッダデータ
    * @todo             参加者データの数字と範囲チェック
    */
    public function check_Head_data($Participants_Number){
        $stage="参加者データ";
        $check_data = $Participants_Number;
        $data = $this->check_numerical($stage,$check_data);
        $this->Check_Numerical_Between($stage,$check_data);
        $headers['Total_participants'] = $data;
        return $headers;
        }
    /**
    * 全データからヘッダデータの取得
    *
    * @param    strng   $c042_datas 全データ配列
    * @return   int     $headers ヘッダデータ配列
    * @todo             読み込んだ全データ配列から参加社数だけを抜き取る
    */
    public function HeadData_Split($c042_datas){
        /**
        * HeadData_Split
        *
        * @var          $Participants_Numbers
        *               大会参加者配列
        * @var int      $headers['Total_participants']
        *               大会の参加者の総数
        */
        #定数
        $TOTAL_PARTCIPANTS_NUMBER_ZERO=0;
        $Participants_Number = $c042_datas[0];
        return $Participants_Number;
    }

    /**
    * 成績表ヘッダの複数空白チェック
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
    * ファイルの読み込みと配列への格納
    *
    * @param strng  $c042_file_name  データファイルPath
    * @return strng $c042_datas     全データ配列
    * @todo 	 読み込んだファイルデータを配列にいれる
    */
    public function input_file($c042_file_name){
        $c042_file = file_get_contents($c042_file_name);
        //一行になっている入力データのファイル末尾改行の削除
        $c042_file = trim($c042_file);
        $c042_datas = explode("\n", $c042_file);
        return $c042_datas;
    }

    public function output_C042($file_name){
        //C042データを全て読み込み
        #$file_name = "C:\\laravel_paiza\\app\\Http\\Controllers\\C042.txt";
        try {
            $c042_datas = $this->input_file($file_name);
            $Participants_Number = $this->HeadData_Split($c042_datas);
            $headers = $this->check_Head_data($Participants_Number);
            $c042_datas = $this->Unset_Head_data($c042_datas);
            $this->Check_Duplication($c042_datas);
            $this->Check_Duplicate_Match($c042_datas);
            $this->Check_C042_Data($c042_datas);
        } catch (Exception $e) {
            echo '捕捉した例外: ',  $e->getMessage(), "\n";
        }
        //データファイルから成績データを抽出する。
        $Gradebooks = $this->Grades_Data_select($c042_datas);
        $Gradebooks = $this->Grades_Data_select_sort($Gradebooks);

        //リーグ表の作成開始
        $success_goldfish = $this->Aggregate_Grades($headers,$Gradebooks);
        //リーグ表の作成結果整理
        $C042['goldfish_number']=$success_goldfish;

        //C042_リーグ表の結果画面表示
        return $success_goldfish;
        return view_C042('C042',compact('C042'));
    }

    public function index_C066(Request $request){
        return view('C042');
    }
}
