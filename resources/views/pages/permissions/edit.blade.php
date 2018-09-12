@extends('layouts.master')

@section('tab-title')
<title>Accounting - User Permissions</title>
@endsection

@section('page-title')
<h3 class="page-title">Edit User Permissions</h3>
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

$(document).ready(function() {
  $('form').parsley();  
});
</script>
@endsection

@section('content')
<section EDIT PERMISSION>
  <br>
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box">
        <div class="row">
          <div class="col-lg-12">
            {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}

		    <div class="form-group">
		        {{ Form::label('name', 'Permission Name') }}
		        {{ Form::text('name', null, array('class' => 'form-control')) }}
		    </div>
		    <br>
		    {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

		    {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</section EDIT PERMISSION>
@endsection
