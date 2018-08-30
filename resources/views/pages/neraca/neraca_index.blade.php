@extends('layouts.master')

@section('tab-title')
<title>Accounting - Neraca</title>
@endsection

@section('page-title')
<h3 class="page-title">Laporan Neraca {{$periodText}}</h3>
@endsection

@section('head')
<link href="{{ url('/') }}/admin-assets/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="{{ url('/') }}/admin-assets/assets/plugins/parsleyjs/parsley.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
<script src="{{ url('admin-assets/assets/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/moment/moment.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
@endsection

@section('custom-scripts')
<script type="text/javascript">

</script>
@endsection

@section('content')
<section LABARUGI>
  <br>
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box">
        <div class="row">
          @php
          $aktivaTotal = 0;
          $kewajibanTotal = 0;
          @endphp
          <div class="col-lg-12">
            <div class="form-group">
              <div class="col-sm-10 col-sm-offset-1">
                <div class="panel panel-success panel-border">
                  <div class="panel-heading">
                    <h3 class="panel-title">AKTIVA</h3>
                  </div>
                  <div class="panel-body col-sm-offset-1">
                  	{{-- <div class="panel panel-success panel-border">
		                  <div class="panel-heading">
		                    <h3 class="panel-title">AKTIVA</h3>
		                  </div>
		                  <div class="panel-body col-sm-offset-2">
		                  </div>
		                </div> --}}
                    <div>
                      <table class="table">
                        @foreach($aktivaLedgers as $key => $value)
                          @php
                          $aktivaTotal += $value->closing_balance;
                          @endphp
                          <tr>
                            <td><h5><b>{{$value->coa->code}} - {{$value->coa->name}}</b></h5></td>
                            <td class="text-right"><h5><b>{{number_format($value->closing_balance,0,",", ".")}}</b></h5></td>
                            <td width="20%"></td>
                          </tr>
                        @endforeach
                        <tr>
                          <td><h5><strong>TOTAL AKTIVA</strong></h5></td>
                          <td class="text-right" colspan="2"><h5><b>{{number_format($aktivaTotal,0,",", ".")}}</b></h5></td>
                        </tr>   
                      </table>
                    </div> 
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-10 col-sm-offset-1">
                <div class="panel panel-danger panel-border">
                  <div class="panel-heading">
                    <h3 class="panel-title">KEWAJIBAN DAN EKUITAS</h3>
                  </div>
                  <div class="panel-body col-sm-offset-1">
                    <div>
                      <table class="table">
                        @foreach($kewajibanLedgers as $key => $value)
                          @php
                          $kewajibanTotal += $value->closing_balance;
                          @endphp
                          <tr>
                            <td><h5><b>{{$value->coa->code}} - {{$value->coa->name}}</b></h5></td>
                            <td class="text-right"><h5><b>{{number_format(abs($value->closing_balance),0,",", ".")}}</b></h5></td>
                            <td width="20%"></td>
                          </tr>
                        @endforeach
                        <tr>
                          <td><h5><strong>TOTAL KEWAJIBAN DAN EKUITAS</strong></h5></td>
                          <td class="text-right" colspan="2"><h5><b>{{number_format(abs($kewajibanTotal),0,",", ".")}}</b></h5></td>
                        </tr> 
                      </table>
                    </div> 
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section LABARUGI>
@endsection
