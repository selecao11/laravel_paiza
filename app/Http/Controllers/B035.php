<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class B035 extends Controller
{

    private $FIXED_ERR_BLANK_2 = 2;
    private $LAST_MONTH_ERR_BLANK_0 = 0;
    private $LAST_MONTH_ERR_BLANK_2 = 2;
    private $LAST_MONTH_DISTNCE_0 = 0;
    private $THIS_MONTH_ERR_BLANK_3 = 3;
    private $THIS_MONTH_ERR_BLANK_1 = 1;
    private $CD_DISTANCE_0 = 0;
    private $CD_DISTANCE_1 = 1;
    private $TMJ_DISTANCE_2 = 2;
    private $TMJ_NAME_1 = 1;
    private $JUDG_UP = 0;
    private $JUDG_DOWN = 1;
    private $JUDG_SAME = 2;

    /**
    * 成績上位の部員のみ成績表作成
    *
    * @param            $cumulative_distances   距離集計配列
    * @param            $Fixed_Value_Read       固定値配列
    * @return int       $Create_gradebook       B035成績上位配列       
    * @todo             成績上位の部員のみの成績表作成
    */
    private function createGradebook($cumulative_distances,$fixed_value_read){
        $i = 0;
        foreach($cumulative_distances as $cd_k => $cd_value){
            if ($i >= $fixed_value_read['T']){
                break;
            }
            array_unshift($cd_value,$cd_k);
            $create_gradebook[] = $cd_value;
            $i+=1;
        }
        return $create_gradebook;
    }
//　成績表作成処理呼び出し
//
//
    public function callGradebook($cumulative_distances,$fixed_value_read){
        return $this->createGradebook($cumulative_distances,$fixed_value_read);
    }
    /**
    * 今月の成績に「UP」「Down」「same」を設定する
    *
    * @param            $Cd_value                   距離集計配列
    * @param            $juge                       ランク配列設定添字
    * @return int       $Cd_value                   ランク設定済距離集計配列
    * @todo             「UP」「Down」「same」の設定をする
    */
    private function setLabel( $Cd_value,$juge){
        $JUDG_ARRAY=array('UP!','Down!','same!');
        $Cd_value[1]=$JUDG_ARRAY[$juge];
        return $Cd_value;
    }
//　「UP」「Down」「same」ラベル設定処理呼び出し
//
//
    public function callLabel($Cd_value,$juge){
        return $this->setLabel($Cd_value,$juge);
    }
    /**
    * 今月の成績から「UP」「Down」の判断をする
    *
    * @param            $cumulative_distances   距離集計配列
    *                   $last_months_joggings   先月の成績配列
    * @return int       $this_months_of_performance ランク設定済距離集計配列
    * @todo             今月と先月の成績を比較して「UP」「Down」「same」の判断をする
    */
    private function judGrades($cumulative_distances,$last_months_joggings){
        /**
        * judGrades
        *
        * @var int      $CD_DISTANCE_0
        *               距離集計配列の距離の添字
        * @var int      $JUDG_UP
        *               UP!ラベルの添字
        * @var int      $JUDG_DOWN
        *               DOWN!ラベルの添字
        * @var int      $JUDG_SAME
        *               SAME!ラベルの添字
        */
        foreach( $cumulative_distances as $Cd_i => $Cd_value) {
            $Distance = $Cd_value[$this->CD_DISTANCE_0];
            if ($Cd_value[$this->CD_DISTANCE_1]==='New'){
                continue;
            }elseif ($last_months_joggings[strval($Cd_i)]>$Distance){
                $juge = $this->JUDG_UP;
                $Cd_value = $this->callLabel( $Cd_value,$juge);
                $cumulative_distances[$Cd_i]=$Cd_value;
            }elseif($last_months_joggings[strval($Cd_i)]<$Distance){
                $juge = $this->JUDG_DOWN;
                $Cd_value = $this->callLabel( $Cd_value,$juge);
                $cumulative_distances[$Cd_i]=$Cd_value;
            }elseif($last_months_joggings[strval($Cd_i)]===$Distance){
                $juge = $this->JUDG_SAME;
                $Cd_value = $this->callLabel( $Cd_value,$juge);
                $cumulative_distances[$Cd_i]=$Cd_value;
            };
        }
        return $cumulative_distances;
    }
//　「UP」「Down」ラベル更新処理呼び出し
//
//
    public function callGrades($cumulative_distances,$last_months_joggings){
        return $this->judGrades($cumulative_distances,$last_months_joggings);
    }
    /**
    * 距離集計配列のソート
    *
    * @param        $cumulative_distances   距離集計配列
    * @return int   $cumulative_distances   ソート済距離集計配列 
    * @todo         距離集計配列を距離の降順、部員名の昇順にソートする。
    */
    private function sortCumulativedistances($cumulative_distances){
        /**
        * sortCumulativedistances
        *
        * @var int      $CD_DISTANCE_0
        *               距離集計配列の距離の添字
        * @var int      $id_distance
        *               SORT用の距離(降順)
        * @var String   $id_name
        *               SORT用の部員名(昇順)
        */
    
        foreach( $cumulative_distances as $cd_i=> $cd_value) {
            $id_distance[]  = $cd_value[$this->CD_DISTANCE_0];
            $id_name[]      = $cd_i;
        }
        array_multisort($id_distance,   SORT_DESC, SORT_STRING,
                        $id_name,       SORT_ASC,SORT_NUMERIC,
                        $cumulative_distances);

        return $cumulative_distances;
    }
//　距離集計配列のソート処理呼び出し
//
//
    public function callCumulativedistances($cumulative_distances){
        return $this->sortCumulativedistances($cumulative_distances);
    }
    /**
    * 部員のジョギング距離の累積
    *
    * @param            $last_months_joggings   先月のジョギングデータ配列
    *                   $this_months_joggings   今月のジョギングデータ配列
    * @return int       
    * @todo             部員のジョギング距離の累積
    */
    private function aclDistance($this_months_joggings,$cumulative_distances){
        /**
        * aclDistance
        *
        * @var int      $CD_DISTANCE_0
        *               距離集計配列の距離の添字
        * @var int      $TMJ_DISTANCE_2
        *               今月のジョギングデータ配列の距離の添字
        * @var int      $TMJ_NAME_1
        *               今月のジョギングデータ配列の部員名の添字
        */
        foreach($this_months_joggings as $this_month_i =>$this_month_value){
            $w=$cumulative_distances[$this_month_value[$this->TMJ_NAME_1]];
            $w[$this->CD_DISTANCE_0] += $this_month_value[$this->TMJ_DISTANCE_2];#距離を距離集計配列に累積
            $cumulative_distances[$this_month_value[$this->TMJ_NAME_1]] = $w;
            unset($w);
        }
        return $cumulative_distances;
    }
//　ジョギング距離の累積処理呼び出し
//
//
    public function callDistance($this_months_joggings,$cumulative_distances){
        return $this->aclDistance($this_months_joggings,$cumulative_distances);
    }
    /**
    * 部員の氏名の有無のチェックと有の場合の処理
    *
    * @param            $last_months_joggings   先月のジョギングデータ配列
    *                   $this_months_joggings   今月のジョギングデータ配列
    * @return int       $cumulative_distances    距離集計配列                          
    * @todo             部員の氏名がない場合のラベルの初期化と有の場合の距離の初期化
    */
    private function existsMemberName($last_months_joggings,$this_months_joggings){
        $last_months = $last_months_joggings;
        #    $last_months = array_column( $last_months_joggings, 0);
        $cumulative_distances= [];
        foreach($this_months_joggings as $this_months_name =>$this_months_distances){
            $wn = $this_months_distances[1];
            $cumulative=array_column( $cumulative_distances, 0);
            if (array_key_exists($wn , $last_months)===False){
                $cumulative_distances[$wn]=[0,'New']; #距離集計配列にもない完全新規氏名
            }else{
                $cumulative_distances[$wn]=[0,''];
            }
        }
        return $cumulative_distances;
    }
//　部員の氏名の有無のチェック処理呼び出し
//
//
    public function callMemberName($last_months_joggings,$this_months_joggings){
        return $this->existsMemberName($last_months_joggings,$this_months_joggings);
    }
    /**
    * データから改行などの削除
    *
    * @param            $handle ファイルハンドラー
    * @return int       $data   改行を削除したデータ       
    * @todo             データから改行などの削除をする。
    */
    private function replaceData($handle){
        $data= str_replace(array("\r\n", "\r", "\n"), "", fgets( $handle ));
        return $data;
    }
//　改行削除処理呼び出し
//
//
    public function callreplaceData($handle){
        return $this->replaceData($handle);
    }
    /**
    * データファイルから今月のデータ読み込み
    *
    * @param            $handle             ファイルハンドラー
    * @return           $this_month_value
    *                                       d_i ジョギングした日
    *                                       w_i 部員名
    *                                       x_i ジョギングした距離
    * @todo             データファイルから今月のデータの
    *                   ジョギングした日、部員名、ジョギングした距離を読み込みする。 
    */
    private function readThisMonthValue($fixed_read_value){
        $handle = $fixed_read_value['handle'];
        $m = $fixed_read_value['M'];
        for ($i = 0;$i < $m;$i++){
            $data = $this->callreplaceData($handle);
            $blank_count = substr_count( $data, ' ' );
            if( $blank_count <= $this->THIS_MONTH_ERR_BLANK_1 && 
                $blank_count >= $this->THIS_MONTH_ERR_BLANK_3){
                #err
            }else{
                $w = explode(" ",$data);
                $w[0] =(int)$w[0];
                $w[2] =(int)$w[2];
                $this_month_value[]=$w;
            }
        }
        return $this_month_value;
    }
//　今月のデータ読み込み処理呼び出し
//
//
    public function callThisMonthValue($handle){
        return $this->readThisMonthValue($handle);
    }
    /**
    * データファイルから先月のデータ読み込み
    *
    * @param            $fixedread              固定情報配列
    * @return int       $last_month_value_read
    *                                           a_i 部員名 
    *                                           p_i 距離
    * @todo             データファイルから先月のデータの部員名、距離の読み込み
    */
    private function readLastmonth($fixed_read_value){
        $handle = $fixed_read_value['handle'];
        $n = $fixed_read_value['N'];
        for ($i = 0;$i < $n;$i++){
            $read_value = $this->callreplaceData($handle);
            $blank_count = substr_count( $read_value, ' ' );
            if( $blank_count <= $this->LAST_MONTH_ERR_BLANK_0 && 
                $blank_count >= $this->LAST_MONTH_ERR_BLANK_2){
            }else{
                $w = explode(" ",$read_value);
                $last_month_read_value[strval($w[$this->LAST_MONTH_DISTNCE_0])]=(int)$w[1];
            }
        }
        return $last_month_read_value;
    }
//　先月のデータ読み込み処理呼び出し
//
//
    public function callLastmonth($fixed_read_value){
        return $this->readLastmonth($fixed_read_value);
    }
    /**
    * データファイルから固定データ読み込み
    *
    * @param            $Handle             ファイルハンドル
    * @return int       N                   部員の人数を表す整数 N
    *                   M                   今月のジョギング記録の数を表す整数 M
    *                   T                   先月の上位の人数 T
    * @todo             入力ファイルから固定データを読み込む
    */
    private function readFixedvalue($handle){
        $read_value = $this->callreplaceData($handle);
        $blank_count = substr_count( $read_value, ' ' );
        if($blank_count ===$this->FIXED_ERR_BLANK_2){
            $w = explode(" ",$read_value);
        }
        return array('N'=>(int)$w[0],'M'=>(int)$w[1],'T'=>(int)$w[2]);
    }
//　固定データ読み込み処理呼び出し
//
//
    public function callFixedvalue($handle){
        return $this->readFixedvalue($handle);
    }
    /**
    * B035初期処理
    *
    * @param        なし
    * @return int       $B035_Init      SORT済の各地点別距離配列
    * @return string    $File_Name      入力ファイルＰａｔｈ
    * @return           $Handle         ファイルハンドル
    * @todo             ファイルハンドルを作成する。
    */
    private function initB035(){
        $file_name = "/home/user/docker-laravel/laravel_paiza/app/Http/Controllers/b035.txt";
        $handle = fopen ( $file_name, "r" );
        $B035_Init['file_name'] =$file_name;
        $B035_Init['handle']    =$handle;
        return $B035_Init;
    }
//　B035初期処理呼び出し
//
//
    public function callB035(){
        return $this->initB035();
    }
}
