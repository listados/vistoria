<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
    @yield('title', config('adminlte.title', 'EspindolaAdmin'))
    @yield('title_postfix', config('adminlte.title_postfix', ''))</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">

    @if(config('adminlte.plugins.select2'))
        <!-- Select2 -->
        {{-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css"> --}}
    @endif

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">

    @if(config('adminlte.plugins.datatables'))
        <!-- DataTables -->
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    @endif
    
    <!-- STYLE --> 
    {{ Html::style('/css/all.min.css') }}
    {{ Html::style('https://www.jqueryscript.net/demo/Rich-Text-Editor-jQuery-RichText/richtext.min.css') }}
    <!--PARA NOTIFICAÇÃO -->
    {{ Html::style('css/plugins/pnotify.custom.min.css')}}
    {{ Html::style('css/plugins/animate.css')}}
    @yield('adminlte_css')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script type="text/javascript">
         //GLOBALIZANDO URL
     var project_survey = '/';
     domin  =  window.location.protocol + "//" + window.location.hostname+':5050';
     var domain_complet = domin + project_survey; 
     var url = window.location.origin;
    var domain_external = 'https://espindolaimobiliaria.com.br/ea/';

    </script>
    <!-- FUNÇÃO -->
    
</head>
<body class="hold-transition @yield('body_class')">
    <div id="app">
        @yield('body')
    </div>


<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="/js/manifest.js"></script>
   <script src="/js/vendor.js"></script>
   <script src="{{asset('js/app.js')}}"></script>
@if(config('adminlte.plugins.select2'))
    <!-- Select2 -->
    
    {{ Html::script('js/plugins/select2.min.js')}}
@endif

@if(config('adminlte.plugins.datatables'))   
    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
@endif

@if(config('adminlte.plugins.chartjs'))
    <!-- ChartJS -->
    {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script> --}}
@endif
    <!-- ckeditor -->
{{-- <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script> --}}
{{-- <script src="https://www.jqueryscript.net/demo/Rich-Text-Editor-jQuery-RichText/jquery.richtext.js"></script> --}}


{{ Html::script('/js/all.js') }}
<!-- NOTIFICAÇÃO -->
{{ Html::script('js/plugins.js') }}
@yield('adminlte_js')
<script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
</script>
</body>
</html>
