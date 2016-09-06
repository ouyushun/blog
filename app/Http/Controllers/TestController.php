<?php

namespace App\Http\Controllers;
use Request; 
//use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class TestController extends Controller
{
    public function index()
    {
        return view('test');
    }
    
    public function handle()
    {
        dd(Request::all());
    }
}
