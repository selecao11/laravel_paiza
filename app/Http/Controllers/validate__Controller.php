<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator; // Validatorだけでも実行できる
use App\Models\Validates;

class validate__Controller extends Controller
{


    public function output(Request $request){
        $title = $request->input('title');
        $body = $request->input('body');

        $validate__Controller = 1;


        $request->validate([
            'title' => 'numeric|between:1,10',
            'body' => 'required',
        ],
         [
                'title.numeric' => '数字ではない',      #validation.phpのnumericの内容を更新する
                'title.between' => '数がおおきい',      #validation.phpのnumericの内容を更新する
                'body.required'  => 'bodyは必須項目です。',#validation.phpのrequiredの内容を更新する
         ]);
/*          if ($validator->fails()) {
             return redirect('/validate')
            ->withErrors($validator)
            ->withInput();
         }
 */
         return view('validate',);
    }
    public function index(){
        return view('validate');
    }
}
