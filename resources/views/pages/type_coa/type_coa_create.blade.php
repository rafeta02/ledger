@extends('layouts.master')

@section('tab-title')
<title>Chart Of Account - Type COA</title>
@endsection

@section('page-title')
<h3 class="page-title">Create New Type Chart Of Account</h3>
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
<section CREATE NEW TYPE COA>
  <br>
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box">
        <div class="row">
          <div class="col-lg-12">
            <form class="form-horizontal group-border-dashed" action="{{route('type-coa.store')}}" method="post">
              {{csrf_field()}}
              <div class="form-group">
                <label class="col-sm-3 control-label">Name Type</label>
                <div class="col-sm-6">
                  <input type="text" name="name" class="form-control" required placeholder="Name Type" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Value Type</label>
                <div class="col-sm-6">
                  <select class="form-control selectpicker" name="value" data-style="btn-white" required title="Choose Value Type ...">
                    <option value="Debet">Debet</option>
                    <option value="Kredit">Kredit</option>
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
</section CREATE NEW TYPE COA>
@endsection
