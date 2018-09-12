@extends('layouts.master')

@section('tab-title')
<title>Accounting - User Administration</title>
@endsection


@section('page-title')
<h3 class="page-title">Manage User</h3>
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
<section MANAGE ALL USER>
  <br>
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box">
      	<a href="{{ route('users.create') }}" class="btn btn-pink btn-rounded waves-effect waves-light">Create New User</a>
        <br><br>
        <table data-toggle="table" class="table-bordered ">
        <thead>
          <tr>
            <th data-field="name" data-sortable="true" class="text-center">Name</th>
            <th data-field="email" class="text-center">Email</th>
            <th data-field="datetime" class="text-center">Date/Time Added</th>
            <th data-field="roles" class="text-center">User Roles</th>
            <th data-field="action" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
			@foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                    <td>{{  $user->roles()->pluck('name')->implode(', ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}

                    <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
      <div class="text-center"> 
        {{ $users->links() }}
      </div>
    </div>
  </div>
  </div>
</section MANAGE ALL USER>
@endsection
