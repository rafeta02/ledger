@extends('layouts.master')

@section('tab-title')
<title>Accounting Korina</title>
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
<p class="text-muted page-title-alt">Welcome Admin, <span class="text-pink">07 Agustus 2018</span></p>
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

  <div class="row">
    <div class="col-lg-4">
      <div class="card-box">
        <h4 class="m-t-0 m-b-20 header-title"><b>New Transactions</b></h4>
        <div class="nicescroll mx-box">
          <ul class="list-unstyled transaction-list m-r-5">
            <li>
              <i class="ti-download text-success"></i>
              <span class="tran-text">Advertising</span>
              <span class="pull-right text-success tran-price">+$230</span>
              <span class="pull-right text-muted">07/09/2015</span>
              <span class="clearfix"></span>
            </li>

            <li>
              <i class="ti-upload text-danger"></i>
              <span class="tran-text">Support licence</span>
              <span class="pull-right text-danger tran-price">-$965</span>
              <span class="pull-right text-muted">07/09/2015</span>
              <span class="clearfix"></span>
            </li>

            <li>
              <i class="ti-download text-success"></i>
              <span class="tran-text">Extended licence</span>
              <span class="pull-right text-success tran-price">+$830</span>
              <span class="pull-right text-muted">07/09/2015</span>
              <span class="clearfix"></span>
            </li>

            <li>
              <i class="ti-download text-success"></i>
              <span class="tran-text">Advertising</span>
              <span class="pull-right text-success tran-price">+$230</span>
              <span class="pull-right text-muted">05/09/2015</span>
              <span class="clearfix"></span>
            </li>

            <li>
              <i class="ti-upload text-danger"></i>
              <span class="tran-text">New plugins added</span>
              <span class="pull-right text-danger tran-price">-$452</span>
              <span class="pull-right text-muted">05/09/2015</span>
              <span class="clearfix"></span>
            </li>

            <li>
              <i class="ti-download text-success"></i>
              <span class="tran-text">Google Inc.</span>
              <span class="pull-right text-success tran-price">+$230</span>
              <span class="pull-right text-muted">04/09/2015</span>
              <span class="clearfix"></span>
            </li>

            <li>
              <i class="ti-upload text-danger"></i>
              <span class="tran-text">Facebook Ad</span>
              <span class="pull-right text-danger tran-price">-$364</span>
              <span class="pull-right text-muted">03/09/2015</span>
              <span class="clearfix"></span>
            </li>

            <li>
              <i class="ti-download text-success"></i>
              <span class="tran-text">New sale</span>
              <span class="pull-right text-success tran-price">+$230</span>
              <span class="pull-right text-muted">03/09/2015</span>
              <span class="clearfix"></span>
            </li>

            <li>
              <i class="ti-download text-success"></i>
              <span class="tran-text">Advertising</span>
              <span class="pull-right text-success tran-price">+$230</span>
              <span class="pull-right text-muted">29/08/2015</span>
              <span class="clearfix"></span>
            </li>

            <li>
              <i class="ti-upload text-danger"></i>
              <span class="tran-text">Support licence</span>
              <span class="pull-right text-danger tran-price">-$854</span>
              <span class="pull-right text-muted">27/08/2015</span>
              <span class="clearfix"></span>
            </li>
          </ul>
        </div>
      </div>

    </div>
    <div class="col-lg-8">
      <div class="card-box">
        <h4 class="text-dark header-title m-t-0">Number of Ticket Sold</h4>
        <div class="row">
          <div class="col-md-12">
            <div id="morris-area-with-dotted" style="height: 300px;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section HOME>
@endsection
