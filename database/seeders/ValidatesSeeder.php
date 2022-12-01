<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Validates;

class ValidatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Validates::create([
                'name' => 'name!!!!',#←初期化内容
                'sex' => 'sex!!!!',#←初期化内容
            ]);
    }
}
