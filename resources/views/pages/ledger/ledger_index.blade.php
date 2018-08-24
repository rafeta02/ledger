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
<link href="{{ url('/') }}/admin-assets/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-table/js/bootstrap-table.min.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/pages/jquery.bs-table.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/custombox/js/custombox.min.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/custombox/js/legacy.min.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/parsleyjs/parsley.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/moment/moment.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
@endsection

@section('custom-scripts')
<script type="text/javascript">
$(".select2").select2();

$(document).ready(function() {
  $('form').parsley();  

   $('#period').datepicker({
    format: 'yyyy-mm',
    minViewMode: 1,
    autoclose: true,
    todayHighlight: true,
  });
});
</script>
@endsection

@section('content')
<section LEDGER INDEX>
  <br>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-inverse panel-color">
        <div class="panel-heading">
          <h3 class="panel-title">Filter Ledger</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal group-border-dashed" action="{{route('ledger.view')}}" method="get">
              <div class="form-group">
                <label class="col-sm-3 control-label">Chart Of Account</label>
                <div class="col-sm-6">
                  <select class="form-control select2" name="coa" data-placeholder="Choose COA..." required>
                    <option></option>
                     @foreach($coas as $value)
                      <option value="{{$value->id}}">{{$value->code}} - {{$value->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Period</label>
                <div class="col-sm-6">
                  <input type="text" autocomplete="off" name="period" id="period" class="form-control" required placeholder="Choose Period..." />
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9 m-t-15">
                  <button type="submit" class="btn btn-primary">
                    Search
                  </button>
                </div>
              </div>
          </form>
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
            <th data-field="period" data-sortable="true" class="text-center" rowspan="2">Period</th>
            <th data-field="coa" data-sortable="true" class="text-center" rowspan="2">Chart Of Account</th>
            <th data-field="opening" class="text-center" colspan="2">Opening Balance</th>
            <th data-field="debet" class="text-center" rowspan="2">Total Debet</th>
            <th data-field="kredit" class="text-center" rowspan="2">Total Kredit</th>
            <th class="text-center" colspan="2">Closing Balance</th>
          </tr>
          <tr>
            <th data-field="openingdebet" class="text-center">Debet</th>
            <th data-field="openingkredit" class="text-center">Kredit</th>
            <th data-field="closingdebet" class="text-center">Debet</th>
            <th data-field="closingkredit" class="text-center">Kredit</th>
          </tr>
        </thead>
        <tbody>
          @foreach($ledgers as $ledger)
          <tr>
            <td>{{$ledger->period}}</td>
            <td class="text-left">{{$ledger->coa->code}} - {{$ledger->coa->name}}</td>
            @if($ledger->opening_balance >= 0)
              <td class="text-right">{{number_format($ledger->opening_balance,0,",", ".")}}</td>
              <td></td>
            @else
              <td></td>
              <td class="text-right">{{number_format(abs($ledger->opening_balance),0,",", ".")}}</td>
            @endif
            <td class="text-right">{{number_format($ledger->debet_total,0,",", ".")}}</td>
            <td class="text-right">{{number_format($ledger->kredit_total,0,",", ".")}}</td>
            @if($ledger->closing_balance >= 0)
              <td class="text-right">{{number_format($ledger->closing_balance,0,",", ".")}}</td>
              <td></td>
            @else
              <td></td>
              <td class="text-right">{{number_format(abs($ledger->closing_balance),0,",", ".")}}</td>
            @endif
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="text-center"> 
        {{ $ledgers->links() }}
      </div>
    </div>
  </div>
  </div>
</section LEDGER INDEX>
@endsection
