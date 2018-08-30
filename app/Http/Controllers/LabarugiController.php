<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coa;
use App\TypeCoa;
use App\Setup;
use App\SetupDetail;
use Carbon\Carbon;
use App\Ledger;

class LabarugiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now();
        $periodNow = $now->format('Y-m');
        $like = $periodNow."-%";
        $periodText = $now->format('F Y');

        $dapats =  Setup::with('setup_details')->where('name', 'Labarugi')->where('list', 'Pendapatan_Usaha')->first();
        $keluars = Setup::with('setup_details')->where('name', 'Labarugi')->where('list', 'Beban_Usaha')->first();
        $lains = Setup::with('setup_details')->where('name', 'Labarugi')->where('list', 'Pendapatan_Beban_Lainnya')->first();
        $pajak = Setup::with('setup_details')->where('name', 'Labarugi')->where('list', 'Beban_Pajak')->first();

        foreach ($dapats->setup_details as $key => $value) {
            $type_dapat[] = $value->typecoa_id;
        }
        foreach ($keluars->setup_details as $key => $value) {
            $type_keluar[] = $value->typecoa_id;
        }
        foreach ($lains->setup_details as $key => $value) {
            $type_lain[] = $value->typecoa_id;
        }

        //dd($pajak->setup_details);
        $dapatCoaId = Coa::whereIn('type_id', $type_dapat)->where('parent_id', null)->pluck('id');
        $keluarCoaId = Coa::whereIn('type_id', $type_keluar)->where('parent_id', null)->pluck('id');
        $lainCoaId = Coa::whereIn('type_id', $type_lain)->where('parent_id', null)->pluck('id');
        $pajakCoaId = Coa::where('type_id', $pajak->setup_details[0]->typecoa_id)->where('parent_id', null)->pluck('id');

        //dd($pajakCoaId);
        $dapatLedgers = Ledger::where('period', $periodNow)->whereIn('coa_id', $dapatCoaId)->get();

        $keluarLedgers = Ledger::where('period', $periodNow)->whereIn('coa_id', $keluarCoaId)->get();

        $lainLedgers = Ledger::where('period', $periodNow)->whereIn('coa_id', $lainCoaId)->get();

        $pajakLedgers = Ledger::where('period', $periodNow)->whereIn('coa_id', $pajakCoaId)->get();

        //dd($dapatLedgers);
        return view('pages.labarugi.labarugi_index', compact('dapatLedgers', 'keluarLedgers', 'lainLedgers', 'pajakLedgers', 'periodText'));
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
