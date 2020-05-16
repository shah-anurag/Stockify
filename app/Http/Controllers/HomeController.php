<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\Debugbar\Facade as Debugbar;

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
        Debugbar::info('In HomeController@index');
        return view('home');
    }

    public function update(Request $request) {
        // Debugbar::info($request->request->get("stock"));
        Debugbar::info($request->all());
        $data = $request->all();
        $user = \App\User::findOrFail($data['id']);
        Debugbar::info($user);
        Debugbar::info((float)$user->money);
        $moneyInAccount = (float)$user->money;
        $moneyRequired = (float)$data['price'] * (float)$data['quantity'];
        if($moneyInAccount >= $moneyRequired) {
            $moneyInAccount = $moneyInAccount - $moneyRequired;
            $user->money = (string)$moneyInAccount;
            $user->save();

            $stock = \App\stock::Create([
                'symbol' => $data['stockname'],
                'name' => $data['stockname'],
            ]);

            $stock_purchase = \App\stockPurchase::Create([
                'u_id' => $user->id,
                's_id' => $stock->id,
                'purchase_date' => date(),
                'quantity' => $data['quantity']
            ]);

            $stock_purchase_price = \App\stockPurchasePrice::Create([
                ''
            ]);
        }
    }

    private function buy(Request $request) {
        $u_id = Auth::id();

    }
}
