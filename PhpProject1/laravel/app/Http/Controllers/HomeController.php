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
    /* public function __construct()
    {
        $this->middleware('auth');
    }
    */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $congress = \App\Congress::all();
        $array = [];
        $i = 0;
        foreach ($congress as $item){
            $array[$i] = $item;
            
            $i = $i + 1;
        }
       
        return view('home', compact('congress'));
    }
}
