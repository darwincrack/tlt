<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Entrust;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Entrust::hasRole(['admin']))
        {
            return view('articulos.index');
        }

        if(Entrust::hasRole(['informatica']))
        {
            return view('solicitudesarticulos.index');
        }

        if(Entrust::hasRole(['inventario']))
        {
            return view('articulos.index');
        }

    }
}
