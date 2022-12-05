<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator; // Validatorだけでも実行できる
use App\Models\Validates;

class validate__Controller extends Controller
{


    public function output(Request $request){
        $count = $request->input('count');
        $len = $request->input('len');

        $validate__Controller = 'reset'; 

        $request->validate([ 
            'count' => 'numeric|between:1,10',
            'len' => 'numeric|between:1,10',
        ],
         [
                'count.numeric' => '数字ではない',      #validation.phpのnumericの内容を更新する
                'count.between' => '数がおおきい',      #validation.phpのnumericの内容を更新する
                'len.numeric' => '数字ではない',      #validation.phpのnumericの内容を更新する
                'len.between' => '数がおおきい',      #validation.phpのnumericの内容を更新する
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
