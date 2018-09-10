<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="{{ url('/') }}/favicon.ico">

        <title>Akunting - Error 401 Access Denied</title>

		<link href="{{ url('/') }}/admin-assets/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="{{ url('/') }}/admin-assets/assets/css/core.css" rel="stylesheet" type="text/css" />
		<link href="{{ url('/') }}/admin-assets/assets/css/components.css" rel="stylesheet" type="text/css" />
		<link href="{{ url('/') }}/admin-assets/assets/css/icons.css" rel="stylesheet" type="text/css" />
		<link href="{{ url('/') }}/admin-assets/assets/css/pages.css" rel="stylesheet" type="text/css" />
		<link href="{{ url('/') }}/admin-assets/assets/css/responsive.css" rel="stylesheet" type="text/css" />
		  

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script src="{{ url('/') }}/admin-assets/assets/js/modernizr.min.js"></script>
        
    </head>
    <body>

        <div class="account-pages"></div>
		<div class="clearfix"></div>
		
        <div class="wrapper-page">
            <div class="ex-page-content text-center">
                <div class="text-error"><span class="text-primary">4</span><i class="ti-face-sad text-pink"></i><span class="text-info">1</span></div>
                <h2>Access Denied</h2><br>
                <p class="text-muted">You don't have permission to access this page.</p>
                <br>
                <a class="btn btn-default waves-effect waves-light" href="{{ redirect()->getUrlGenerator()->previous() }}"> Return Home</a>
                
            </div>
        </div>
        
        

        
    	<script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
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
	
	</body>
</html>