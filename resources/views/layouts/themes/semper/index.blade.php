<!doctype html>
@include('themes.'.env('TEMPLETE_NAME').'.head')
<body>
@include('themes.'.env('TEMPLETE_NAME').'.header.preloader')
@include('themes.'.env('TEMPLETE_NAME').'.header.scrolltotop')
@include('themes.'.env('TEMPLETE_NAME').'.header.index')
@yield('content')
@include('themes.'.env('TEMPLETE_NAME').'.footer')
@include('themes.'.env('TEMPLETE_NAME').'.scripts')
</body>
</html>