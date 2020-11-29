<template>
    <div class="news" style="height:265px">
    <div class="text-center py-2 border-bottom my-1">{{title}}

           <!--  <a class="float-right" :href="news.more.href" v-if="news.more.show">More...</a> -->

    </div>
    <ul class="list-group" style="position:relative">

<!--         <li class="list-group-item list-group-item-action p-1 new"
            style="position:unset"  
            v-for="(ns,idx) in news"  
            @mouseover="ns.show=true" 
            @mouseleave="ns.show=false" 
            :key="ns.id">
                {{(idx+1) + ". " + ns.short }}
            <div style="border:1px solid orange;box-shadow:1px 1px 5px #ccc;background:yellow;width:75%;position:absolute;top:0;right:0;font-size:87%;padding:10px;" v-show="ns.show" v-html="ns.text"></div>    
        </li> -->

    </ul>

    </div>
    
</template>

<script>
import {onMounted, ref } from 'vue';

export default {
    props:['route'],
    setup(props){
       
        const title=ref('更多最新消息')

        onMounted(()=>{
            switch(props.route){
                case "index":
                    title.value="最新消息區"
                    axios.get("/api/news/index")
                        .then((res)=>{
                            console.log(res)
                        })
                break;
                case "news":
                    title.value="更多最新消息區"
                    axios.get("api/news/all")
                    .then((res)=>{ 
                            console.log(res)
                        })
                break;
            }
        })

        return { title,props }
    }
}
</script>