@extends('layouts.master')

@section('tab-title')
<title>Accounting - Journal</title>
@endsection


@section('page-title')
<h3 class="page-title">Journal</h3>
@endsection

@section('head')
<link href="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-table/css/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('/') }}/admin-assets/assets/plugins/custombox/css/custombox.css" rel="stylesheet">
<link href="{{ url('/') }}/admin-assets/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-table/js/bootstrap-table.min.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/pages/jquery.bs-table.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/custombox/js/custombox.min.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/custombox/js/legacy.min.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/parsleyjs/parsley.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/moment/moment.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
@endsection

@section('custom-scripts')
<script type="text/javascript">
$(".select2").select2();

$(document).ready(function() {
  $('form').parsley();  
  $('.selectpicker').selectpicker();

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
<section JOURNAL FILTER>
  <br>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-inverse panel-color">
        <div class="panel-heading">
          <h3 class="panel-title">Filter Journal</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal group-border-dashed" action="{{route('journal.view')}}" method="get">
          	{{-- <div class="form-group">
              <label class="col-sm-3 control-label">Period Range</label>
              <div class="col-sm-6">
              	<div class="input-group">
	                <input type="text" autocomplete="off" name="periodRange" id="periodRange" class="form-control" required placeholder="Choose Period..." />
	                <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
	              </div>
              </div>
            </div> --}}
            <div class="form-group">
              <label class="col-sm-3 control-label">Period</label>
              <div class="col-sm-6">
              	<div class="input-group">
	                <input type="text" autocomplete="off" name="period" id="period" class="form-control" required placeholder="Choose Period..." />
	                <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
	              </div>
              </div>
            </div>
            <div class="form-group">
            	<label class="col-sm-3 control-label">Type Journal</label>
              <div class="col-sm-6">
                <select class="form-control selectpicker" name="type" data-style="btn-white" required title="Choose group type...">
                		<option value="All">All</option>
                    <option value="Kas">Kas</option>
                    <option value="Memo">Memo</option>
                </select>
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
</section JOURNAL FILTER>
@endsection
