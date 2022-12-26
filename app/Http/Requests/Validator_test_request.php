<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Validator_test_request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'string|between:5,10',
#            'body' => 'required',
          ];
    }

    public function messages()
    {
      return [
        'title.string' => 'これでいいわけない',      #validation.phpのnumericの内容を更新する
        'title.between' => '数がおおきい',      #validation.phpのnumericの内容を更新する
#        'body.required' => '本文は必須です',
      ];
    }
}
