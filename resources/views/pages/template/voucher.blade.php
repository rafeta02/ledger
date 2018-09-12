<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="{{ url('/') }}/favicon.ico">

        <title>Akunting - Voucher Journal</title>

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

        <style type="text/css">
            #isi {
                margin-top: 40px;
            }

            .panel {
                padding : 30px;
            }

            #approve {
                margin-top: 40px;
            }

            #tdtangan {
                margin-top: 60px;
            }

            .container {
                padding: 20px;
            }
        </style>
    </head>
    <body>
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="text-center">Journal Voucher</h3>
                            </div>
                            <div class="panel-body">
                                <table width="50%" id="header">
                                    <tr>
                                        <td width="25%"><h4>Journal Date</h4></td>
                                        <td width="10%"><h4>:</h4></td>
                                        <td><h4>{{ \Carbon\Carbon::parse($journal->date)->format('d M Y') }}</h4></td>
                                    </tr>
                                    <tr>
                                        <td><h4>Description</h4></td>
                                        <td><h4>:</h4></td>
                                        <td><h4>{{ $journal->description }}</h4></td>
                                    </tr>
                                </table>
                                <table class="table" width="100%" id="isi">
                                    <tr>
                                        <th>Account Code</th>
                                        <th>Account Name</th>   
                                        <th>Debet</th>
                                        <th>Kredit</th>
                                    </tr>
                                    @foreach($journal->journal_details as $key=>$value)
                                    <tr>
                                        <td>{{$value->coaCodeCode}}</td>
                                        <td>{{$value->coaNameName}}</td>
                                        <td>{{number_format($value->debet)}}</td>
                                        <td>{{number_format($value->kredit)}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2" class="text-center"><strong>Total</strong></td>
                                        <td><strong>{{number_format($journal->amount) }}</strong></td>
                                        <td><strong>{{number_format($journal->amount) }}</strong></td>
                                    </tr>
                                </table>
                                <table width="100%" id="approve">
                                    <tr>
                                        <td width="75%"></td>
                                        <td><p class="text-center"><strong>Approved By</strong></p></td>
                                        <td width="10%"></td>
                                    </tr>
                                </table>
                                <table width="100%" id="tdtangan">
                                    <tr>
                                        <td width="75%"></td>
                                        <td><hr></td>
                                        <td width="10%"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container -->            
        </div> <!-- content -->

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
	
	</body>
</html>