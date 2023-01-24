<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class B035_Controller extends Controller
{
    /**
    * 成績上位の部員のみ成績表作成
    *
    * @param            
    * @return int       
    * @todo             成績上位の部員のみ成績表作成
    */
    private function Create_gradebook($This_Month_of_Jogging_Performance,$Fixed_Value_Read){
        $Create_gradebook=array();
        for ($i=0;$i<$Fixed_Value_Read['T'];$i++){
            $Create_gradebook[] = $This_Month_of_Jogging_Performance[$i];
        }
        return $Create_gradebook;
    }
    /**
    * 今月の成績を比較して「UP」「Down」の判断をする
    *
    * @param            
    * @return int       
    * @todo             今月の成績を比較して「UP」「Down」の判断をする
    */
    private function Grade_judgment($Cumulative_jogging_distances_sorted,$Last_Month_Value_Read){
        $Judg=array('UP!','Down!','same');
        foreach( $Cumulative_jogging_distances_sorted as $Cjd_i => $Cjd_distance) {
            $Distance = $Cjd_distance[0];
            if ($Last_Month_Value_Read[strval($Cjd_i)]>$Distance){
                $w=array($Cjd_i,$Distance,$Judg[0]);
                $This_Month_of_Jogging_Performance[] = $w;
                del($w);
            }elseif($Last_Month_Value_Read[strval($Cjd_i)]<$Distance){
                $w=array($Cjd_i,$Distance,$Judg[1]);
                $This_Month_of_Jogging_Performance[] = $w;
                del($w);
            }elseif($Last_Month_Value_Read[strval($Cjd_i)]===$Distance){
                $w=array($Cjd_i,$Distance,$Judg[2]);
                $This_Month_of_Jogging_Performance[] = $w;
            };
        }
        return $This_Month_of_Jogging_Performance;
    }
    /**
    * 距離集計配列のソート
    *
    * @param            
    * @return int       
    * @todo             距離集計配列のソート
    */
    private function Cumulative_jogging_distance_sort($Cumulative_jogging_distances){

            foreach( $Cumulative_jogging_distances as $Cjd_name=> $Cjd_distance) {
                $id_distance[]  = $Cjd_distance;
                $id_name[]      = $Cjd_name;
            }
            array_multisort($id_distance,   SORT_DEC, SORT_NUMERIC, 
                            $id_name,       SORT_ASC, SORT_STRING,
                            $Cumulative_jogging_distancess);
            return $Cumulative_jogging_distances_sorted;
    }
    /**
    * 部員のジョギング距離の累積
    *
    * @param            
    * @return int       
    * @todo             部員のジョギング距離の累積
    */
    private function Cumulative_jogging_distance(   $Jogging_Data_For_This_months,
                                                    $Cumulative_jogging_distances){
        $CJD_DISTANCE = 0;
        $JDM_DISTANCE = 2;
        $JDM_NAME = 1;
        foreach($Jogging_Data_For_This_months as $JDM_NAME =>$Jdm_value){
            $Cjd_array = $Cumulative_jogging_distances[$Jdm_value[$JDM_NAME]];
            $Cjd_array[$CJD_DISTANCE] += $Jdm_value[$JDM_DISTANCE];#距離を累積
            $Cumulative_jogging_distances[$name] = $Cjd_array;
        }
        return $Cumulative_jogging_distances;
    }
    /**
    * 部員の氏名の有無のチェック
    *
    * @param            
    * @return int       
    * @todo             部員の氏名の有無のチェック
    */
    private function existsMemberName($last_months_joggings,$this_months_joggings){
        $CJD_NEW_MENBER = 'New';
        $CJD_ZERO_INIT = 0;
        foreach($this_months_joggings as $this_months_name =>$this_months_distances){
            if (isset($last_months_joggings[$this_months_name])){
                $cumulative_distance = $cumulative_distances[$this_months_name];
                $cumulative_distance=[$CJD_ZERO_INIT,''];
                $cumulative_distances[$this_months_name] = $cumulative_distance;
            }else{
                $cumulative_distance=[$CJD_ZERO_INIT,$CJD_NEW_MENBER];
                $cumulative_distances[$this_months_name] = $cumulative_distance;
            };
        }
        return $cumulative_distances;
    }
    /**
    * データから改行などの削除
    *
    * @param            
    * @return int       
    * @todo             データから改行などの削除
    */
    private function readFile($handle){
        $file_read= str_replace(array("\r\n", "\r", "\n"), "", fgets( $handle ));
        return $file_read;
    }
    /**
    * データファイルから今月のデータ読み込み
    *
    * @param            
    * @return int       
    * @todo             データファイルから今月のデータ読み込み
    */
    private function readThisMonthValue($handle){
        $THIS_MONTH_ERR_BLANK_3 = 3;
        $THIS_MONTH_ERR_BLANK_1 = 1;
        $Handle = $Fixed_Value_Read['Handle'];
        $M = $Fixed_Value_Read['M'];
        $Jogging_Data_For_This_months = ayyay();
        for ($i = 0;$i < $M;$i++){
            $Read_Value = $this->file_read($Handle);
            $W_Blank_Count = substr_count( $Read_Value, ' ' );
            if( $W_Blank_Count <= $THIS_MONTH_ERR_BLANK_1 or 
                $W_Blank_Count >= $THIS_MONTH_ERR_BLANK_3){
                #err
            }else{
                $w = explode(" ",$W_Blank_Count);
                $Jogging_Data_For_This_months[]=(int)$w;
            }
        }
        return $Jogging_Data_For_This_months;
    }
    /**
    * データファイルから先月のデータ読み込み
    *
    * @param            
    * @return int       
    * @todo             データファイルから先月のデータ読み込み
    */
    private function readLastmonth($fixedread){
        $LAST_MONTH_ERR_BLANK_0 = 0;
        $LAST_MONTH_ERR_BLANK_2 = 2;
        $LAST_MONTH_DISTNCE_0 = 0;
        $Handle = $Fixed_Value_Read['Handle'];
        $T = $Fixed_Value_Read['T'];
        $Last_months_jogging_records=ayyay();
        for ($i = 0;$i < $T;$i++){
            $Read_Value = $this->readFile($Handle);
            $W_Blank_Count = substr_count( $Read_Value, ' ' );
            if( $W_Blank_Count <= $LAST_MONTH_ERR_BLANK_0 or 
                $W_Blank_Count >= $LAST_MONTH_ERR_BLANK_2){
                #err
            }else{
                $w = explode(" ",$W_Blank_Count);
                $Last_months_jogging_records[strval($w[$LAST_MONTH_DISTNCE_0])]=(int)$w[1];
            }
        }
        return $Last_Month_Value_Read;
    }
    /**
    * データファイルから固定データ読み込み
    *
    * @param            $Handle             ファイルハンドル
    * @return int       $Fixed_Value_Read   SORT済の各地点別距離配列
    * @return string    $File_Name          入力ファイルＰａｔｈ
    * @return           $Handle             ファイルハンドル
    * @todo             ファイルハンドルを作成する。
    */
    private function readFixedvalue($handle){
        $Fixed_ERR_BLANK_2 = 2;
        $read_value = $this->readFile($handle);
        $blank_count = substr_count( $read_value, ' ' );
        if($blank_count ===Fixed_ERR_BLANK_2){
            $w = explode(" ",$W_Blank_Count);
        }
        return array('N'=>(int)$W[0],'M'=>(int)$W[1],'T'=>(int)$W[2]);
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
    private function B035_init(){
        $File_Name = "/home/user/docker-laravel/laravel_paiza/app/Http/Controllers/b035.txt";
        $Handle = fopen ( $File_Name, "r" );
        $B035_Init['file_name'] =$File_Name;
        $B035_Init['Handle']    =$Handle;
        return $B035_Init;
    }
//　メイン処理
//
//
    public function index(){
        $B035_Init = $this->B035_init();
        $handle = $B035_Init;
        $fixed_value = $this->readfixedvalue($handle);
        $last_month  = $this->readLastmonth($fixed_value);
        $this_month_value = $this->This_Month_Value_Read($Handle);
 
        $Cumulative_jogging_distances =   $this->existsMemberName( $Jogging_Data_For_This_months,
                                                                    $Last_Month_Value_Read);
        $Cumulative_jogging_distances   =   $this->Cumulative_jogging_distance( $Jogging_Data_For_This_months,
                                                                                $Cumulative_jogging_distances);
        $Cumulative_jogging_distances_sorted = $this->Cumulative_jogging_distance_sort($Cumulative_jogging_distances);
        $This_Month_of_Jogging_Performance  = $this->Grade_judgment($Cumulative_jogging_distances_sorted,
                                                                    $Last_Month_Value_Read);
        $Create_gradebook = $this->Create_gradebook($This_Month_of_Jogging_Performance,
                                                    $Fixed_Value_Read);
        
        return view('b035',compact('Create_gradebook'));
    }
}
