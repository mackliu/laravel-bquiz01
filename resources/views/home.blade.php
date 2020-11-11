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
        進站總人數：@{{total}}
    </div>
</div>
<div class="main col-6">
    <marquee >@{{ adstr }}</marquee>

@yield('center')
</div>
<div class="right col-3">
@auth
<a href='/admin' class="btn btn-success py-3 w-100 my-2">返回管理({{ $user->acc }})</a>
@endauth
@guest
<a href='/login' class="btn btn-primary py-3 w-100 my-2">管理登入</a>
@endguest
<div class="text-center py-2 border-bottom my-1">主選單區</div>
<div class="up"></div>
@isset($images)

    @foreach($images as $img)

        <div class="img"><img src="{{asset('storage/'.$img->img)}}" class=" mx-auto"></div>

    @endforeach

@endisset
<div class="down"></div>
</div>


@endsection

@section("script")

<script>




    $(".menu").hover(
        function(){
            $(this).children('.subs').show()
        },
        function(){
            $(this).children('.subs').hide()
        }
    )


let num=$(".img").length;
let p=0;
$(".img").each((idx,dom)=>{
    if(idx<3){
        $(dom).show()
    }
})

$(".up,.down").on("click",function(){
    $(".img").hide()
    switch($(this).attr('class')){
        case 'up':
         p=(p>0)?--p:p;

        break;
        case 'down':
         p=(p<num-3)?++p:p;
        break;
    }

    $(".img").each((idx,dom)=>{
        if(idx>=p && idx<=p+2){
            $(dom).show()
        }
    })

})

$(".mv").eq(0).show()
let mvNum=$(".mv").length;
let now=0;
setInterval(() => {
    $(".mv").hide()
    ++now;
    $(".mv").eq(now%mvNum).show();

}, 3000);

$('.new').hover(
    function(){
        $(this).children('div').show()
    },
    function(){
        $(this).children('div').hide()
    }


)
const app={
    data(){
        const adstr='{{ $ads }}';
        const bottom='{{ $bottom}}';
        const titleImg="{{ asset('storage/'.$title->img) }}";
        const title='{{$title->text}}';
        const total={{ $total }};
        const menus=JSON.parse('{!! $menus !!}');

        return {
           adstr,titleImg,title,bottom,total,menus
        }
    }
}

Vue.createApp(app).mount('#app')


</script>



@endsection