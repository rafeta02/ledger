@extends('layouts.master')

@section('tab-title')
<title>Accounting - Setup</title>
@endsection

@section('page-title')
<h3 class="page-title">Create New Setup Neraca</h3>
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

$(".select2").select2();

$(document).ready(function() {
  $('form').parsley();

  $(document).on("click", "#addDapat", function() {
    dapatC++;

    $('#tableDapat').append('<tr id="rowdapat'+dapatC+'"><td><select class="form-control" name="namadapat[]" id="dapatselect'+dapatC+'" data-placeholder="Choose Type Chart Of Account ..." required><option></option>@foreach($typeDebets as $type)<option value="{{$type->id}}">{{$type->name}}</option>@endforeach</select></td><td><button type="button" name="remove" id="'+dapatC+'" class="btn btn-danger btnDapat_remove">X</button></td></tr>');

    $('#dapatselect'+dapatC+'').select2();
  });
   
  $(document).on('click', '.btnDapat_remove', function(){
    var button_id = $(this).attr("id"); 
    $('#rowdapat'+button_id+'').remove();
    a--;
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
            <form class="form-horizontal group-border-dashed" action="{{route('journal.store')}}" method="post">
              {{csrf_field()}}
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-1">
                  <div class="panel panel-color panel-info">
                    <div class="panel-heading">
                      <h3 class="panel-title">PENDAPATAN</h3>
                    </div>
                    <div class="panel-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="tableDapat">
                          <tr id="rowdapat0">
                            <td>
                              <select class="form-control select2" name="namadapat[]" data-placeholder="Choose Type Chart Of Account ..." required>
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
                      <h3 class="panel-title">PENGELUARAN</h3>
                    </div>
                    <div class="panel-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="tableKredit">
                          <tr id="rowkredit0">
                            <td>
                              <select class="form-control select2" name="namakredit[]" data-placeholder="Choose Chart Of Account ..." required>
                                <option></option>

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
