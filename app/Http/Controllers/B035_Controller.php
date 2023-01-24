<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class B035_Controller extends Controller
{
//　成績上位の部員のみ成績表作成
//
//
    private function Create_gradebook($This_Month_of_Jogging_Performance,$Fixed_Value_Read){
        $Create_gradebook=array();
        for ($i=0;$i<$Fixed_Value_Read['T'];$i++){
            $Create_gradebook[] = $This_Month_of_Jogging_Performance[$i];
        }
        return $Create_gradebook;
    }
//　今月の成績を比較して「UP」「Down」の判断をする
//
//
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
//　距離集計配列のソート
//
//
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
//　部員のジョギング距離の累積
//
//
    private function Cumulative_jogging_distance($Jogging_Data_For_This_months){
        foreach($Jogging_Data_For_This_months as $Jdm_name =>$Jdm_value){
            $Cumulative_jogging_distances[$name] += $Jdm_value;
        }
        return $Cumulative_jogging_distances;
    }
//　部員の氏名の有無のチェック
//
//
    private function Member_name_check($Jogging_Data_For_This_months,$Last_Month_Value_Read){
        foreach($Jogging_Data_For_This_months as $Jdm_name =>$Jdm_value){
            if (isset($Last_months_jogging_records[$Jdm_name])){
                $w=[0,''];
                $Cumulative_jogging_distances[$name] = $w;
                del($w);
            }else{
                $w=[0,'New'];
                $Cumulative_jogging_distances[$name] = $w;
                del($w);
            };
        }
        return $Cumulative_jogging_distances;
    }
//　データから改行などの削除
//
//
    private function file_read($Handle){
        $Rmp_file_read= str_replace(array("\r\n", "\r", "\n"), "", fgets( $Handle ));
        return $Rmp_file_read;
    }
//　データファイルから今月のデータ読み込み
//
//
    private function This_Month_Value_Read($Handle){
        $Handle = $Fixed_Value_Read['Handle'];
        $M = $Fixed_Value_Read['M'];
        $Jogging_Data_For_This_months = ayyay();
        for ($i = 0;$i < $M;$i++){
            $Read_Value = $this->file_read($Handle);
            $W_Blank_Count = substr_count( $Read_Value, ' ' );
            if($W_Blank_Count <= 1 or $W_Blank_Count >= 3){
                #err
            }else{
                $w = explode(" ",$W_Blank_Count);
                $Jogging_Data_For_This_months[]=(int)$w;
            }
        }
        return $Jogging_Data_For_This_months;
    }
//　データファイルから先月のデータ読み込み
//
//
    private function Last_Month_Value_Read($Fixed_Value_Read){
        $Handle = $Fixed_Value_Read['Handle'];
        $T = $Fixed_Value_Read['T'];
        $Last_months_jogging_records=ayyay();
        for ($i = 0;$i < $T;$i++){
            $Read_Value = $this->file_read($Handle);
            $W_Blank_Count = substr_count( $Read_Value, ' ' );
            if($W_Blank_Count <= 0 or $W_Blank_Count >= 2){
                #err
            }else{
                $w = explode(" ",$W_Blank_Count);
                $Last_months_jogging_records[strval($w[0])]=(int)$w[1];
            }
        }
        return $Last_Month_Value_Read;
    }
//　データファイルから固定データ読み込み
//
//
    private function fixed_value_read($Handle){
        $Read_Value = $this->file_read($Handle);
        $W_Blank_Count = substr_count( $Read_Value, ' ' );
        if($W_Blank_Count ==2){
            $w = explode(" ",$W_Blank_Count);
        }
        $Fixed_Value_Read['N'] = (int)$W[0];
        $Fixed_Value_Read['M'] = (int)$W[1];
        $Fixed_Value_Read['T'] = (int)$W[2];
        return $Fixed_Value_Read;
    }
//　B035初期処理
//
//
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
        $Handle = $B035_Init;
        $Fixed_Value_Read = $this->fixed_value_read($Handle);
        $Last_Month_Value_Read  = $this->last_month_value_read($Fixed_Value_Read);
        $Jogging_Data_For_This_months = $this->This_Month_Value_Read($Handle);
        $Cumulative_jogging_distances =   $this->Member_name_check( $Jogging_Data_For_This_months,
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
