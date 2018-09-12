@extends('layouts.master')

@section('tab-title')
<title>Accounting - User Roles</title>
@endsection


@section('page-title')
<h3 class="page-title">Manage User Roles</h3>
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
<section MANAGE ALL ROLE>
  <br>
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box">
      	<a href="{{ route('roles.create') }}" class="btn btn-pink btn-rounded waves-effect waves-light">Create New Role</a>
        <br><br>
        <table data-toggle="table" class="table-bordered ">
        <thead>
          <tr>
            <th data-field="role" data-sortable="true" class="text-center">Role</th>
            <th data-field="permissions" class="text-center">Permissions</th>
            <th data-field="action" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
			@foreach ($roles as $role)
                <tr>
                    <td><strong>{{ $role->name }}</strong></td>
                    <td>{{  $role->permissions()->pluck('name')->implode(', ') }}</td>
                    <td>
                    <a href="{{ URL::to('roles/'.$role->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure to delete?')"]) !!}
                    {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
      <div class="text-center"> 
        {{ $roles->links() }}
      </div>
    </div>
  </div>
  </div>
</section MANAGE ALL ROLE>
@endsection
