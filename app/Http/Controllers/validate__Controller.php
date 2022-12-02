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
        $id =4;
        Validates::where('name', '=', 'p')->delete();
/*         $val = Validates::find($id);
        if ($val!=Null){ 			#データがある場合
            $h = Validates::find($id)->delete();
        }else{
            dd("エラー：");
 */


/*         try{
            Validates::find(5)->delete();
          }catch(Exception $e){
            dd("エラー：");
          }
 */#        dd($val);

/*     $val = Validates::find(1);
    $val->name = 'name_更新';
    $val->sex = 'sex_更新';
    $val->save();
 */
#        dd($val);
        return view('validate');
    }
}
