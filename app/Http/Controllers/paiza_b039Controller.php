<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\paiza_b039;

class paiza_b039Controller extends Controller
{
    //

    public function b039_test(){
        return true;
    }

    public function index(){
#        $b039 = new paiza_b039();
        $grapes = paiza_b039::where('x', '=', '6')->get()->toArray();
        dd($grapes);

        /*
        paiza_b039::where('x', '=', 5)->update([
            'y' => 41,
            'a' => 42,
            'b' => 43,
        ]);
         $b039->create([
            'x' => 6,
            'y' => 21,
            'a' => 22,
            'b' => 23,
        ]);
 */        return view('b039');
    }
/*         $r_input = $this->input();
        $last_month_data = $r_input['last_month_data'];
        $last_Month_total = $this->Last_month_s_TOP10($last_month_data);//先月の各自の合計のソート
        $this_month_data = $r_input["this_month_data"];
        $the_Month_total = $this->Your_Total_for_the_Month($this_month_data);//各自の合計の算出とソート
        $comp_Top10 = $this->comp_Top10($last_Month_total,$the_Month_total);
 */

}

