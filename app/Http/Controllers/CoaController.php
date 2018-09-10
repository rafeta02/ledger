<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CoaRequest;
use App\Coa;
use App\TypeCoa;
use App\MappingCoa;
use Carbon\Carbon;
use Auth;
use Session;
use Excel;
use File;


class CoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coas = Coa::orderBy('code')->with('children', 'parent')->paginate(15);
        return view('pages.coa.coa_manage', compact('coas'));
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type_coas = TypeCoa::orderBy('name')->get();
        $coas = Coa::orderBy('code')->get();
        return view('pages.coa.coa_create', compact('type_coas', 'coas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CoaRequest $request)
    {
        $newCoa = $request->only(['code', 'name', 'type_id', 'group']);
        if($request->parent != 'null'){
            $newCoa['parent_id'] = $request->parent;
        }

        try {
            $coa = Coa::create($newCoa);
        } catch (\PDOException $e) {
            return redirect()->back()->with('errorMsg', $this->getMessage($e));
        }

        return redirect()->route('coa.index')->with('successMsg', 'COA created successfully!');
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
        $coa = Coa::find($id);
        if (is_null($coa)) {
            return redirect()->route('coa.index')->with('errorMsg', 'COA Is Not Found !');
        }
        $coas = Coa::where('id', '!=', $id)->get();
        $type_coas = TypeCoa::all();
        return view('pages.coa.coa_edit', compact('coa', 'coas', 'type_coas'));
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
        $coa = Coa::find($id);
        if (is_null($coa)) {
            return redirect()->route('coa.index')->with('errorMsg', 'COA Is Not Found !');
        }
        $updateCoa = $request->only(['code', 'name', 'type_id', 'group']);
        if($request->parent != 'null'){
            $updateCoa['parent_id'] = $request->parent;
        }else{
            $updateCoa['parent_id'] = null;
        }

        try {
            $coa->update($updateCoa);
        } catch (\PDOException $e) {
            return redirect()->back()->with('errorMsg', $this->getMessage($e));
        }
        
        return redirect()->route('coa.index')->with('successMsg', 'COA updated successfully!');
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
            Coa::destroy($id);
        } catch (\PDOException $e) {
            return redirect()->back()->with('errorMsg', $this->getMessage($e));
        }
        return redirect()->back()->with('successMsg', 'COA Deleted');
    }

    public function exportExample(){
        $sheet1 = array('code', 'name', 'group', 'type_coa_id', 'coa_parent_code');

        $type_coas = TypeCoa::orderBy('id')->get();
        foreach ($type_coas as $key => $value) {
            $sheet2[$key] = array(
                    'ID' => $value->id,
                    'Name' => $value->name,
                    'Value' => $value->value,
                );
        }
        return Excel::create('Coa_Import_Example', function($excel) use ($sheet1, $sheet2){
            $excel->sheet('CoaSheet', function($sheet) use ($sheet1)
            {
                $sheet->fromArray($sheet1);
                $sheet->setWidth(array(
                    'A' => 15,
                    'B' => 15,
                    'C' => 15,
                    'D' => 15,
                    'E' => 20,  
                ));
            });
            $excel->sheet('TypeCoaSheet', function($sheet) use ($sheet2)
            {
                $sheet->fromArray($sheet2);
                $sheet->setWidth(array(
                    'A' => 5,
                    'B' => 40,
                    'C' => 20, 
                ));
            });
        })->download('xlsx');
    }

    public function export(){
        $coas = Coa::orderBy('code')->with('children', 'parent', 'type')->get();
        //dd($coas);
        foreach ($coas as $key => $coa) {
            if($coa->parent != null){
                $data[$key]['No Induk COA'] = "";
            }else{
                $data[$key]['No Induk COA'] = $coa->code;
            }
                $data[$key]['No COA'] = $coa->code;
                $data[$key]['Nama Akun'] = $coa->name;
                $data[$key]['Tipe Akun'] = $coa->type->name;
        }

        return Excel::create('Coa_Export', function($excel) use ($data){
            $excel->sheet('CoaSheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
                $sheet->setWidth(array(
                    'A' => 15,
                    'B' => 20,
                    'C' => 50,
                    'D' => 40, 
                ));
            });
        })->download('xlsx');
    }

    public function import()
    {
        return view('pages.coa.coa_import');
    }

    public function importPost(Request $request)
    {
        if($request->hasFile('file')){
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
                $path = $request->file->getRealPath();
                $data = Excel::selectSheets('CoaSheet')->load($path, function($reader) {
                })->get();

                if(!empty($data) && $data->count()){

                    foreach ($data as $key => $value) {
                        if(is_null($value->coa_parent_code)){
                            $coa_id = null;
                        }else{
                            $parent_code = strval($value->coa_parent_code);
                            $coa = Coa::where('code', $parent_code)->first();
                            if(is_null($coa)){
                                $coa_id = null;
                            }else{
                                $coa_id = $coa->id;
                            }
                        }

                        $code = strval($value->code);
                        $type_id = strval($value->type_coa_id);

                        $insert[] = [
                        'code' => $code,
                        'name' => $value->name,
                        'group' => $value->group,
                        'type_id' => $type_id,
                        'parent_id' => $coa_id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        ];
                            
                    }

                    if(!empty($insert)){
                        $insertData = Coa::insert($insert);
                        if ($insertData) {
                            return redirect()->route('coa.index')->with('successMsg', 'Your Data has successfully imported');
                        }else {                        
                            return redirect()->back()->with('errorMsg', 'ERROR');
                        }
                    }
                }
                return redirect()->back()->with('warningMsg', 'Empty Data.');
 
            }else {
                return redirect()->back()->with('errorMsg', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
            }
        }
    }
}
