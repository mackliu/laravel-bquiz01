@extends("layouts.layout")

@section("main")
<div class="menu col-3">
    <menus :menus="menus" :total="site.total"></menus>
</div>
<div class="main col-6">
    <marquee>@{{ site.ads  }}</marquee>

@yield('center')
</div>
<div class="right col-3">
    <login-btn :auth="auth" ></login-btn>

    <images :images="images" title="校園風情"></images>

</div>


@endsection
