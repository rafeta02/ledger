@extends('layouts.master')

@section('tab-title')
<title>Accounting - Chart Of Account</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('page-title')
<h3 class="page-title">Initiate Opening Balance</h3>
@endsection

@section('head')
<link href="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-table/css/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('/') }}/admin-assets/assets/plugins/custombox/css/custombox.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
@endsection

@section('scripts')
<script src="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-table/js/bootstrap-table.min.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/pages/jquery.bs-table.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/custombox/js/custombox.min.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/custombox/js/legacy.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
@endsection

@section('custom-scripts')
<script type="text/javascript">
  $(document).ready(function() {
    //toggle `popup` / `inline` mode
    $.fn.editable.defaults.mode = 'inline';
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      rating_id = $(this).data('pk');
      url = $(this).data('url');

      //make username editable
      $('.update').editable({
        url: url,
        pk: rating_id,
        type:"number",
        validate:function(value){
          if($.trim(value) === '')
          {
            return 'This field is required';
          }
        }
      });

  });
</script>
@endsection

@section('content')
<section MANAGE ALL COA>
  <br>
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box">
        <table data-toggle="table" class="table-bordered ">
        <thead>
          <tr>
            <th data-field="code" data-sortable="true" class="text-center">Account Code</th>
            <th data-field="name" data-sortable="true" class="text-center">Account Name</th>
            <th data-field="balance" class="text-center">Opening Balance</th>
          </tr>
        </thead>
        <tbody>
          @foreach($balance as $data)
          <tr>
            <td>{{ $data->coa->code }}</td>
            <td>{{ $data->coa->name }}</td>
            <td class="text-center"><a href="#" class="update" data-name="opening_balance" data-url="{{ route('opening.updatebalance', $data->id)}}" data-pk="{{ $data->id }}" data-type="number" data-placement="right" data-title="Enter Opening Balance">{{number_format($data->opening_balance) }}</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="text-center"> 
        {{ $balance->links() }}
      </div>
    </div>
  </div>
  </div>
</section MANAGE ALL COA>
@endsection
