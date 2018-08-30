@extends('layouts.master')

@section('tab-title')
<title>Accounting - General Ledger</title>
@endsection


@section('page-title')
<h3 class="page-title">General Ledger Period {{$periodText}}</h3>
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
<section LEDGER MONTHLY>
  <br>
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th data-field="coa" data-sortable="true" class="text-center">Chart Of Account</th>
                <th data-field="opening" class="text-center">Opening Balance</th>
                <th data-field="debet" class="text-center">Total Debet</th>
                <th data-field="kredit" class="text-center">Total Kredit</th>
                <th class="text-center">Closing Balance</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($coas as $coa)
                @php
                $save = 0;
                @endphp

                <form action="{{route('ledger.store')}}" method="post">
                  {{csrf_field()}}
                  <tr>
                  <td class="text-left">{{$coa->code}} - {{$coa->name}}</td>
                  
                    <input type="hidden" name="period" value="{{$periodNow}}">
                    <input type="hidden" name="coa_id" value="{{$coa->id}}">

                    @if(isset($current[$coa->id]))
                      <input type="hidden" name="opening_balance" value="{{$current[$coa->id][0]}}">
                      <input type="hidden" name="debet_total" value="{{$current[$coa->id][2]}}">
                      <input type="hidden" name="kredit_total" value="{{$current[$coa->id][2]}}">
                      <input type="hidden" name="closing_balance" value="{{$current[$coa->id][3]}}">

                      @if($current[$coa->id][0] >= 0)
                        <td class="text-right">{{number_format($current[$coa->id][0],0,",", ".")}}</td>
                      @else
                        <td class="text-right">({{number_format(abs($current[$coa->id][0]),0,",", ".")}})</td>
                      @endif
                      <td class="text-right">{{number_format($current[$coa->id][1],0,",", ".")}}</td>
                      <td class="text-right">{{number_format($current[$coa->id][2],0,",", ".")}}</td>
                      @if($current[$coa->id][3] >= 0)
                        <td class="text-right">{{number_format($current[$coa->id][3],0,",", ".")}}</td>
                      @else
                        <td class="text-right">({{number_format(abs($current[$coa->id][3]),0,",", ".")}})</td>
                      @endif
                      @php
                      if(isset($ledgers[$coa->id])){
                        if($ledgers[$coa->id] == $current[$coa->id][3]){
                          $save = 1;
                        } 
                      }
                      @endphp
                    @else
                      <input type="hidden" name="opening_balance" value="0">
                      <input type="hidden" name="debet_total" value="0">
                      <input type="hidden" name="kredit_total" value="0">
                      <input type="hidden" name="closing_balance" value="0">
                      <td class="text-right">0</td>
                      <td class="text-right">0</td>
                      <td class="text-right">0</td>
                      <td class="text-right">0</td>
                      @php
                      if(isset($ledgers[$coa->id])){
                        if($ledgers[$coa->id] == 0){
                          $save = 1;
                        } 
                      }
                      @endphp
                    @endif
                    <td class="text-center"><button type="submit" class="btn btn-primary" {{$save == 1 ? 'disabled':''}} >Save</button></td>
                  </tr>
                </form>
              @endforeach
            </tbody>
          </table>
        </div>
      <div class="text-center"> 
        {{ $coas->links() }}
      </div>
    </div>
  </div>
  </div>
</section LEDGER MONTHLY>
@endsection
