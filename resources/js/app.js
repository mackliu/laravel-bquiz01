require('./bootstrap');
import { createApp } from 'vue';
import Marquee from "./components/Marquee.vue"
import Images from "./components/Images.vue"
import Mvims from "./components/Mvims.vue"
import News from "./components/News.vue"
import Menus from "./components/Menus.vue"
import LoginBtn from "./components/LoginBtn.vue"
import Login from "./components/Login.vue"

const app={
    components:{
        'marquee':Marquee,
        'images':Images,
        'mvims':Mvims,
        'news':News,
        'menus':Menus,
        'login-btn':LoginBtn,
        'login':Login
    },
    data(){
        return {
           menus:null,
           images:null,
           mvims:null,
/*            news:null , */
            site:null,
            auth:null,
            show:false
        }
    },
    mounted(){
        axios.get("/api")
    .then((res)=>{
       console.log(res.data)
        this.site=res.data.site;
        this.menus=res.data.menus;
        this.images=res.data.images;
/*         this.news=res.data.news; */
        this.mvims=res.data.mvims;
        this.auth=res.data.auth;
        this.show=true;
    })
    

    }
}

createApp(app).mount('#app')

