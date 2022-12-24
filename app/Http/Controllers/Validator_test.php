<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Validator; // Validatorだけでも実行できる
use Exception;

class Validator_test extends Controller
{
    public function output_C042(Request $request){
        //C042データを全て読み込み
        #$file_name = "C:\\laravel_paiza\\app\\Http\\Controllers\\C042.txt";
        $validator = Validator::make($request->all(), [
            'title' => 'string|between:5,10',
        ],
        [
#           'title.numeric' => '数字ではない',      #validation.phpのnumericの内容を更新する
           'title.string' => 'これでいいわけない',      #validation.phpのnumericの内容を更新する
           'title.between' => '数がおおきい',      #validation.phpのnumericの内容を更新する
#           'body.required'  => 'bodyは必須項目です。',#validation.phpのrequiredの内容を更新する
        ]);
        if ($validator->fails()) {
            // エラー発生時の処理
            return redirect('/validate')
                    ->withErrors($validator)
                    ->withInput();
        }
        return view('validate');
    }

    public function index_validate(Request $request){
        return view('validate');
    }
}
