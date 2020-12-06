<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
public $a;
    public function index(){
        $a=["ffaffffffffffffff\n",'123456'];
        //return view('home.home')->with('a',$a);

        return view('home.home',function(){
            return redirect('abc','/Pg_view/index.html');
        });
    }
}
