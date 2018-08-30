@extends('layouts.master')

@section('tab-title')
<title>Accounting - Laba Rugi</title>
@endsection

@section('page-title')
<h3 class="page-title">Laporan Laba Rugi {{$periodText}}</h3>
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
          $dapatTotal = 0;
          $keluarTotal = 0;
          $lainTotal = 0;
          $pajakTotal = 0;
          @endphp
          <div class="col-lg-12">
            <form class="form-horizontal group-border-dashed" action="#" method="post">
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-1">
                  <div class="panel panel-success panel-border">
                    <div class="panel-heading">
                      <h3 class="panel-title">PENDAPATAN JASA</h3>
                    </div>
                    <div class="panel-body col-sm-offset-1">
                      <div>
                        <table class="table">
                          @foreach($dapatLedgers as $key => $value)
                            @php
                            $dapatTotal += $value->closing_balance;
                            @endphp
                            <tr>
                              <td><h5><b>{{$value->coa->code}} - {{$value->coa->name}}</b></h5></td>
                              <td class="text-right"><h5><b>{{number_format($value->closing_balance,0,",", ".")}}</b></h5></td>
                              <td width="20%"></td>
                            </tr>
                          @endforeach
                          <tr>
                            <td><h5><strong>TOTAL</strong></h5></td>
                            <td class="text-right" colspan="2"><h5><b>{{number_format($dapatTotal,0,",", ".")}}</b></h5></td>
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
                      <h3 class="panel-title">BEBAN PENJUALAN</h3>
                    </div>
                    <div class="panel-body col-sm-offset-1">
                      <div>
                        <table class="table">
                          @foreach($keluarLedgers as $key => $value)
                            @php
                            $keluarTotal += $value->closing_balance;
                            @endphp
                            <tr>
                              <td><h5><b>{{$value->coa->code}} - {{$value->coa->name}}</b></h5></td>
                              <td class="text-right"><h5><b>{{number_format(abs($value->closing_balance),0,",", ".")}}</b></h5></td>
                              <td width="20%"></td>
                            </tr>
                          @endforeach
                          <tr>
                            <td><h5><strong>TOTAL</strong></h5></td>
                            <td class="text-right" colspan="2"><h5><b>{{number_format(abs($keluarTotal),0,",", ".")}}</b></h5></td>
                          </tr> 
                        </table>
                      </div> 
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-1">
                  <div class="panel panel-inverse panel-border">
                    <div class="panel-heading">
                      <div>
                        <table class="table">
                          <tr>
                            <td><h3 class="panel-title">
                                @php
                                $laba1 = $dapatTotal + $keluarTotal;
                                if($laba1 >= 0){
                                  echo "LABA USAHA";
                                }else{
                                  echo "RUGI USAHA";
                                }
                                @endphp
                              </h3>
                            </td>
                            <td class="text-right"><h3 class="panel-title">
                            {{number_format(abs($laba1),0,",", ".")}}</h3></td>
                          </tr> 
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-1">
                  <div class="panel panel-default panel-border">
                    <div class="panel-heading">
                      <h3 class="panel-title">PENDAPATAN/BEBAN DILUAR USAHA</h3>
                    </div>
                    <div class="panel-body col-sm-offset-1">
                      <div>
                        <table class="table">
                          @foreach($lainLedgers as $key => $value)
                            @php
                            $lainTotal += $value->closing_balance;
                            @endphp
                            <tr>
                              <td><h5><b>{{$value->coa->code}} - {{$value->coa->name}}</b></h5></td>
                              <td class="text-right"><h5><b>{{number_format($value->closing_balance,0,",", ".")}}</b></h5></td>
                              <td width="20%"></td>
                            </tr>
                          @endforeach
                          <tr>
                            <td><h5><strong>TOTAL</strong></h5></td>
                            <td class="text-right" colspan="2"><h5><b>{{number_format($lainTotal,0,",", ".")}}</b></h5></td>
                          </tr>    
                        </table>
                      </div> 
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-1">
                  <div class="panel panel-inverse panel-border">
                    <div class="panel-heading">
                      <div>
                        <table class="table">
                          <tr>
                            <td>
                              <h3 class="panel-title">
                                @php
                                  $laba2 = $laba1 + $lainTotal;
                                  if($laba2 >= 0){
                                    echo "LABA USAHA ";
                                  }else{
                                    echo "RUGI USAHA ";
                                  }
                                @endphp
                                SEBELUM PAJAK
                              </h3>
                            </td>
                            <td class="text-right"><h3 class="panel-title">
                            {{number_format(abs($laba2),0,",", ".")}}</h3></td>
                          </tr> 
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-1">
                  <div class="panel panel-warning panel-border">
                    <div class="panel-heading">
                      <h3 class="panel-title">BEBAN PAJAK</h3>
                    </div>
                    <div class="panel-body col-sm-offset-1">
                      <div>
                        <table class="table">
                           @foreach($pajakLedgers as $key => $value)
                            @php
                            $pajakTotal += $value->closing_balance;
                            @endphp
                            <tr>
                              <td><h5><b>{{$value->coa->code}} - {{$value->coa->name}}</b></h5></td>
                              <td class="text-right"><h5><b>{{number_format($value->closing_balance,0,",", ".")}}</b></h5></td>
                              <td width="20%"></td>
                            </tr>
                          @endforeach
                          <tr>
                            <td><h5><strong>TOTAL</strong></h5></td>
                            <td class="text-right" colspan="2"><h5><b>{{number_format($pajakTotal,0,",", ".")}}</b></h5></td>
                          </tr>   
                        </table>
                      </div> 
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-1">
                  <div class="panel panel-inverse panel-border">
                    <div class="panel-heading">
                      <div>
                        <table class="table">
                          <tr>
                            <td>
                              <h3 class="panel-title">
                                @php
                                  $labaBersih = $laba2 + $pajakTotal;
                                  if($labaBersih >= 0){
                                    echo "LABA USAHA ";
                                  }else{
                                    echo "RUGI USAHA ";
                                  }
                                @endphp
                              </h3>
                            </td>
                            <td class="text-right"><h3 class="panel-title">
                            {{number_format(abs($laba2),0,",", ".")}}</h3></td>
                          </tr> 
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <br>
              <div class="form-group">
                <div class="col-sm-offset-9 col-sm-3">
                  <button type="submit" class="btn btn-lg btn-primary">
                    Save
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section LABARUGI>
@endsection
