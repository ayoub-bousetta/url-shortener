<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    public function index()
    {
       // return view('home');
    }

 public function redirecturl(Request $request)
    {
        $code =$request->code;
        $link=Link::where('gen_code',$request->code)->get();

        dd($link);

        return view('redirecturl');
    }
    
}
