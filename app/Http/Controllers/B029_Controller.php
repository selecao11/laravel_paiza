<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class B029_Controller extends Controller
{
    /**
    * k-近傍法に従いデータを抽出して平均を算出する。
    *
    * @param int    $Resurt_K_nearest_Neighbors         各地点情報配列
    * @param int    $Return_Fixed_Value_Read            固定情報配列
    * @return int   $Return_select_close_to_each_other  平均値算出データ
    * @todo         ｋの値に従い配列からデータを抽出して平均を算出する。
    */
    private function select_close_to_each_other($Resurt_K_nearest_Neighbors,$Return_Fixed_Value_Read){
        $k = $Return_Fixed_Value_Read['k'];
        $w=0;
        #        $priceTotal = array_sum(array_column($vegetables, 'price'));
        for ($i=0;$i<$k;$i++){
            $Rkn_value = $Resurt_K_nearest_Neighbors[$i];
            $w += $Rkn_value['p_i'];
        }
        
        $Return_select_close_to_each_other = $w/$k; 
        return $Return_select_close_to_each_other;
    }
    /**
    * 距離配列のSORT
    *
    * @param strng  $Resurt_K_nearest_Neighbors     各地点情報配列
    * @return int   $Resurt_K_nearest_Neighbors     SORT済の各地点別距離配列
    * @todo         ルートを使い各地点の距離の算出を算出する。
    */
    private function k_nearest_neighbor_sort($Resurt_K_nearest_Neighbors){
        foreach( $Resurt_K_nearest_Neighbors as $Rkn_Value) {
            $id_distance[] = $Rkn_Value['distance'];
        }
        array_multisort($id_distance, SORT_ASC, SORT_NUMERIC, $Resurt_K_nearest_Neighbors);
        return $Resurt_K_nearest_Neighbors;
    }
    /**
    * 各地点の距離の算出
    *
    * @param strng  $K_Nearest_Neighbors            固定値配列
    * @param strng  $Return_Fixed_Value_Read        各地点情報配列
    * @return int   $$Resurt_K_nearest_Neighbors  各地点別距離配列
    * @todo         ルートを使い各地点の距離の算出を算出する。
    */
    private function k_nearest_neighbor_method($K_Nearest_Neighbors,$Return_Fixed_Value_Read){
        $x = $Return_Fixed_Value_Read['x'];
        $y = $Return_Fixed_Value_Read['y'];
        foreach($K_Nearest_Neighbors as $Knn_i =>$Knn_value){
            $x_i = $Knn_value['x_i'];
            $y_i = $Knn_value['y_i'];
            $Rkn_value['p_i']=$Knn_value['p_i'];
            $Rkn_value['distance'] = sqrt(($x - $x_i)**2 + ($y - $y_i)**2);
            $Resurt_K_nearest_Neighbors[]=$Rkn_value;
        }
        return $Resurt_K_nearest_Neighbors;
    }
    /**
    * 改行削除
    *
    * @param strng  $Handle         ファイルハンドル
    * @return int   $Rmp_file_read  各固定値配列
    * @todo         データから改行などを削除する。
    */
    private function file_read($Handle){
        $Rmp_file_read= str_replace(array("\r\n", "\r", "\n"), "", fgets( $Handle ));
        return $Rmp_file_read;
    }
    /**
    * 各地点の値をファイルから取得
    *
    * @param strng  なし
    * @return int   $Return_Fixed_Value_Read Ａ地点の各値の取得配列
    * @todo         データファイルからx_i,y_i,p_iを取得する。

    */
    private function data_value_read($Handle,$N){
        for ($i=0;$i <$N;$i++){
            $Rmp_file_read = $this->file_read($Handle);
            $W_Blank_Count = substr_count( $Rmp_file_read, ' ' );
            if($W_Blank_Count ==2){
                $w = explode(" ",$Rmp_file_read);
            }
            $K_Nearest_Neighbor['x_i'] = (int)$w[0];
            $K_Nearest_Neighbor['y_i'] = (int)$w[1];
            $K_Nearest_Neighbor['p_i'] = (int)$w[2];
            $K_Nearest_Neighbors[]=$K_Nearest_Neighbor;
        }
        fclose($Handle);
        return $K_Nearest_Neighbors;
    }
    /**
    * Ａ地点の値をファイルから取得
    *
    * @param strng  なし
    * @return int   $Return_Fixed_Value_Read Ａ地点の各値の取得配列
    * @todo         データファイルからN,k,x,yを取得する。
    */
    private function fixed_value_read(){
        /**
        * fixed_value_read
        *
        * @var string   file_name
        *               データファイルパス
        * @var string   lines
        *               データ
        */
        $file_name = "/home/user/docker-laravel/laravel_paiza/app/Http/Controllers/b029.txt";
        $Handle = fopen ( $file_name, "r" );
        $Rmp_file_read = $this->file_read($Handle);
        if(substr_count( $Rmp_file_read, ' ' ) ==1){
            $w_x_y = explode(" ",$Rmp_file_read);
        }
        $x = (int)$w_x_y[0];
        $y = (int)$w_x_y[1];
        $Rmp_file_read = $this->file_read($Handle);
        if(substr_count( $Rmp_file_read, ' ' ) <= 0){
            $w_k = explode(" ",$Rmp_file_read);
        }
        $k = (int)$w_k[0];
        $Rmp_file_read = $this->file_read($Handle);
        if(substr_count( $Rmp_file_read, ' ' ) <= 0){
            $w_N = explode(" ",$Rmp_file_read);
        }
        $N = (int)$w_N[0];
        $Return_Fixed_Value_Read['x']=$x;
        $Return_Fixed_Value_Read['y']=$y;
        $Return_Fixed_Value_Read['k']=$k;
        $Return_Fixed_Value_Read['N']=$N;
        $Return_Fixed_Value_Read['Handle']=$Handle;
        return $Return_Fixed_Value_Read;
    } 

    /**
    * main処理
    *
    * @param strng  $headers        ヘッダデータ配列
    * @return int   $Victory_Tables 初期化済成績表配列
    * @todo         マッチ棒を１本移動して別のに加えて数字文字にする
    */
    public function index(){
        /**
        * index
        *
        * @var string   file_name
        *               データファイルパス
        * @var string   lines
        *               データ
        */
        $Return_Fixed_Value_Read = $this->fixed_value_read();
        $Handle = $Return_Fixed_Value_Read['Handle'];
        $N = $Return_Fixed_Value_Read['N'];
        $K_Nearest_Neighbors = $this->data_value_read($Handle,$N);
        $Resurt_K_nearest_Neighbors = $this->k_nearest_neighbor_method($K_Nearest_Neighbors,$Return_Fixed_Value_Read);
        $Resurt_K_nearest_Neighbors = $this->k_nearest_neighbor_sort($Resurt_K_nearest_Neighbors,$K_Nearest_Neighbors);
        $this->select_close_to_each_other($Resurt_K_nearest_Neighbors,$Return_Fixed_Value_Read);
        // $this_month_data = array_values($this_month_data);//今月の成績のindex降り直し
        // $r_input['last_month_data'] = $last_month_data;
        // $r_input['this_month_data'] = $this_month_data;
        $r_input = true;
        return view('b029');
        #        return view('b023',compact('comp_Top10','last_Month_total','this_month_data'));
    }
}
