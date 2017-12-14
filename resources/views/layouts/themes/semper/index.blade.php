<!doctype html>
@include('themes.'.env('TEMPLATE_NAME').'.head')
<body>
@include('themes.'.env('TEMPLATE_NAME').'.header.preloader')
@include('themes.'.env('TEMPLATE_NAME').'.header.scrolltotop')
@include('themes.'.env('TEMPLATE_NAME').'.header.index')
@yield('content')
@include('themes.'.env('TEMPLATE_NAME').'.footer')
@include('themes.'.env('TEMPLATE_NAME').'.scripts')
</body>
</html>