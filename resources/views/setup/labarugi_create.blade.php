@extends('layouts.master')

@section('tab-title')
<title>Accounting - Setup</title>
@endsection

@section('page-title')
<h3 class="page-title">Laba Rugi Neraca</h3>
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

var dapatC = 0;
var keluarC = 0;
var lainC = 0;

$(".select2").select2();

$(document).ready(function() {

  $('form').parsley();

  $(document).on("click", "#addDapat", function() {
    dapatC++;

    $('#tableDapat').append('<tr id="rowdapat'+dapatC+'"><td><select class="form-control" name="typedapat[]" id="dapatselect'+dapatC+'" data-placeholder="Choose Type Chart Of Account ..." required><option></option>@foreach($typeDebets as $type)<option value="{{$type->id}}">{{$type->name}}</option>@endforeach</select></td><td><button type="button" name="remove" id="'+dapatC+'" class="btn btn-danger btnDapat_remove">X</button></td></tr>');

    $('#dapatselect'+dapatC+'').select2();
  });
   
  $(document).on('click', '.btnDapat_remove', function(){
    var button_id = $(this).attr("id"); 
    $('#rowdapat'+button_id+'').remove();
    dapatC--;
  });

  $(document).on("click", "#addKeluar", function() {
    keluarC++;

    $('#tableKeluar').append('<tr id="rowkeluar'+keluarC+'"><td><select class="form-control" name="typekeluar[]" id="keluarselect'+keluarC+'" data-placeholder="Choose Type Chart Of Account ..." required><option></option>@foreach($typeKredits as $type)<option value="{{$type->id}}">{{$type->name}}</option>@endforeach</select></td><td><button type="button" name="remove" id="'+keluarC+'" class="btn btn-danger btnKeluar_remove">X</button></td></tr>');

    $('#keluarselect'+keluarC+'').select2();
  });
   
  $(document).on('click', '.btnKeluar_remove', function(){
    var button_id = $(this).attr("id"); 
    $('#rowkeluar'+button_id+'').remove();
    keluarC--;
  });

  $(document).on("click", "#addLain", function() {
    lainC++;

    $('#tableLain').append('<tr id="rowlain'+lainC+'"><td><select class="form-control" name="typelain[]" id="lainselect'+lainC+'" data-placeholder="Choose Type Chart Of Account ..." required><option></option>@foreach($typeKredits as $type)<option value="{{$type->id}}">{{$type->name}}</option>@endforeach</select></td><td><button type="button" name="remove" id="'+lainC+'" class="btn btn-danger btnLain_remove">X</button></td></tr>');

    $('#lainselect'+lainC+'').select2();
  });
   
  $(document).on('click', '.btnLain_remove', function(){
    var button_id = $(this).attr("id"); 
    $('#rowlain'+button_id+'').remove();
    lainC--;
  });

});
</script>
@endsection

@section('content')
<section SETUP NERACA>
  <br>
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box">
        <div class="row">
          <div class="col-lg-12">
            <form class="form-horizontal group-border-dashed" action="{{route('setup.labarugi.store')}}" method="post">
              {{csrf_field()}}
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-1">
                  <div class="panel panel-color panel-info">
                    <div class="panel-heading">
                      <h3 class="panel-title">PENDAPATAN USAHA</h3>
                    </div>
                    <div class="panel-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="tableDapat">
                          <tr id="rowdapat0">
                            <td>
                              <select class="form-control select2" name="typedapat[]" data-placeholder="Choose Type Chart Of Account ..." required>
                                <option></option>
                                @foreach($typeDebets as $type)
                                  <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                              </select>
                            </td>
                            <td width="10%"><button type="button" name="addDapat" id="addDapat" class="btn btn-success">+</button></td>
                          </tr>  
                        </table>
                      </div> 
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-1">
                  <div class="panel panel-color panel-danger">
                    <div class="panel-heading">
                      <h3 class="panel-title">BEBAN USAHA</h3>
                    </div>
                    <div class="panel-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="tableKeluar">
                          <tr id="rowkeluar0">
                            <td>
                              <select class="form-control select2" name="typekeluar[]" data-placeholder="Choose Type  Chart Of Account ..." required>
                                <option></option>
                                @foreach($typeKredits as $type)
                                  <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                              </select>
                            </td>
                            <td width="10%"><button type="button" name="addKeluar" id="addKeluar" class="btn btn-success">+</button></td>
                          </tr>  
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-1">
                  <div class="panel panel-color panel-warning">
                    <div class="panel-heading">
                      <h3 class="panel-title">PENDAPATAN/BEBAN DILUAR USAHA</h3>
                    </div>
                    <div class="panel-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="tableLain">
                          <tr id="rowlain0">
                            <td>
                              <select class="form-control select2" name="typelain[]" data-placeholder="Choose Type  Chart Of Account ..." required>
                                <option></option>
                                @foreach($types as $type)
                                  <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                              </select>
                            </td>
                            <td width="10%"><button type="button" name="addLain" id="addLain" class="btn btn-success">+</button></td>
                          </tr>  
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-1">
                  <div class="panel panel-color panel-inverse">
                    <div class="panel-heading">
                      <h3 class="panel-title">BEBAN PAJAK</h3>
                    </div>
                    <div class="panel-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="tablePajak">
                          <tr id="rowpajak">
                            <td>
                              <select class="form-control select2" name="typepajak" data-placeholder="Choose Type  Chart Of Account ..." required>
                                <option></option>
                                @foreach($types as $type)
                                  <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                              </select>
                            </td>
                          </tr>  
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-9 col-sm-3">
                  <button type="submit" class="btn btn-lg btn-primary">
                    Submit
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section CREATE NEW JOURNAL>
@endsection
