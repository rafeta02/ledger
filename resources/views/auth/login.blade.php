<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="{{ url('/') }}/favicon.ico">

        <title>Akunting - Login</title>

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
        	<div class=" card-box">
            <div class="panel-heading"> 
                <h3 class="text-center"> Sign In to <strong class="text-custom">Akunting</strong> </h3>
            </div> 
            <div class="panel-body">
            <form class="form-horizontal m-t-20" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-primary">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="checkbox-signup">
                                Remember me
                            </label>
                        </div>
                        
                    </div>
                </div>
                
                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                    </div>
                </div>

                <div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-12">
                        <a href="{{ route('password.request') }}" class="text-dark"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                    </div>
                </div>
            </form> 
            
            </div>   
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