<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CurrencyRate;

class CurrencyController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CurrencyRate::all();
    }

    public function convert(Request $request)
    {
        $to = $request->get('to');
        $from = $request->get('from');
        $amount = (int) $request->get('amount');

        if($to && $from && $amount) {
            $rateto = CurrencyRate::where('code', $to)->first()->rate;
            $ratefrom = CurrencyRate::where('code', $from)->first()->rate;

            $amount = $amount*($ratefrom/$rateto);


            return ['amount' => $amount];
        }
        return ['amount' => ''];
    }

    public function create(Request $request)
    {
        $name = $request->get('name');
        $code = $request->get('code');
        $rate = $request->get('rate');

        $data = CurrencyRate::firstOrCreate(
            [
                'name' => $name,
                'code' => $code,
                'rate' => $rate
            ]
        );

        return [$data];


    }

    public function delete($id)
    {
        $currency = CurrencyRate::where('id', $id)->delete();
        return response([], 200);
    }

    public function reset(Request $request)
    {

    }
}
