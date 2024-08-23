<?php

namespace App\Http\Controllers\__Blade;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('website.Home.index');
    }
}
