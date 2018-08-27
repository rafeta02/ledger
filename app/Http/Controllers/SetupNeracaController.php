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
        $types = TypeCoa::orderBy('name')->get();
        $typeDebets = TypeCoa::where('value', 'Debet')->orderBy('name')->get();
        $typeKredits = TypeCoa::where('value', 'Kredit')->orderBy('name')->get();

        $dapats =  Setup::with('setup_details')->where('name', 'Labarugi')->where('list', 'Pendapatan_Usaha')->first();
        $keluars = Setup::with('setup_details')->where('name', 'Labarugi')->where('list', 'Beban_Usaha')->first();
        $lains = Setup::with('setup_details')->where('name', 'Labarugi')->where('list', 'Pendapatan_Beban_Lainnya')->first();
        $pajak = Setup::with('setup_details')->where('name', 'Labarugi')->where('list', 'Beban_Pajak')->first();

        return view('setup.neraca_edit', compact('typeDebets', 'typeKredits', 'types', 'dapats', 'keluars', 'lains', 'pajak'));
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
        $dapat = array_unique($request->typedapat);
        $keluar = array_unique($request->typekeluar);
        $lain = array_unique($request->typelain);
        $pajak = $request->typepajak; 

        $dapat_id =  Setup::where('name', 'Labarugi')->where('list', 'Pendapatan_Usaha')->first();
        $keluar_id = Setup::where('name', 'Labarugi')->where('list', 'Beban_Usaha')->first();
        $lain_id = Setup::where('name', 'Labarugi')->where('list', 'Pendapatan_Beban_Lainnya')->first();
        $pajak_id = Setup::where('name', 'Labarugi')->where('list', 'Beban_Pajak')->first();

        foreach ($dapat as $key => $value) {
            $newDetails[] = array('setup_id' => $dapat_id->id,
                                'typecoa_id' => $value);
        }
        
        foreach ($keluar as $key => $value) {
            $newDetails[] = array('setup_id' => $keluar_id->id,
                                'typecoa_id' => $value);
        }

        foreach ($lain as $key => $value) {
            $newDetails[] = array('setup_id' => $lain_id->id,
                                'typecoa_id' => $value);
        }

        $newDetails[] = array('setup_id' => $pajak_id->id, 'typecoa_id' => $pajak);

        try {
            SetupDetail::insert($newDetails);
        } catch (\PDOException $e) {
            return redirect()->back()->with('errorMsg', $this->getMessage($e));
        }

        return redirect()->route('neraca.index')->with('successMsg', "Neraca Saved");
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
