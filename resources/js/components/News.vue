<template>
    <div class="news" style="height:265px">
    <div class="text-center py-2 border-bottom my-1">{{title}}

            <router-link class="float-right" :to="more.href" v-if="more.show">More...</router-link>

    </div>
    <ul class="list-group" style="position:relative">

        <li class="list-group-item list-group-item-action p-1 new"
            style="position:unset"  
            v-for="(ns,idx) in news"  
            @mouseover="ns.show=true" 
            @mouseleave="ns.show=false" 
            :key="ns.id"
            >
                {{(paginate.start+idx) + ". " + ns.short }}
            <div style="border:1px solid orange;box-shadow:1px 1px 5px #ccc;background:yellow;width:75%;position:absolute;top:0;right:0;font-size:87%;padding:10px;" v-show="ns.show" v-html="ns.text"></div>    
        </li>

    </ul>
    <div class="d-flex justify-content-center p-2" v-if="paginate.show">
        <a class="d-block p-1 border" href="#" @click="page(paginate.prev)" v-if="paginate.prev>0"> &lt; </a>
        <a class="d-block p-1 border" href="#" @click="page(p)" v-for="(p,idx) in paginate.links" :key="idx">{{ p }}</a>
        <a class="d-block p-1 border" href="#" @click="page(paginate.next)" v-if="paginate.next>0"> &gt; </a>

    </div>
    </div>
    
</template>

<script>
import {onMounted, ref ,reactive, watch} from 'vue';

export default {
    props:['route'],
    setup(props){
       
        const title=ref('更多最新消息')
        const news=ref(new Array())
        const more=ref({})
        const paginate=reactive({
            'total':0,
            'div':5,
            'links':new Array(),
            'items':new Array(),
            'prev':0,
            'next':0,
            'pages':0,
            'start':1,
            'show':false

        })

        const page=(p)=>{
            paginate.prev=(p-1>0)?p-1:0;
            paginate.next=(p+1<=paginate.pages)?p+1:0;
            paginate.start=(p-1)*paginate.div+1;
            news.value=paginate.items.filter((item,idx)=>{
                if(idx+1>=paginate.start && idx+1<=p*paginate.div){
                    return item;
                }
            })
        }

        const chageRoute=()=>{
            switch(props.route){
                case "index":
                    title.value="最新消息區"
                    paginate.show=false
                break;
                case "news":
                    title.value="更多最新消息區"
                break;
            }
            axios.get(`api/news/${props.route}`)
                    .then((res)=>{ 
                        news.value=res.data.news;
                        more.value=res.data.more;
                        if(res.data.news.length>5){
                            paginate.total=res.data.news.length;
                            paginate.pages=Math.ceil(paginate.total/paginate.div);
                            paginate.items=res.data.news;
                            paginate.links.length=0;
                            for(let i=1;i<=paginate.pages;i++){
                                paginate.links.push(i)
                            }
                            paginate.show=true
                            page(1)
                        }
                    })
        }

        watch(
            props,
            (old,newer)=>{
                chageRoute();
            }
        )

        onMounted(()=>{
            chageRoute();
        })

        return { title,props ,news,more,paginate,page}
    }
}
</script>