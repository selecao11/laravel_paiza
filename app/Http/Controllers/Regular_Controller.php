<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Validator; // Validatorだけでも実行できる
use Exception;

class Regular_Controller extends Controller
{
    public function output_regular(Request $request){
        //C042データを全て読み込み
        #$file_name = "C:\\laravel_paiza\\app\\Http\\Controllers\\C042.txt";
        //データファイルから成績データを抽出する。
        $text = "goegle";
        $result = preg_match('/go+?gle/', $text);
        dd($result); // int(1)

        return view('regular',compact('result'));
    }

    public function index_regular(Request $request){
        return view('regular');
    }
}
