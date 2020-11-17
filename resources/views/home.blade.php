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
<div class="text-center py-2 border-bottom my-1">校園映像區</div>
<div class="up" @click="switchImg('up')"></div>

    <div class="img" v-for="img in images" v-show="img.show"><img :src="img.img" class=" mx-auto"></div>

<div class="down" @click="switchImg('down')"></div>
</div>


@endsection

@section("script")

<script>

const app={
    data(){
        const adstr='{{ $ads }}';
        const bottom='{{ $bottom}}';
        const titleImg="{{ asset('storage/'.$title->img) }}";
        const title='{{$title->text}}';
        const total={{ $total }};
        const menus=JSON.parse('{!! $menus !!}');
        const images=JSON.parse('{!! $images !!}');
        const ip=0;
        const mvims=JSON.parse('{!! $mvims !!}');
        const newss=JSON.parse('{!! $news !!}');
        @isset($more)
        const more='{{ $more }}';
        @endisset
        return {
           adstr,titleImg,title,bottom,total,menus,images,ip,
            mvims,newss,@isset($more) more @endisset
        }
    },
    methods:{
        switchImg(type){
            switch(type){
                case 'up':
                    this.ip=(this.ip>0)?--this.ip:this.ip;
                break;
                case 'down':
                    this.ip=(this.ip<this.images.length-3)?++this.ip:this.ip;
                break;
            }

            this.images.map((img,idx)=>{
                if(idx>=this.ip && idx<=this.ip+2){
                    img.show=true;
                }else{
                    img.show=false;
                }
                return img;
            })

        }
    },
    mounted(){
        let m=1;
        setInterval(() => {
            
            this.mvims.map((mv,idx)=>{
                mv.show=(idx==m)?true:false
                return mv
            })
        
            m=(m+1)%this.mvims.length

        }, 3000);
    }
}

Vue.createApp(app).mount('#app')


</script>



@endsection