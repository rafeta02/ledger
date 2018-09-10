<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coa;
use App\Journal;
use App\JournalDetail;
use App\Ledger;
use Carbon\Carbon;
use Auth;
use Session;
use Excel;
use File;


class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coas = Coa::orderBy('code')->get();
        return view('pages.journal.journal_create', compact('coas'));
    }

    public function filter(){
        return view('pages.journal.journal_filter');
    }

    public function view(Request $request)
    {
        //dd($request->all());
        $periodFilter = $request->period;

        if($request->type != "All"){
            $typeFilter = array($request->type);
        }else{
            $typeFilter = array('Kas', 'Memo');
        }
        $like = $periodFilter."-%";

        $journals = Journal::where('date', 'like', $like)->whereIn('type', $typeFilter)->paginate(10);
        return view('pages.journal.journal_view', compact('journals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return redirect()->route('journal.index');
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
        
        //revisiable
        $type = "MEMO";
        foreach($request->namadebet as $data){
            $coa = Coa::find($data);
            if(stristr($coa->code , '1101')){
                $type = "KAS"; 
            }
        }
        foreach($request->namakredit as $data){
            $coa = Coa::find($data);
            if(stristr($coa->code , '1101')){
                $type = "KAS"; 
            }
        }
        ///revisiable

        $newJournal = $request->only(['date', 'description']);
        $newJournal['type'] = $type;

        //validasi server totaldebet == totalkredit
        if($request->totaldebet == $request->totalkredit){
            $newJournal['amount'] = $request->totaldebet;
        }else{
            return redirect()->back()->with('errorMsg', "ERROR !");
        }
        
        try {
            $journal = Journal::create($newJournal);
        } catch (\PDOException $e) {
            return redirect()->back()->with('errorMsg', $this->getMessage($e));
        }

        $newDetails = collect([]);
        foreach($request->namadebet as $key=>$value){
            $newDetails->push([
                'journal_id' => $journal->id,
                'coa_id' => $value, 
                'debet' => $request->debet[$key],
                'kredit' => null,
            ]); 
        }
        foreach($request->namakredit as $key=>$value){
            $newDetails->push([
                'journal_id' => $journal->id,
                'coa_id' => $value, 
                'debet' => null,
                'kredit' => $request->kredit[$key],
            ]);  
        }

        try {
            JournalDetail::insert($newDetails->toArray());
        } catch (\PDOException $e) {
            return redirect()->back()->with('errorMsg', $this->getMessage($e));
        }

        return redirect()->route('journal.posting')->with('successMsg', "Journal Saved");
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
        $journal = Journal::find($id);
        if (is_null($journal)) {
            return redirect()->route('journal.posting')->with('errorMsg', 'Journal Is Not Found !');
        }

        $coas = Coa::orderBy('code')->get();
        $count_debet = 0;
        $count_kredit = 0;

        foreach ($journal->journal_details as $key => $value) {
            if($value->debet != null){
                $count_debet++;
            }
            if($value->kredit != null){
                $count_kredit++;
            }
        }
        return view('pages.journal.journal_edit', compact('journal', 'coas', 'count_debet', 'count_kredit'));
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
        //dd($request->all());
        $journal = Journal::find($id);
        if (is_null($journal)) {
            return redirect()->route('journal.posting')->with('errorMsg', 'Journal Is Not Found !');
        }
        $updateJournal = $request->only(['date', 'description']);

        //validasi server totaldebet == totalkredit
        if($request->totaldebet == $request->totalkredit){
            $updateJournal['amount'] = $request->totaldebet;
        }else{
            return redirect()->back()->with('errorMsg', "ERROR !");
        }
        
        try {
            $journal->update($updateJournal);
        } catch (\PDOException $e) {
            return redirect()->back()->with('errorMsg', $this->getMessage($e));
        }

        $journals = JournalDetail::where('journal_id', $journal->id)->delete();

        $newDetails = collect([]);
        foreach($request->namadebet as $key=>$value){
            $newDetails->push([
                'journal_id' => $journal->id,
                'coa_id' => $value, 
                'debet' => $request->debet[$key],
                'kredit' => null,
            ]); 
        }
        foreach($request->namakredit as $key=>$value){
            $newDetails->push([
                'journal_id' => $journal->id,
                'coa_id' => $value, 
                'debet' => null,
                'kredit' => $request->kredit[$key],
            ]);  
        }
        
        try {
            JournalDetail::insert($newDetails->toArray());
        } catch (\PDOException $e) {
            return redirect()->back()->with('errorMsg', $this->getMessage($e));
        }

        return redirect()->route('journal.posting')->with('successMsg', 'Journal updated successfully!');
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
            Journal::destroy($id);
        } catch (\PDOException $e) {
            return redirect()->back()->with('errorMsg', $this->getMessage($e));
        }
        return redirect()->back()->with('successMsg', 'Journal Deleted');
    }

    public function posting()
    {   
        $journals = Journal::NotPosted()->paginate(10);
        return view('pages.journal.journal_posting', compact('journals'));
    }

    public function postingPost(Request $request)
    {
        //dd($request->all());
        if(!isset($request->posting)){
            return redirect()->back()->with('errorMsg', 'No journal choosen !');
        }
        foreach ($request->posting as $key => $value) {
            try {
                Journal::where('id', $value)->notPosted()->update(['is_posted' => 1]);
            } catch (\PDOException $e) {
                return redirect()->back()->with('errorMsg', $this->getMessage($e));
            }

            $jurnal = Journal::with('journal_details')->where('id', $value)->first();
            foreach ($jurnal->journal_details as $key => $value) {
                $coas[] = $value->coa_id;
            }
        }

        $periodBefore = Carbon::now()->subMonth(1)->format('Y-m');
        $periodNow = Carbon::now()->format('Y-m');
        $like = $periodNow."-%";

        foreach($coas as $val) {
            $coa = Coa::find($val);
            $coa_id[] = $val;

            if($coa->children != null){
                foreach ($coa->children as $key => $value) {
                    $coa_id[] = $value->id;
                }
            }

            $ledger = Ledger::where('period', $periodBefore)->where('coa_id', $val)->first();
            if($ledger == null){
                $opening_balance = 0;
            }else{
                $opening_balance = $ledger->closing_balance;
            }
                
            $details =  JournalDetail::whereHas('journal', function ($q) use ($like) {
                        $q->where('date', 'like', $like)->isPosted();
                    })->whereIn('coa_id', $coa_id)->get();

            $debet = $details->sum('debet');
            $kredit = $details->sum('kredit');
            $saldo = $opening_balance + ($details->sum('debet') - $details->sum('kredit'));
            //$current[$val] = array($opening_balance, $debet, $kredit, $saldo);

            $ledger = Ledger::where('period', $periodNow)->where('coa_id', $val)->first();
            if($ledger != null){
                $ledger->debet_total = $debet;
                $ledger->kredit_total = $kredit;
                $ledger->closing_balance = $saldo;
                try {
                    $ledger->save();
                } catch (\PDOException $e) {
                    return redirect()->back()->with('errorMsg', $this->getMessage($e));
                }
            }else{
                $newLedger = array('period' => $periodNow, 'coa_id' => $val, 'opening_balance' => $opening_balance, 'debet_total' => $debet, 'kredit_total' => $kredit, 'closing_balance' => $saldo);
                try {
                    Ledger::create($newLedger);
                } catch (\PDOException $e) {
                    return redirect()->back()->with('errorMsg', $this->getMessage($e));
                } 
            }
            unset($coa_id);
        }
        return redirect()->route('journal.posting')->with('successMsg', 'Journal posted successfully!');
    }

    public function import()
    {
        return view('pages.journal.journal_import');
    }

    public function importPost(request $request)
    {
        if($request->hasFile('file')){
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
 
                $path = $request->file->getRealPath();
                $data = Excel::load($path, function($reader) {
                })->get();
                if(!empty($data) && $data->count()){
                    $no = 0;
                    foreach ($data as $key => $value) {
                        if($no != $value->no){
                            $journal = new Journal();
                            $journal->date = $value->tanggal;
                            $journal->description = $value->keterangan;
                            $journal->amount = 0;
                            $journal->save();
                            $jourid[$value->no] = $journal->id;
                            $journal_id = $journal->id;
                        }

                        if(!isset($totaldebet[$value->no])){
                            $totaldebet[$value->no] = $value->debit;
                        }else{
                            $totaldebet[$value->no] += $value->debit;
                        }

                        if(!isset($totalkredit[$value->no])){
                            $totalkredit[$value->no] = $value->kredit;
                        }else{
                            $totalkredit[$value->no] += $value->kredit;
                        }

                        if(!isset($tipe[$value->no] )){ 
                            if(stripos($value->no_coa, "1101") !== false){
                                $tipe[$value->no] = "KAS";
                            }else{
                                $tipe[$value->no] = "MEMO";
                            }
                        }else{
                            if(stripos($value->no_coa, "1101") !== false){
                                $tipe[$value->no] = "KAS";
                            }
                        }


                        $coa = Coa::where('code', $value->no_coa)->orWhere('name', $value->nama_coa)->firstOrFail();
                        $details[] = [
                            'journal_id' => $journal_id,
                            'coa_id' => $coa->id,
                            'debet' => $value->debit,
                            'kredit' => $value->kredit,
                        ];
                        $no = $value->no;
                    }

                    foreach ($jourid as $key => $id) {
                        $jurnal = Journal::find($id);
                        if($totaldebet[$key] != $totalkredit[$key]){
                            $journal->forceDelete();
                            $error = true;
                        }else{
                            $jurnal->amount = $totaldebet[$key];
                            $jurnal->type = $tipe[$key];
                            $jurnal->save();
                        }   
                    }

                    if(isset($error)){
                        return redirect()->back()->with('errorMsg', 'ERROR What ?');
                    }

                    if(!empty($details)){
                        $insertData = JournalDetail::insert($details);
                        if ($insertData) {
                            return redirect()->route('journal.posting')->with('successMsg', 'Your Data has successfully imported');
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
