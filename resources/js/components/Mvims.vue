<template>
    <div class="mvims" style="height:265px">
        <div class="mv text-center" v-for="mv in mvims" v-show="mv.show" :key="mv.id">
            <img :src="mv.img" class="mx-auto">
        </div>
    </div>
</template>
<script>
import { onMounted } from 'vue';
export default {
    props:['mvims'],
    setup(props){
        onMounted(()=>{
            let m=1;
            setInterval(() => {
                props.mvims.map((mv,idx)=>{
                    mv.show=(idx==m)?true:false
                    return mv
                })
                m=(m+1)%props.mvims.length
            }, 3000);
        })

        return { props }
    }
}
</script>