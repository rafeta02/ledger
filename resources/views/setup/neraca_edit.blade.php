@extends('layouts.master')

@section('tab-title')
<title>Accounting - Setup</title>
@endsection

@section('page-title')
<h3 class="page-title">Setup Neraca</h3>
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

var debetC = {{$debets->setup_details->count()}};
var kreditC = {{$kredits->setup_details->count()}};

$(".select2").select2();

$(document).ready(function() {

  $('form').parsley();

  $(document).on("click", "#addDebet", function() {
    debetC++;

    $('#tableDebet').append('<tr id="rowdebet'+debetC+'"><td><select class="form-control" name="typedebet[]" id="debetselect'+debetC+'" data-placeholder="Choose Type Chart Of Account ..." required><option></option>@foreach($typeDebets as $type)<option value="{{$type->id}}">{{$type->name}}</option>@endforeach</select></td><td><button type="button" name="remove" id="'+debetC+'" class="btn btn-danger btnDebet_remove">X</button></td></tr>');

    $('#debetselect'+debetC+'').select2();
  });
   
  $(document).on('click', '.btnDebet_remove', function(){
    var button_id = $(this).attr("id"); 
    $('#rowdebet'+button_id+'').remove();
    debetC--;
  });

  $(document).on("click", "#addKredit", function() {
    kreditC++;

    $('#tableKredit').append('<tr id="rowkredit'+kreditC+'"><td><select class="form-control" name="typekredit[]" id="kreditselect'+kreditC+'" data-placeholder="Choose Type Chart Of Account ..." required><option></option>@foreach($typeKredits as $type)<option value="{{$type->id}}">{{$type->name}}</option>@endforeach</select></td><td><button type="button" name="remove" id="'+kreditC+'" class="btn btn-danger btnKredit_remove">X</button></td></tr>');

    $('#kreditselect'+kreditC+'').select2();
  });
   
  $(document).on('click', '.btnKredit_remove', function(){
    var button_id = $(this).attr("id"); 
    $('#rowkredit'+button_id+'').remove();
    kreditC--;
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
            <form class="form-horizontal group-border-dashed" action="{{route('setup.neraca.store')}}" method="post">
              {{csrf_field()}}
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-1">
                  <div class="panel panel-color panel-info">
                    <div class="panel-heading">
                      <h3 class="panel-title">AKTIVA</h3>
                    </div>
                    <div class="panel-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="tableDebet">
                          @php
                            $a = 0;
                          @endphp
                          @foreach($debets->setup_details as $key=>$value)
                          <tr id="rowdebet{{$a}}">
                            <td>
                              <input type="hidden" name="detailsetup[]" value="{{$value->id}}">
                              <select class="form-control select2" name="typedebet[]" data-placeholder="Choose Type Chart Of Account ..." required>
                                @foreach($typeDebets as $type)
                                  <option value="{{$type->id}}" {{($type->id == $value->typecoa_id) ? 'selected':''}}>{{$type->name}}</option>
                                @endforeach
                              </select>
                            </td>
                            @if($a == 0)
                              <td width="10%"><button type="button" name="addDebet" id="addDebet" class="btn btn-success">+</button></td>
                            @else
                              <td width="10%"><button type="button" name="remove" id="{{$a}}" class="btn btn-danger btnDebet_remove">X</button></td>
                            @endif
                          </tr>
                          @php
                            $a++;
                          @endphp
                          @endforeach   
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
                      <h3 class="panel-title">KEWAJIBAN DAN EKUITAS</h3>
                    </div>
                    <div class="panel-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="tableKredit">
                          @php
                            $a = 0;
                          @endphp
                          @foreach($kredits->setup_details as $key=>$value)
                          <tr id="rowkredit{{$a}}">
                            <td>
                              <input type="hidden" name="detailsetup[]" value="{{$value->id}}">
                              <select class="form-control select2" name="typekredit[]" data-placeholder="Choose Type Chart Of Account ..." required>
                                @foreach($typeKredits as $type)
                                  <option value="{{$type->id}}" {{($type->id == $value->typecoa_id) ? 'selected':''}}>{{$type->name}}</option>
                                @endforeach
                              </select>
                            </td>
                            @if($a == 0)
                              <td width="10%"><button type="button" name="addKredit" id="addKredit" class="btn btn-success">+</button></td>
                            @else
                              <td width="10%"><button type="button" name="remove" id="{{$a}}" class="btn btn-danger btnKredit_remove">X</button></td>
                            @endif
                          </tr>
                          @php
                            $a++;
                          @endphp
                          @endforeach   
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
</section SETUP NERACA>
@endsection
