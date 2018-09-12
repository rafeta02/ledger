@extends('layouts.master')

@section('tab-title')
<title>Accounting - User Roles</title>
@endsection

@section('page-title')
<h3 class="page-title">Create New User Role</h3>
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
<section CREATE NEW ROLE>
  <br>
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box">
        <div class="row">
          <div class="col-lg-12">
            {{ Form::open(array('url' => 'roles')) }}

		    <div class="form-group">
		        {{ Form::label('name', 'Name') }}
		        {{ Form::text('name', null, array('class' => 'form-control')) }}
		    </div>

		    <h4><b>Assign Permissions</b></h4>
		    @php
			$arrays = array_chunk($permissions, 8);
			@endphp

			<div class="row">
				@foreach($arrays as $array_num => $array)
					<div class="col-sm-4">
					@foreach($array as $item_num => $permission)
						<div class='form-group'>
							{{ Form::checkbox('permissions[]',  $permission['id'] ) }}
			            	{{ Form::label($permission['name'], ucfirst($permission['name'])) }}
						</div>
					@endforeach
					</div>
				@endforeach
			</div>
		    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

		    {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</section CREATE NEW ROLE>
@endsection
