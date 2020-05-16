<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\Debugbar\Facade as Debugbar;

class SinglePageController extends Controller
{
    public function index()
    {
        Debugbar::info('In SinglePageController@index');
        return view("home");
    }
}
