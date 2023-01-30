<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\B035_Controller;

class UserTest_B035index extends TestCase
{

    public function test_B035index(){
        /*    #B035index_test_result.xmlファイル作成
        type nul > /home/user/docker-laravel/laravel_paiza/tests/Unit/B035/B035index_test_result.xml
        echo "" > /home/user/docker-laravel/laravel_paiza/tests/Unit//B035/B035index_test_result.xml
        #UT実行
        php artisan test    --log-junit /home/user/docker-laravel/laravel_paiza/tests/Unit/B035/B035index_test_result.xml  --filter test_B035index tests/Unit/B035/UserTest_B035.php
        */
            $B035 = new B035_Controller();
            $success_callB035 = $B035->index();
            print_r($success_callB035);
    }
}
