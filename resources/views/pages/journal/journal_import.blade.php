@extends('layouts.master')

@section('tab-title')
<title>Accounting - Journal</title>
@endsection

@section('page-title')
<h3 class="page-title">Import Journal</h3>
@endsection

@section('head')
@endsection

@section('scripts')
<script src="{{ url('/') }}/admin-assets/assets/plugins/parsleyjs/parsley.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
@endsection

@section('custom-scripts')
<script type="text/javascript">

$(document).ready(function() {
  $('form').parsley();  
});
</script>
@endsection

@section('content')
<section IMPORT JOURNAL>
  <br>
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box">
        <div class="row">
          <div class="col-lg-12">
            <form class="form-horizontal group-border-dashed" action="{{route('journal.importpost')}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="form-group">
                <label class="col-sm-3 control-label">File</label>
                <div class="col-sm-6">
                  <input type="file" name="file" class="form-control filestyle" data-buttonbefore="true" required placeholder="Choose your xls file" />
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9 m-t-15">
                  <button type="submit" class="btn btn-primary">
                    Submit
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section IMPORT JOURNAL>
@endsection
