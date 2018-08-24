@extends('layouts.master')

@section('tab-title')
<title>Accounting - Chart Of Account</title>
@endsection

@section('page-title')
<h3 class="page-title">Create New Chart Of Account</h3>
@endsection

@section('head')
<link href="{{ url('/') }}/admin-assets/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
<script src="{{ url('/') }}/admin-assets/assets/plugins/parsleyjs/parsley.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
@endsection

@section('custom-scripts')
<script type="text/javascript">
$('.selectpicker').selectpicker();

$(".select2").select2();

$(document).ready(function() {
  $('form').parsley();  
});
</script>
@endsection

@section('content')
<section CREATE NEW COA>
  <br>
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box">
        <div class="row">
          <div class="col-lg-12">
            <form class="form-horizontal group-border-dashed" action="{{route('coa.store')}}" method="post">
              {{csrf_field()}}
              <div class="form-group">
                <label class="col-sm-3 control-label">Account Code</label>
                <div class="col-sm-6">
                  <input type="text" name="code" class="form-control" required placeholder="Account Code" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Account Name</label>
                <div class="col-sm-6">
                  <input type="text" name="name" class="form-control" required placeholder="Account Name" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Group Type</label>
                <div class="col-sm-6">
                  <select class="form-control selectpicker" name="group" data-style="btn-white" required title="Choose group type...">
                    <option value="Neraca">Neraca</option>
                    <option value="Labarugi">Laba Rugi</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Account Type</label>
                <div class="col-sm-6">
                  <select class="form-control select2" name="type_id" data-placeholder="Choose Account Type ..." required>
                    <option></option>
                    @foreach($type_coas as $type_coa)
                      <option value="{{$type_coa->id}}">{{$type_coa->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Parent Id</label>
                <div class="col-sm-6">
                  <select class="form-control select2" name="parent" data-placeholder="Choose Parent..." required>
                    <option></option>
                    <option value="null">Null</option>
                     @foreach($coas as $coa)
                      <option value="{{$coa->id}}">{{$coa->code}}-{{$coa->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9 m-t-15">
                  <button type="submit" class="btn btn-primary">
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
</section CREATE NEW COA>
@endsection
