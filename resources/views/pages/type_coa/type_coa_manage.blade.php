@extends('layouts.master')

@section('tab-title')
<title>Accounting - Type Chart Of Account</title>
@endsection


@section('page-title')
<h3 class="page-title">Manage Type Chart Of Account</h3>
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

@section('custom-scripts')
@endsection


@section('content')
<section MANAGE ALL TYPE COA>
  <br>
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box">
        @can('Create_Type_Coa')
      	 <a href="{{ route('type-coa.create') }}" class="btn btn-pink btn-rounded waves-effect waves-light">Create New Type Coa</a>
        @endcan
        <br><br>
        <table data-toggle="table" class="table-bordered">
        <thead>
          <tr>
            <th data-field="code" data-sortable="true" class="text-center">Type COA Name</th>
            <th data-field="name" class="text-center">Type COA Value</th>
            <th data-field="action" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($type_coas as $data)
          <tr>
            <td>{{ $data->name }}</td>
            <td>{{ $data->value }}</td>
            <td>
              @can('Edit_Type_Coa')
                <a href="{{route('type-coa.edit', $data->id)}}" class="btn btn-success btn-custom waves-effect waves-light btn-xs">edit</a>
              @endcan
              @can('Delete_Type_Coa')
            	<form action="{{ route('type-coa.destroy' , $data->id)}}" method="POST">
								<input name="_method" type="hidden" value="DELETE">
								{{ csrf_field() }}
						  	<button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger btn-custom waves-effect waves-light btn-xs">delete</button>
							</form>
              @endcan
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="text-center"> 
        {{ $type_coas->links() }}
      </div>
    </div>
  </div>
  </div>
</section MANAGE ALL TYPE COA>
@endsection
