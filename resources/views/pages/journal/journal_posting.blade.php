@extends('layouts.master')

@section('tab-title')
<title>Accounting - Journals</title>
@endsection


@section('page-title')
<h3 class="page-title">Posting Journals</h3>
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
  function docheck(checkboxElem) {
    var id = $(checkboxElem).attr("id");
    if (checkboxElem.checked) {

      $('#checkval').append('<input type="hidden" id="post'+id+'" name="posting[]" value="'+checkboxElem.value+'">');
    } else {
      $('#post'+id).remove();
    }
  }
</script>
@endsection


@section('content')
<section POSTING JOURNALS>
  <br>
  
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box">
        @can('Create_Journal')
          <a href="{{ route('journal.create') }}" class="btn btn-pink btn-rounded waves-effect waves-light">Create New Journal</a>
        @endcan
        @can('Import_Journal')
          <a href="{{ route('journal.import') }}" class="btn btn-pink btn-rounded waves-effect waves-light">Import Journal</a>
        @endcan
        <br><br>
        
        <table data-toggle="table" class="table-bordered">
          <thead>
            <tr>
              <th data-field="posting" class="text-left"></th>
              <th data-field="date" data-sortable="true" class="text-center">Journal Date</th>
              <th data-field="description" data-sortable="true" class="text-center">Description</th>
              <th data-field="type" class="text-center">Type</th>
              <th data-field="details" class="text-center">Details</th>
              <th data-field="action" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
              @php
              $a = 0;
              @endphp
              @foreach($journals as $data)
                @php
                $a++;
                @endphp
                <tr>
                  <td><input type="checkbox" id="{{$a}}" value="{{ $data->id }}" onchange="docheck(this)"></td>
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
                    @can('Edit_Journal')
                      <a href="{{route('journal.edit', $data->id)}}" class="btn btn-success btn-custom waves-effect waves-light btn-xs">edit</a>
                    @endcan
                    @can('Delete_Journal')
                      <form action="{{ route('journal.destroy' , $data->id)}}" method="POST">
                      <input name="_method" type="hidden" value="DELETE">
                      {{ csrf_field() }}
                      <button type="submit" name="delete" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger btn-custom waves-effect waves-light btn-xs">delete</button>
                      </form>
                    @endcan
                  </td>
                </tr>
              @endforeach
          </tbody>
        </table>
        <div class="text-center"> 
          {{ $journals->links() }}
        </div>
        <br>
        <br>
      <div class="row">
        <form action="{{route('journal.postingpost')}}" method="post">
          {{csrf_field()}}
          <div id="checkval">
            
          </div>
          <div class="col-sm-12 text-right">
          @can('Posting_Journal')
            <button type="submit" class="btn btn-lg btn-primary">
              Posting Journal
            </button>
          @endcan
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>
</section POSTING JOURNALS>
@endsection
