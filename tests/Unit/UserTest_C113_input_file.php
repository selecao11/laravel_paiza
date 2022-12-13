<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\C113_Controller;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.  テスト2
     *
     * @return void
     */
    public function test_C113_input_file()
    /* 
    #C113_result.xmlファイル作成
    type nul > ./C113_result.xml

    #UT実行
    php artisan test --log-junit ./C113_result.xml --filter test_C113_input_file tests/Unit/UserTest.php
    */    {
        $file_name = "C:\\laravel_paiza\\app\\Http\\Controllers\\C113.txt";
        $C113 = new C113_Controller();
        $c113_datas = $C113->input_file($file_name);
        print_r($c113_datas['data']);
        $this->assertTrue($c113_datas['is_success'], true);
        $c113_datas;
    }


}