@extends('home')

@section("center")
<div class="mvims" style="height:265px">

        <div class="mv text-center" v-for="mv in mvims" v-show="mv.show">
            <img :src="mv.img" class="mx-auto">
        </div>

</div>
<div class="news" style="height:265px">
<div class="text-center py-2 border-bottom my-1">最新消息區
    
        <a class="float-right" :href="newss.more.href" v-if="newss.more.show">More...</a>

</div>
<ul class="list-group" style="position:relative">

    <li class="list-group-item list-group-item-action p-1 new" style="position:unset"  v-for="news in newss.data"  @mouseover="news.show=true" @mouseleave="news.show=false">
            @{{ news.short }}
        <div style="border:1px solid orange;box-shadow:1px 1px 5px #ccc;background:yellow;width:75%;position:absolute;top:0;right:0;font-size:87%;padding:10px;" v-show="news.show" v-html="news.text"></div>    
    </li>

</ul>

</div>
@endsection



@section("script")

<script>

const app={
    data(){

        const site=JSON.parse('{!! json_encode($site) !!}');
        const menus=JSON.parse('{!! $menus !!}');
        const images=JSON.parse('{!! json_encode($images) !!}');
        const mvims=JSON.parse('{!! $mvims !!}');
        const newss=JSON.parse('{!! json_encode($news) !!}');

        return {
           menus,images,mvims,newss , site
        }
    },
    methods:{
        switchImg(type){
          let  imgs=this.images.data;
          let  page=this.images.page;

            switch(type){
                case 'up':
                    page=(page>0)?page-1:page;
                break;
                case 'down':
                    page=(page<imgs.length-3)?++page:page;
                break;
            }

            imgs.map((img,idx)=>{
                if(idx>=page && idx<=page+2){
                    img.show=true;
                }else{
                    img.show=false;
                }
                return img;
            })

            this.images.data=imgs
            this.images.page=page

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