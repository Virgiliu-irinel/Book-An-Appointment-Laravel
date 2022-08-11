<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    // function getData(Request $req){
    //     $req->validate([
    //         'username'=>'required',
    //         'userpassword'=>'required'
    //     ]);
    //         return $req->input();
    // }
    function index(Request $req)
    {
        $req->validate([
            'nume'=>'required',
            'date'=>'required',
            'time'=>'required'
        ]);
        $name = $req->input('nume');
        $data = $req->input('date');
        $time = $req->input('time');

        $last_date = DB::select('select data from clienti order by id desc limit 1');
        $last_time = DB::select('select ora from clienti order by id desc limit 1');
        
        if(!(DB::table('clienti')->exists())){
            $values = array('nume'=>$name, 'data'=>$data, 'ora'=>$time);
            DB::table('clienti')->insert($values);
            echo "Programarea a fost inregistrata cu succes.<br/>";
            echo '<a href = "/">Apasati</a> pentru a reveni la formular.';
        }
        else{
            foreach($last_date as $i){
                $ld = $i->data;
            }
            foreach($last_time as $i){
                $lt = $i->ora;
            }

            $int_time = "";
            $x = explode(":", $time);
            $int_time = (int) (($x[0] * 60 * 60) + $x[1] * 60);

            $int_last_time = "";
            $z = explode(":", $lt);
            $int_last_time = (int) (($z[0] * 60 * 60) + $z[1] * 60);

            if($ld == $data && !((int) $int_time >= (int) $int_last_time + 5400 || (int) $int_time <= (int) $int_last_time - 5400)){
                echo "ora aleasa nu este disponibila <br>";
                echo "incercati cel putin mai tarziu de " . floor(($int_last_time + 5400) / 3600) . ":" . ((($int_last_time + 5400) / 60) % 60) .
                    " sau mai devreme de " . floor(($int_last_time - 5400) / 3600) . ":" . ((($int_last_time - 5400) / 60) % 60) . "<br>";
                echo '<a href = "/">Apasati</a> pentru a reveni la formular.';
            }
            else{
                $values = array('nume'=>$name, 'data'=>$data, 'ora'=>$time);
                DB::table('clienti')->insert($values);
                echo "Programarea a fost inregistrata cu succes.<br/>";
                echo '<a href = "/">Apasati</a> pentru a reveni la formular.';
            }
        }
    }

    function get_appointments(){
        $appointments = DB::select('select * from clienti');
        return view('appointment', ['appointments'=>$appointments]);
    }

}
