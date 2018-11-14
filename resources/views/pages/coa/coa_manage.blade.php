@extends('layouts.master')

@section('tab-title')
<title>Accounting - Chart Of Account</title>
@endsection


@section('page-title')
<h3 class="page-title">Manage Chart Of Account</h3>
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
<section MANAGE ALL COA>
  <br>
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box">
        @can('Create_Coa')
          <a href="{{ route('coa.create') }}" class="btn btn-pink btn-rounded waves-effect waves-light">Create New COA</a>
        @endcan 
        <a href="{{ route('opening.index') }}" class="btn btn-pink btn-rounded waves-effect waves-light">Opening Balance</a>
        @can('Import_Coa')
        <a href="{{ route('coa.import') }}" class="btn btn-pink btn-rounded waves-effect waves-light">Import COA</a>
        @endcan 
        <a href="{{ route('coa.export') }}" class="btn btn-pink btn-rounded waves-effect waves-light">Export COA</a>
        <br><br>
        <table data-toggle="table" class="table-bordered ">
        <thead>
          <tr>
            <th data-field="code" data-sortable="true" class="text-center">Account Code</th>
            <th data-field="name" data-sortable="true" class="text-center">Account Name</th>
            <th data-field="type" class="text-center">Type</th>
            <th data-field="group" class="text-center">Group</th>
            <th data-field="parent" class="text-center">Parent Code</th>
            <th data-field="action" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($coas as $data)
          <tr>
            <td>{{ $data->code }}</td>
            <td class="text-left">{{ $data->name }}</td>
            <td>{{ $data->type_name }}</td>
            <td>{{ $data->group }}</td>
            <td>
              @if(isset($data->parent))
                {{$data->parent->code}}
              @else
                -
              @endif
            </td>
            <td>
              @can('Edit_Coa')
                <a href="{{route('coa.edit', $data->id)}}" class="btn btn-success btn-custom waves-effect waves-light btn-xs">edit</a>
              @endcan
              @can('Delete_Coa')
              <form action="{{ route('coa.destroy' , $data->id)}}" method="POST">
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
        {{ $coas->links() }}
      </div>
    </div>
  </div>
  </div>
</section MANAGE ALL COA>
@endsection
