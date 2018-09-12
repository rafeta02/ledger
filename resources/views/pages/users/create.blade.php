@extends('layouts.master')

@section('tab-title')
<title>Accounting - Users Administration</title>
@endsection

@section('page-title')
<h3 class="page-title">Create New User</h3>
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
<section CREATE NEW USER>
  <br>
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box">
        <div class="row">
          <div class="col-lg-12">
            {{ Form::open(array('url' => 'users')) }}

		    <div class="form-group">
		        {{ Form::label('name', 'Name') }}
		        {{ Form::text('name', '', array('class' => 'form-control')) }}
		    </div>

		    <div class="form-group">
		        {{ Form::label('email', 'Email') }}
		        {{ Form::email('email', '', array('class' => 'form-control')) }}
		    </div>

		    <div class='form-group'>
		    	{{ Form::label('role', 'Role') }} <br>
		        @foreach ($roles as $role)
		            {{ Form::checkbox('roles[]',  $role->id ) }}
		            {{ Form::label($role->name, ucfirst($role->name)) }} &emsp;
		        @endforeach
		    </div>

		    <div class="form-group">
		        {{ Form::label('password', 'Password') }}<br>
		        {{ Form::password('password', array('class' => 'form-control')) }}

		    </div>

		    <div class="form-group">
		        {{ Form::label('password', 'Confirm Password') }}<br>
		        {{ Form::password('password_confirmation', array('class' => 'form-control')) }}

		    </div>

		    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

		    {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</section CREATE NEW USER>
@endsection
