@extends('layouts.master')

@section('tab-title')
<title>Accounting - General Ledger</title>
@endsection


@section('page-title')
<h3 class="page-title">General Ledger</h3>
@endsection

@section('head')
<link href="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-table/css/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('/') }}/admin-assets/assets/plugins/custombox/css/custombox.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-table/js/bootstrap-table.min.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/pages/jquery.bs-table.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/custombox/js/custombox.min.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/custombox/js/legacy.min.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/parsleyjs/parsley.min.js" type="text/javascript"></script>
@endsection

@section('custom-scripts')
<script type="text/javascript">
$(document).ready(function() {
  $('form').parsley();  
});
</script>
@endsection

@section('content')
<section LEDGER>
  <br>
  <div class="row">
  	<div class="col-sm-12">
  		<div class="card-box">
        <div class="row">
          <div class="col-sm-2"><h4>Account Code</h4></div>
          <div class="col-sm-1"><h4>:</h4></div>
          <div class="col-sm-5"><h4>{{$coa->code}}</h4></div>
        </div>
        <div class="row">
          <div class="col-sm-2"><h4>Account Name</h4></div>
          <div class="col-sm-1"><h4>:</h4></div>
          <div class="col-sm-5"><h4>{{$coa->name}}</h4></div>
        </div>
        <div class="row">
          <div class="col-sm-2"><h4>Period</h4></div>
          <div class="col-sm-1"><h4>:</h4></div>
          <div class="col-sm-5"><h4>{{$periodText}}</h4></div>
        </div>
        <div class="row">
          <div class="col-sm-2"><h4>Opening Balance</h4></div>
          <div class="col-sm-1"><h4>:</h4></div>
          <div class="col-sm-5"><h4>{{number_format(abs($opening),0,",", ".")}}</h4></div>
        </div>
      </div>
  	</div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box">
        <table data-toggle="table" class="table-bordered">
          <thead>
            <tr>
              <th data-field="date" data-sortable="true" class="text-center" rowspan="2">Date</th>
              <th data-field="description" class="text-center" rowspan="2">Description</th>
              <th data-field="referensi" class="text-center" rowspan="2">Refference</th>
              <th data-field="debet" class="text-center" rowspan="2">Debet</th>
              <th data-field="kredit" class="text-center" rowspan="2">Kredit</th>
              <th class="text-center" colspan="2">Saldo</th>
            </tr>
            <tr>
              <th data-field="saldodebet" class="text-center">Debet</th>
              <th data-field="saldokredit" class="text-center">Kredit</th>
            </tr>
          </thead>
          <tbody>
            @php
              $saldo = $opening;
              $totdebet = 0;
              $totkredit = 0;
            @endphp
            @foreach($details as $detail)
              @php
                  $saldo += $detail->saldo;
                  $totdebet += $detail->debet;
                  $totkredit += $detail->kredit;
              @endphp

              <tr>
                <td>{{$detail->journal->date}}</td>
                <td class="text-left">{{$detail->journal->description}}</td>
                <td class="text-left">{{$detail->coaName}}</td>
                <td class="text-right">{{number_format($detail->debet,0,",", ".")}}</td>
                <td class="text-right">{{number_format($detail->kredit,0,",", ".")}}</td>
                @if($saldo >= 0)
                  <td class="text-right">{{number_format($saldo,0,",", ".")}}</td>
                  <td></td>
                @else
                  <td></td>
                  <td class="text-right">{{number_format(abs($saldo),0,",", ".")}}</td>
                @endif
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <th colspan="3" class="text-center">Total</th>
            <th class="text-right">{{number_format($totdebet,0,",", ".")}}</th>
            <th class="text-right">{{number_format($totkredit,0,",", ".")}}</th>
            <th colspan="2"></th>
          </tfoot>
        </table>
        <br>
        <br>
        <div class="row">
          <form action="{{route('ledger.store')}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="period" value="{{$periodFilter}}">
            <input type="hidden" name="coa_id" value="{{$coa->id}}">
            <input type="hidden" name="opening_balance" value="{{$opening}}">
            <input type="hidden" name="debet_total" value="{{$totdebet}}">
            <input type="hidden" name="kredit_total" value="{{$totkredit}}">
            <input type="hidden" name="closing_balance" value="{{$saldo}}">
            <div class="col-sm-12 text-right">
              <a href="{{ route('ledger.export', ['coa' => $coa->id, 'period' => $periodFilter]) }}" class="btn btn-lg btn-success">Export Ledger</a>
              <button type="submit" class="btn btn-lg btn-primary">
                Save Ledger
              </button>
              <a href="{{ route('ledger.index') }}" class="btn btn-lg btn-danger">Back</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section LEDGER>
@endsection
