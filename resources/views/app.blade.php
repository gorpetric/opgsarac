<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=no'>
    <meta name='description' content='@yield("description", "OPG Sarac web stranica")'>
    <meta name='author' content='OPG Sarac, Spomenka Sarac'>
    <meta name='csrf-token' content='{{ csrf_token() }}'>
    <title>OPG Sarac - @yield('title')</title>
    <link rel='stylesheet' href='{{ asset("css/app.css") }}'>
    <link rel='shortcut icon' href='{{ asset("img/favicon.ico") }}'>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-89542592-2', 'auto');
        ga('send', 'pageview');
    </script>
    <script>
        window.OPGSarac = {
            csrfToken: '{{ csrf_token() }}',
            user: {
                id: {{ Auth::check() ? Auth::user()->id : 'null' }},
                authenticated: {{ Auth::check() ? 'true' : 'false' }}
            }
        }
    </script>
</head>
<body>
<div class='wrapper'>
@include('partials.nav')
<div class='container'>
@yield('content')
<footer>Copyright &copy; 2016-2017 OPG Sarac</footer>
</div>
</div>
<script src='{{ asset("js/app.js") }}'></script>
@include('partials.swal')
</body>
</html>
