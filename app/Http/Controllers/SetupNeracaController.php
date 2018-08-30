<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypeCoa;
use App\Setup;
use App\SetupDetail;

class SetupNeracaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeDebets = TypeCoa::where('value', 'Debet')->orderBy('name')->get();
        $typeKredits = TypeCoa::where('value', 'Kredit')->orderBy('name')->get();

        $debets =  Setup::with('setup_details')->where('name', 'Neraca')->where('list', 'Aktiva')->first();
        $kredits = Setup::with('setup_details')->where('name', 'Neraca')->where('list', 'Kewajiban_Ekuitas')->first();

        if(($debets->setup_details->isEmpty()) OR ($kredits->setup_details->isEmpty()))
        {
            return view('setup.neraca_create', compact('typeDebets', 'typeKredits'));
        }else{
             return view('setup.neraca_edit', compact('typeDebets', 'typeKredits', 'debets', 'kredits'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $debet = array_unique($request->typedebet);
        $kredit = array_unique($request->typekredit);

        $debet_id =  Setup::where('name', 'Neraca')->where('list', 'Aktiva')->first();
        $kredit_id = Setup::where('name', 'Neraca')->where('list', 'Kewajiban_Ekuitas')->first();

        $delete = array($debet_id->id, $kredit_id->id);
        SetupDetail::whereIn('setup_id', $delete)->delete();

        foreach ($debet as $key => $value) {
            $newDetails[] = array('setup_id' => $debet_id->id,
                                'typecoa_id' => $value);
        }
        
        foreach ($kredit as $key => $value) {
            $newDetails[] = array('setup_id' => $kredit_id->id,
                                'typecoa_id' => $value);
        }

        try {
            SetupDetail::insert($newDetails);
        } catch (\PDOException $e) {
            return redirect()->back()->with('errorMsg', $this->getMessage($e));
        }

        return redirect()->route('setup.neraca.index')->with('successMsg', "Neraca Saved");
    }
}
