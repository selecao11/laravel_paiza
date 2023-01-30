<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use B035;

class B035_Controller extends Controller
{
//　メイン処理
//
//
    public function index(){
        $B035 = new B035_Controller();
        $B035_Init = $B035->init_B035()();
        $handle = $B035_Init['handle'];
        $fixed_read_value = $B035->callFixedvalue($handle);
        $last_months_joggings  = $B035->callLastmonth($fixed_read_value);
        $this_month_value = $B035->callLastmonth($fixed_read_value);
        $this_months_joggings =  $B035->callThisMonthValue($handle);
        $cumulative_distances = $B035->callMemberName($last_months_joggings,$this_months_joggings);
        $Cumulative_jogging_distances   =   $B035->callDistance($this_months_joggings,$cumulative_distances);
        $cumulative_distances = $B035->callCumulativedistances($cumulative_distances);
        $This_Month_of_Jogging_Performance  = $B035->callGrades($cumulative_distances,$last_months_joggings);
        $create_gradebook = $B035->callGradebook($cumulative_distances,$fixed_value_read);
        return $create_gradebook;
        return view('b035',compact('Create_gradebook'));
    }
}
