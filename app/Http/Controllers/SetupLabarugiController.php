<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coa;
use App\TypeCoa;
use App\Setup;
use App\SetupDetail;
use Auth;
use Session;

class SetupLabarugiController extends Controller
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
        $coas = Coa::where('parent_id', null)->get();

        $dapats =  Setup::with('setup_details')->where('name', 'Labarugi')->where('list', 'Pendapatan_Usaha')->first();
        $keluars = Setup::with('setup_details')->where('name', 'Labarugi')->where('list', 'Beban_Usaha')->first();
        $lains = Setup::with('setup_details')->where('name', 'Labarugi')->where('list', 'Pendapatan_Beban_Lainnya')->first();
        $pajak = Setup::with('setup_details')->where('name', 'Labarugi')->where('list', 'Beban_Pajak')->first();
        $laba = Setup::with('setup_details')->where('name', 'Labarugi')->where('list', 'Laba_Berjalan')->first();
        
        if(($dapats->setup_details->isEmpty()) AND ($keluars->setup_details->isEmpty()) AND ($lains->setup_details->isEmpty()) AND ($pajak->setup_details->isEmpty()) AND ($laba->setup_details->isEmpty()))
        {
            return view('setup.labarugi_create', compact('typeDebets', 'typeKredits', 'types', 'coas'));
        }else{
             return view('setup.labarugi_edit', compact('typeDebets', 'typeKredits', 'types', 'coas', 'dapats', 'keluars', 'lains', 'pajak', 'laba'));
        }
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
        //dd($request->all());
        $dapat = array_unique($request->typedapat);
        $keluar = array_unique($request->typekeluar);
        $lain = array_unique($request->typelain);
        $pajak = $request->typepajak;
        $laba = $request->labacoa; 

        $dapat_id =  Setup::where('name', 'Labarugi')->where('list', 'Pendapatan_Usaha')->first();
        $keluar_id = Setup::where('name', 'Labarugi')->where('list', 'Beban_Usaha')->first();
        $lain_id = Setup::where('name', 'Labarugi')->where('list', 'Pendapatan_Beban_Lainnya')->first();
        $pajak_id = Setup::where('name', 'Labarugi')->where('list', 'Beban_Pajak')->first();
        $laba_id = Setup::where('name', 'Labarugi')->where('list', 'Laba_Berjalan')->first();

        $delete = array($dapat_id->id, $keluar_id->id, $lain_id->id, $pajak_id->id, $laba_id->id);
        SetupDetail::whereIn('setup_id', $delete)->delete();

        foreach ($dapat as $key => $value) {
            $newDetails[] = array('setup_id' => $dapat_id->id,
                                'typecoa_id' => $value,
                                'coa_id' => null);
        }
        
        foreach ($keluar as $key => $value) {
            $newDetails[] = array('setup_id' => $keluar_id->id,
                                'typecoa_id' => $value,
                                'coa_id' => null);
        }

        foreach ($lain as $key => $value) {
            $newDetails[] = array('setup_id' => $lain_id->id,
                                'typecoa_id' => $value,
                                'coa_id' => null);
        }

        $newDetails[] = array('setup_id' => $pajak_id->id, 'typecoa_id' => $pajak, 'coa_id' => null);
        $newDetails[] = array('setup_id' => $laba_id->id, 'typecoa_id' => null, 'coa_id' => $laba);

        try {
            SetupDetail::insert($newDetails);
        } catch (Exception $e) {
            return redirect()->back()->with('errorMsg', $exception->getMessage());
        }

        return redirect()->route('setup.labarugi.index')->with('successMsg', "Setup Labarugi Saved");
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
