<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validates extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',		#更新対象の項目を設定する
        'sex'		#更新対象の項目を設定する
      ];
}
