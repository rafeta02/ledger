@extends('layouts.master')

@section('tab-title')
<title>Accounting - User Permissions</title>
@endsection


@section('page-title')
<h3 class="page-title">Manage User Permissions</h3>
@endsection

@section('head')
<link href="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-table/css/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('/') }}/admin-assets/assets/plugins/custombox/css/custombox.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-table/js/bootstrap-table.min.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/pages/jquery.bs-table.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/custombox/js/custombox.min.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/custombox/js/legacy.min.js"></script>
@endsection

@section('content')
<section MANAGE ALL PERMISSION>
  <br>
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box">
      	<a href="{{ route('permissions.create') }}" class="btn btn-pink btn-rounded waves-effect waves-light">Create New Permission</a>
        <br><br>
        <table data-toggle="table" class="table-bordered ">
        <thead>
          <tr>
            <th data-field="permissions" data-sortable="true" class="text-center">Permissions</th>
            <th data-field="action" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($permissions as $permission)
		        <tr>
		            <td>{{ $permission->name }}</td> 
		            <td>
		            {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
		            <a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}" class="btn btn-info btn-xs" style="margin-right: 3px;">Edit</a>
		            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure to delete?')"]) !!}
		            {!! Form::close() !!}
		            </td>
		        </tr>
	        @endforeach
        </tbody>
      </table>
      <div class="text-center"> 
        {{ $permissions->links() }}
      </div>
    </div>
  </div>
  </div>
</section MANAGE ALL PERMISSION>
@endsection
