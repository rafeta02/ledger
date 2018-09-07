@extends('layouts.master')

@section('tab-title')
<title>Accounting - Journals</title>
@endsection


@section('page-title')
<h3 class="page-title">Journals</h3>
@endsection

@section('head')
<link href="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-table/css/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('/') }}/admin-assets/assets/plugins/custombox/css/custombox.css" rel="stylesheet">
<style type="text/css">
.fixed-table-container tbody tr:first-child td {
    border-top: 1px solid #ebeff2 !important;
}  
</style>
@endsection

@section('scripts')
<script src="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-table/js/bootstrap-table.min.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/pages/jquery.bs-table.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/custombox/js/custombox.min.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/custombox/js/legacy.min.js"></script>
@endsection

@section('custom-scripts')
<script type="text/javascript">
</script>
@endsection


@section('content')
<section VIEW JOURNALS>
  <br>
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box">        
        <table data-toggle="table" class="table-bordered">
          <thead>
            <tr>
              <th data-field="date" data-sortable="true" class="text-center">Journal Date</th>
              <th data-field="description" data-sortable="true" class="text-center">Description</th>
              <th data-field="type" class="text-center">Type</th>
              <th data-field="details" class="text-center">Details</th>
              <th data-field="action" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
              @foreach($journals as $data)
                <tr>
                  <td>{{ $data->date }}</td>
                  <td class="text-left">{{ $data->description }}</td>
                  <td>{{ $data->type }}</td>
                  <td>
                    <table class="table">
                      <thead>
                        <th class="text-center" width="50%">COA</th>
                        <th class="text-center">Debet</th>
                        <th class="text-center">Kredit</th>
                      </thead>
                      <tbody>
                        @foreach($data->journal_details as $key=>$value)
                          <tr>
                            <td class="text-left">{{$value->coaName}}</td>
                            <td class="text-right">{{number_format($value->debet)}}</td>
                            <td class="text-right">{{number_format($value->kredit)}}</td>
                          </tr>
                        @endforeach
                          <tr>
                            <td class="text-center"><strong>Total :</strong></td>
                            <td class="text-center" colspan="2"><strong>{{number_format($data->amount) }}</strong></td>
                          </tr>
                      </tbody>
                    </table>
                  </td>
                  <td>
                    <form action="{{ route('journal.destroy' , $data->id)}}" method="POST">
                      <input name="_method" type="hidden" value="DELETE">
                      {{ csrf_field() }}
                      <a href="{{route('journal.edit', $data->id)}}" class="btn btn-success btn-custom waves-effect waves-light btn-xs">edit</a>
                      <button type="submit" name="delete" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger btn-custom waves-effect waves-light btn-xs">delete</button>
                    </form>
                  </td>
                </tr>
              @endforeach
          </tbody>
        </table>
        <div class="text-center"> 
          {{ $journals->links() }}
        </div>
    </div>
  </div>
  </div>
</section VIEW JOURNALS>
@endsection
