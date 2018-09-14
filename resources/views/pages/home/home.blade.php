@extends('layouts.master')

@section('tab-title')
<title>Accounting - Home</title>
@endsection

@section('page-title')
<h3 class="page-title">Home</h3>
@endsection

@section('head')
<link rel="stylesheet" href="{{ url('/') }}/admin-assets/assets/plugins/morris/morris.css">
@endsection

@section('scripts')
<script src="{{ url('/') }}/admin-assets/assets/js/jquery.nicescroll.js"></script>
@endsection

@section('scripts')
<script src="{{ url('/') }}/admin-assets/assets/plugins/morris/morris.min.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/raphael/raphael-min.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/custombox/js/custombox.min.js"></script>
<script src="{{ url('/') }}/admin-assets/assets/plugins/custombox/js/legacy.min.js"></script>
@endsection

@section('subtitle')
<p class="text-muted page-title-alt">Welcome, {{ Auth::user()->name }}</p>
@endsection

@section('content')
<section HOME>
  <div class="row">
    <div class="col-lg-4 col-sm-6">
      <div class="widget-panel widget-style-2 bg-white">
        <i class="md md-payment text-primary"></i>
        <h2 class="m-0 text-dark counter font-600">50568</h2>
        <div class="text-muted m-t-5">New Transaction</div>
      </div>
    </div>
    <div class="col-lg-4 col-sm-6">
      <div class="widget-panel widget-style-2 bg-white">
        <i class="md md-loyalty text-pink"></i>
        <h2 class="m-0 text-dark counter font-600">1256</h2>
        <div class="text-muted m-t-5">Available Ticket</div>
      </div>
    </div>
    <div class="col-lg-4 col-sm-12">
      <div class="widget-panel widget-style-2 bg-white">
        <i class="md md-account-child text-info"></i>
        <h2 class="m-0 text-dark counter font-600">18</h2>
        <div class="text-muted m-t-5">New Agent <span class="text-pink">(not verified)</span></div>
      </div>
    </div>
  </div>
</section HOME>
@endsection
