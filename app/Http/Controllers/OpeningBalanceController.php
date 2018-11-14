<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coa;
use App\TypeCoa;
use App\Setup;
use App\OpeningBalance;
use App\SetupDetail;
use Carbon\Carbon;
use App\Ledger;
use Auth;
use Session;

class OpeningBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodNow = Carbon::Now()->format('Y-m');
        $coas = Coa::get()->pluck('id');
        foreach ($coas as $value) {
            $opening = OpeningBalance::firstOrCreate([
                'coa_id' => $value
            ], [
                'period' => $periodNow,
                'opening_balance' => 0
            ]);   
        }
        //dd($coas);
        $balance = OpeningBalance::with('coa')->paginate(15);
        return view('pages.coa.coa_opening_balance', compact('balance'));
    }

    public function updateBalance(Request $request, $id) {
        OpeningBalance::find($id)->update([$request->name => $request->value]);
        return response()->json(['success'=>'done']);
    }

    public function initBalance(){

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
