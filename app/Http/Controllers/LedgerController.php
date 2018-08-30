<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coa;
use App\Journal;
use App\JournalDetail;
use App\Ledger;
use Carbon\Carbon;
use Excel;
use File;

class LedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coas = Coa::orderBy('code')->get();
        //$ledgers = Ledger::orderBy('period', 'desc')->paginate(15);
        return view('pages.ledger.ledger_index', compact('coas', 'ledgers'));
    }

    public function monthly(){
        $karbon = Carbon::now();
        $periodBefore = $karbon->subMonth(1)->format('Y-m');
        $now = Carbon::now();
        $periodNow = $now->format('Y-m');
        $like = $periodNow."-%";
        $periodText = $now->format('F Y');

        $coas = Coa::orderBy('code')->paginate(15);

        //dd($coas);
        foreach ($coas as $coa) {
            $coa = Coa::find($coa->id);
            //dd($coa);
            $coa_id[] = $coa->id;

            if($coa->children != null){
                foreach ($coa->children as $key => $value) {
                    $coa_id[] = $value->id;
                }
            }

            $ledger = Ledger::where('period', $periodBefore)->where('coa_id', $coa->id)->first();
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
            $current[$coa->id] = array($opening_balance, $debet, $kredit, $saldo);
            unset($coa_id);
        }
        //dd($current);
        $ledgers = Ledger::where('period', $periodNow)->pluck('closing_balance', 'coa_id');
        //dd($ledgers[1]);
        return view('pages.ledger.ledger_view_monthly', compact('periodText','periodNow', 'coas', 'current', 'ledgers'));
    }

    public function view(Request $request)
    {
        if($request->coa == null OR $request->period == null){
            return redirect()->back()->with('errorMsg', "ERROR");
        }

        $coaFilter = $request->coa;
        $periodFilter = $request->period;

        $like = $periodFilter."-%";

        $karbon = Carbon::createFromFormat('Y-m', $periodFilter);
        $periodBefore = $karbon->subMonth(1)->format('Y-m');
        $periodText = Carbon::createFromFormat('Y-m', $periodFilter)->format('M Y');

        $coa = Coa::find($coaFilter);
        $coa_id[] = $coa->id;

        $ledger = Ledger::where('period', $periodBefore)->where('coa_id', $coa->id)->first();
        if($ledger == null){
            return redirect()->route('ledger.index')->with('errorMsg', "Ledger Not Found");
        }

        if($coa->children != null){
            foreach ($coa->children as $key => $value) {
                $coa_id[] = $value->id;
            }
        }
        
        $details =  JournalDetail::whereHas('journal', function ($q) use ($like) {
                    $q->where('date', 'like', $like)->isPosted();
                })->whereIn('coa_id', $coa_id)->get();

        $opening = $ledger->closing_balance; 
        $debet = $details->sum('debet');
        $kredit = $details->sum('kredit');
        $a = $opening + ($debet - $kredit);
        //dd($a);        
        return view('pages.ledger.ledger_view', compact('details', 'coa', 'coas', 'ledger', 'periodText', 'periodFilter'));
    }

    public function export(Request $request)
    {
        //dd($request->all());
        if($request->coa == null OR $request->period == null){
            return redirect()->back()->with('errorMsg', "ERROR");
        }

        $coaFilter = $request->coa;
        $periodFilter = $request->period;

        $like = $periodFilter."-%";

        $coa = Coa::find($coaFilter);
        if($coa == null){
            return redirect()->back()->with('errorMsg', "ERROR");
        }
        $coa_id[] = $coa->id;
        if($coa->children != null){
            foreach ($coa->children as $key => $value) {
                $coa_id[] = $value->id;
            }
        }

        $details =  JournalDetail::whereHas('journal', function ($q) use ($like) {
                    $q->where('date', 'like', $like)->isPosted();
                })->whereIn('coa_id', $coa_id)->get();
        if(!isset($details)){
            return redirect()->back()->with('errorMsg', "ERROR");
        }
        
        $data = array();

        $saldo = 0; $totdebet = 0; $totkredit = 0;

        foreach($details as $key => $detail){
            $saldo += $detail->saldo;
            $totdebet += $detail->debet;
            $totkredit += $detail->kredit;

            if($saldo > 0){
                $saldodebet = $saldo;
                $saldokredit = null;
            }else{
                $saldodebet = null;
                $saldokredit = abs($saldo);
            }

            $data[$key] = array(
                    'Date' => $detail->journal->date,
                    'Description' => $detail->journal->description,
                    'Refference' => $detail->coaName,
                    'Debet' => $detail->debet,
                    'Kredit' => $detail->kredit,
                    'Saldo Debet' => $saldodebet,
                    'Saldo Kredit' => $saldokredit,
                );
        }

        array_push($data, array(
                    'Date' => '',
                    'Description' => '',
                    'Refference' => 'TOTAL',
                    'Debet' => $totdebet,
                    'Kredit' => $totkredit,
                    'Saldo Debet' => '',
                    'Saldo Kredit' => '',
                ));  

        return Excel::create('LEDGER-'.$periodFilter.'-'.$coa->code, function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download('xlsx');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.ledger.ledger_index');
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
        $ledger = Ledger::where('period', $request->period)->where('coa_id', $request->coa_id)->first();
        if($ledger != null){
            $ledger->debet_total = $request->debet_total;
            $ledger->kredit_total = $request->kredit_total;
            $ledger->closing_balance = $request->closing_balance;
            try {
                $ledger->save();
            } catch (\PDOException $e) {
                return redirect()->back()->with('errorMsg', $this->getMessage($e));
            }
        }else{
           $newLedger = $request->only(['period', 'coa_id', 'opening_balance', 'debet_total', 'kredit_total', 'closing_balance']);
            try {
                Ledger::create($newLedger);
            } catch (\PDOException $e) {
                return redirect()->back()->with('errorMsg', $this->getMessage($e));
            } 
        }

        return redirect()->back()->with('successMsg', "Ledger save successfully");
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
