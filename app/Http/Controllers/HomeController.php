<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Debugbar;

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

    private function verify() {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('home');
    }

    public function update(Request $request) {
        Debugbar::info($request->request->get("stock"));
        Debugbar::info($request->all());
        $data = $request->all();
        error_log('Some message here.');
        $u_id = Auth::user();

        Debugbar::info($request);
    }

    private function buy(Request $request) {
        $u_id = Auth::id();

    }
}
