<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TypecoaRequest;
use App\TypeCoa;

class TypecoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type_coas = TypeCoa::orderBy('name')->paginate(10);
        return view('pages.type_coa.type_coa_manage', compact('type_coas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.type_coa.type_coa_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypecoaRequest $request)
    {
        $newType_Coa = $request->only(['name', 'value']);
        try {
            TypeCoa::create($newType_Coa);
        } catch (\PDOException $e) {
            return redirect()->back()->with('errorMsg', $this->getMessage($e));
        }
        return redirect()->route('type-coa.index')->with('successMsg', 'Type Coa created successfully!');
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
        $type_coa = TypeCoa::find($id);
        if (is_null($type_coa)) {
            return redirect()->route('type-coa.index')->with('errorMsg', 'Type COA Not Found !');
        }
        return view('pages.type_coa.type_coa_edit', compact('type_coa'));
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
        $type_coa = TypeCoa::find($id);
        if (is_null($type_coa)) {
            return redirect()->route('type-coa.index')->with('errorMsg', 'Type COA Not Found !');
        }
        $updateType_Coa = $request->only(['name', 'value']);
        try {
            $type_coa->update($updateType_Coa);
        } catch (\PDOException $e) {
            return redirect()->back()->with('errorMsg', $this->getMessage($e));
        }
        return redirect()->route('type-coa.index')->with('successMsg', 'Type Coa updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            TypeCoa::destroy($id);
        } catch (\PDOException $e) {
            return redirect()->back()->with('errorMsg', $this->getMessage($e));
        }
        return redirect()->back()->with('successMsg', 'Type COA Deleted');
    }
}
