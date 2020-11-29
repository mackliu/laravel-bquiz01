<template>
    <div style="position:relative;width:100%;height:35px;overflow:hidden" ref="marquee">
        <div style="position:absolute;width:max-content" ref="content">
            <slot></slot>
        </div>
    </div>
</template>
<script>
export default {

        mounted(){
        let marquee=this.$refs.marquee.offsetWidth;
        let content=this.$refs.content.offsetWidth;
        this.$refs.content.style.right=(0-content)+"px";
        let pos=0-content;
        setInterval(() => {
            pos++;
            this.$refs.content.style.right=pos+"px";
            if(pos>=marquee){
                this.$refs.content.style.right=(0-content)+"px";
                pos=0-content
            }
        }, 15);
    }
}
</script>
