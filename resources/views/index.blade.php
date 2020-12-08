<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>科技大學校園資訊系統</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="container" id="app">
        <div class="header w-100" v-if="show">
            <a href="/" :title="site.title.text"><img :src="site.title.img" class="w-100"></a>
        </div>
        <div class="main d-flex" style="height:568px" v-if="show">
            <div class="menu col-3">
                <menus :menus="menus" :total="site.total"></menus>
            </div>
            <div class="main col-6">
                <marquee>@{{ site.ads  }}</marquee>
                <router-view :mvims="mvims" name='mvim'></router-view>
                <router-view></router-view>
            </div>
            <div class="right col-3">
                <login-btn :auth="auth"></login-btn>

                <images :images="images" title="校園風情"></images>

            </div>
        </div>
        <div class="footer w-100" v-if="show">
            <div class="text-center" style="height:100px;line-height:100px;background:yellow">@{{site.bottom}}</div>
        </div>
    </div>
    <div id="modal"></div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <script src="{{asset('./js/app.js')}}"></script>
</body>

</html>