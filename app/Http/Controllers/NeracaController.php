<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coa;
use App\TypeCoa;
use App\Setup;
use App\SetupDetail;
use Carbon\Carbon;
use App\Ledger;
use Auth;
use Session;


class NeracaController extends Controller
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

        $aktivas =  Setup::with('setup_details')->where('name', 'Neraca')->where('list', 'Aktiva')->first();
        $kewajibans = Setup::with('setup_details')->where('name', 'Neraca')->where('list', 'Kewajiban_Ekuitas')->first();

        //dd($aktivas);
        foreach ($aktivas->setup_details as $key => $value) {
            $type_aktiva[] = $value->typecoa_id;
        }
        foreach ($kewajibans->setup_details as $key => $value) {
            $type_kewajiban[] = $value->typecoa_id;
        }

        $coas_aktiva = TypeCoa::with('coas')->whereIn('id', $type_aktiva)->get();
        $coas_kewajiban = TypeCoa::with('coas')->whereIn('id', $type_kewajiban)->get();

    
        // foreach($coas_aktiva->coas as $value){
        //     dd($coas_aktiva->coas->id);
        //     $coaa = Coa::whereHas('ledgers', function ($q) use ($periodNow) {
        //             $q->where('period', $periodNow);
        //         })->where('id', $value->id)->get();
        // }
        // dd($coaa);


        //$aktivaLedgers = Ledger::where('period', $periodNow)->whereIn('coa_id', $aktivaCoaId)->get();

        $aktivaCoaId = Coa::whereIn('type_id', $type_aktiva)->where('parent_id', null)->pluck('id');
        $kewajibanCoaId = Coa::whereIn('type_id', $type_kewajiban)->where('parent_id', null)->pluck('id');

        //dd($aktivaCoaId);
        $aktivaLedgers = Ledger::where('period', $periodNow)->whereIn('coa_id', $aktivaCoaId)->get()->sortBy(function($ledger, $key) {
          return $ledger->coa->code;
        });

        $kewajibanLedgers = Ledger::where('period', $periodNow)->whereIn('coa_id', $kewajibanCoaId)->get()->sortBy(function($ledger, $key) {
          return $ledger->coa->code;
        });

        //dd($aktivaLedgers);
        return view('pages.neraca.neraca_index', compact('aktivaLedgers', 'kewajibanLedgers', 'periodText', 'coas_aktiva', 'coas_kewajiban'));
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
