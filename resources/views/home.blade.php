@extends("layouts.layout")

@section("main")
<div class="menu col-3">
    <div class="text-center py-2 border-bottom my-1">主選單區</div>
    <ul class="list-group">
        <li class="list-group-item list-group-item-action py-1 bg-warning position-relative menu" v-for="menu in menus"  @mouseover='menu.show=true' @mouseleave="menu.show=false">
            <a :href="menu.href">@{{ menu.text }}</a>

            <ul class="list-group position-absolute w-75 subs" style="z-index:99;left:100px;top:25px" v-if="menu.subs.length>0" v-show="menu.show">
                <li class="list-group-item list-group-item-action bg-success py-1" v-for="sub in menu.subs">
                    <a :href="sub.href"  style="color:white">@{{ sub.text }}</a>
                </li>
            </ul>
        </li>
    
    </ul>

    <div class="viewer">
        進站總人數：@{{site.total}}
    </div>
</div>
<div class="main col-6">
    <marquee>@{{ site.ads  }}</marquee>

@yield('center')
</div>
<div class="right col-3">
@auth
<a href='/admin' class="btn btn-success py-3 w-100 my-2">返回管理({{ $user->acc }})</a>
@endauth
@guest
<a href='/login' class="btn btn-primary py-3 w-100 my-2">管理登入</a>
@endguest
<div class="text-center py-2 border-bottom my-1">校園映像區</div>
<div class="up" @click="switchImg('up')"></div>

    <div class="img" v-for="img in images.data" v-show="img.show"><img :src="img.img" class=" mx-auto"></div>

<div class="down" @click="switchImg('down')"></div>
</div>


@endsection
