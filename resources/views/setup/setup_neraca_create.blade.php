@extends('layouts.master')

@section('tab-title')
<title>Accounting - Journal</title>
@endsection

@section('page-title')
<h3 class="page-title">Create New Journal</h3>
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

var nf = Intl.NumberFormat();
var a= 0;
var b= 0;

$('.selectpicker').selectpicker();

$(".select2").select2();

$(document).ready(function() {
  $('form').parsley();

  inputDebet();
  inputKredit();

  $('#date').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true,
  });

  $('#date').datepicker('setDate', 'today');

  $('#addDebet').click(function(){
    a++;

    $('#tableDebet').append('<tr id="rowdebet'+a+'"><td><select class="form-control select2" name="namadebet[]" data-placeholder="Choose Chart Of Account ..." required><option></option>@foreach($coas as $coa)<option value="{{$coa->id}}">{{$coa->code}}-{{$coa->name}}</option>@endforeach</select></td><td><input id="debet'+a+'" type="number" value="0" min="0" data-parsley-type="number" name="debet[]" placeholder="Enter Debet Amount" class="form-control" required="" onkeyup="inputDebet()" /></td><td><button type="button" name="remove" id="'+a+'" class="btn btn-danger btnDebet_remove">X</button></td></tr>');
  });
   
  $(document).on('click', '.btnDebet_remove', function(){
    var button_id = $(this).attr("id"); 
    $('#rowdebet'+button_id+'').remove();
    a--;
    inputDebet();
  });

  $('#addKredit').click(function(){
    b++;

    $('#tableKredit').append('<tr id="rowkredit'+b+'"><td><select class="form-control select2" name="namakredit[]" data-placeholder="Choose Chart Of Account ..." required><option></option>@foreach($coas as $coa)<option value="{{$coa->id}}">{{$coa->code}}-{{$coa->name}}</option>@endforeach</select></td><td><input id="kredit'+b+'" type="number" value="0" min="0" data-parsley-type="number" name="kredit[]" placeholder="Enter Kredit Amount" class="form-control" required="" onkeyup="inputKredit()" /></td><td><button type="button" name="remove" id="'+b+'" class="btn btn-danger btnKredit_remove">X</button></td></tr>');
  });
  
  $(document).on('click', '.btnKredit_remove', function(){
    var button_id = $(this).attr("id"); 
    $('#rowkredit'+button_id+'').remove(); 
    b--;
    inputKredit();
  });

});

function inputDebet(){
  var i;
  var totaldebet = 0;
  for (i = 0; i <= a; i++) { 
      totaldebet += parseInt($('#debet'+i).val());
  }
  console.log(nf.format(totaldebet));
  $('#totaldebet').val(totaldebet);
}

function inputKredit(){
  var i;
  var totalkredit = 0;
  for (i = 0; i <= b; i++) { 
      totalkredit += parseInt($('#kredit'+i).val());
  }
  $('#totalkredit').val(totalkredit);
}
</script>
@endsection

@section('content')
<section CREATE NEW JOURNAL>
  <br>
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box">
        <div class="row">
          <div class="col-lg-12">
            <form class="form-horizontal group-border-dashed" action="{{route('journal.store')}}" method="post">
              {{csrf_field()}}
              <div class="form-group">
                <label class="col-sm-2 col-sm-offset-1 control-label" style="text-align: left;">Journal Date</label>
                <div class="col-sm-4">
                  <input type="text" id="date" name="date" class="form-control" required="" placeholder="Journal Date" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 col-sm-offset-1 control-label" style="text-align: left;">Description</label>
                <div class="col-sm-8">
                   <textarea name="description" class="form-control" rows="5" required=""></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-1">
                  <div class="panel panel-color panel-info">
                    <div class="panel-heading">
                      <h3 class="panel-title">DEBET</h3>
                    </div>
                    <div class="panel-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="tableDebet">
                          <tr id="rowdebet0">
                            <td>
                              <select class="form-control select2" name="namadebet[]" data-placeholder="Choose Chart Of Account ..." required>
                                <option></option>
                                @foreach($coas as $coa)
                                  <option value="{{$coa->id}}">{{$coa->code}}-{{$coa->name}}</option>
                                @endforeach
                              </select>
                            </td>
                            <td><input id="debet0" type="number" value="0" min="0" data-parsley-type="number" name="debet[]" placeholder="Enter Debet Amount" class="form-control" required="" onkeyup="inputDebet()" /></td>
                            <td width="10%"><button type="button" name="addDebet" id="addDebet" class="btn btn-success">+</button></td>
                          </tr>  
                        </table>
                        <table class="table">
                          <tr>
                            <td width="45%" align="right"><strong style="font-size: 20px;">Total : </strong></td>
                            <td width="45%" align="right"><strong style="font-size: 20px;">Rp. <input id="totaldebet" name="totaldebet" type="number" value="0" min="0" data-parsley-equalto="#totalkredit" readonly="" style="text-align: right;" /></strong></td>
                            <td width="10%"></td>
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
                      <h3 class="panel-title">KREDIT</h3>
                    </div>
                    <div class="panel-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="tableKredit">
                          <tr id="rowkredit0">
                            <td>
                              <select class="form-control select2" name="namakredit[]" data-placeholder="Choose Chart Of Account ..." required>
                                <option></option>
                                @foreach($coas as $coa)
                                  <option value="{{$coa->id}}">{{$coa->code}}-{{$coa->name}}</option>
                                @endforeach
                              </select>
                            </td>
                            <td><input id="kredit0" type="number" value="0" min="0" data-parsley-type="number" name="kredit[]" placeholder="Enter Kredit Amount" class="form-control" required="" onkeyup="inputKredit()" /></td>
                            <td width="10%"><button type="button" name="addKredit" id="addKredit" class="btn btn-success">+</button></td>
                          </tr>  
                        </table>
                        <table class="table">
                          <tr>
                            <td width="45%" align="right"><strong style="font-size: 20px;">Total : </strong></td>
                            <td width="45%" align="right"><strong style="font-size: 20px;">Rp. <input id="totalkredit" name="totalkredit" type="number" value="0" min="0" data-parsley-equalto="#totaldebet" readonly="" style="text-align: right;" /></strong></td>
                            <td width="10%"></td>
                          </tr>  
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-8 col-sm-4">
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
