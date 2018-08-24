<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="{{ url('/') }}/favicon.ico">
  @yield('tab-title')
  <link href="{{ url('/') }}/admin-assets/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="{{ url('/') }}/admin-assets/assets/css/core.css" rel="stylesheet" type="text/css" />
  <link href="{{ url('/') }}/admin-assets/assets/css/components.css" rel="stylesheet" type="text/css" />
  <link href="{{ url('/') }}/admin-assets/assets/css/icons.css" rel="stylesheet" type="text/css" />
  <link href="{{ url('/') }}/admin-assets/assets/css/pages.css" rel="stylesheet" type="text/css" />
  <link href="{{ url('/') }}/admin-assets/assets/css/responsive.css" rel="stylesheet" type="text/css" />
  @yield('head')
  <script src="{{ url('/') }}/admin-assets/assets/js/modernizr.min.js"></script>
</head>


<body class="fixed-left">
  <div id="wrapper">

    <!-- ========== Topbar ========== -->
      @include('layouts.topbar')
    <!-- Topbar End -->

    <!-- ========== Left Sidebar Start ========== -->
      @include('layouts.sidebar')
    <!-- Left Sidebar End -->

    <!-- ========== Content ========== -->
    <div class="content-page">
      <div class="content">
        <div class="container">

          <!-- TITLE -->
          <div class="row">
            <div class="col-sm-12">
              @yield('page-title')
              @yield('subtitle')
            </div>
          </div>
          <!-- end TITLE -->

          @yield('content')
        </div>
      </div>

      <!-- FOOTER -->
      <footer class="footer text-right">
        © 2018. All rights reserved.
      </footer>
      <!-- END FOOTER -->
    </div>
  </div>

  <script>
    var resizefunc = [];
  </script>
  <script src="{{ url('/') }}/admin-assets/assets/js/jquery.min.js"></script>
  <script src="{{ url('/') }}/admin-assets/assets/js/bootstrap.min.js"></script>
  <script src="{{ url('/') }}/admin-assets/assets/js/waves.js"></script>
  <script src="{{ url('/') }}/admin-assets/assets/js/detect.js"></script>
  <script src="{{ url('/') }}/admin-assets/assets/js/fastclick.js"></script>
  <script src="{{ url('/') }}/admin-assets/assets/js/jquery.slimscroll.js"></script>
  <script src="{{ url('/') }}/admin-assets/assets/js/jquery.blockUI.js"></script>
  <script src="{{ url('/') }}/admin-assets/assets/js/wow.min.js"></script>
  <script src="{{ url('/') }}/admin-assets/assets/js/jquery.nicescroll.js"></script>
  <script src="{{ url('/') }}/admin-assets/assets/js/jquery.scrollTo.min.js"></script>
  <script src="{{ url('/') }}/admin-assets/assets/plugins/notifyjs/js/notify.js"></script>
  <script src="{{ url('/') }}/admin-assets/assets/plugins/notifications/notify-metro.js"></script>

  @yield('scripts')

  <!-- <script src="{{ url('/') }}/admin-assets/assets/pages/jquery.dashboard_2.js"></script> -->
  <script src="{{ url('/') }}/admin-assets/assets/js/jquery.core.js"></script>
  <script src="{{ url('/') }}/admin-assets/assets/js/jquery.app.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      @php
      if(session('successMsg')){
        echo "$.Notification.notify('success','right middle','Success', '".session('successMsg')."');";
      }elseif(session('errorMsg')){
        echo "$.Notification.notify('error','right middle', 'Error', '".session('errorMsg')."');";
      }elseif(session('warningMsg')){
        echo "$.Notification.notify('warning','right middle','Warning', '".session('warningMsg')."');";
      } 
      @endphp
    });
  </script>

  @yield('custom-scripts')
</body>
</html>
