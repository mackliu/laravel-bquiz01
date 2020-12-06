<template>
    <div class="alert alert-danger w-50 m-auto" v-if="error.show">{{error.meg}}</div>
<form>

    <p class='text-center my-3'>帳號：<input class="border-bottom py-2" type="text" name="acc" v-model="acc"></p>
    <p class='text-center my-3'>密碼：<input class="border-bottom py-2" type="password" name="pw" v-model="pw"></p>
    <p class="text-center my-3">
        <input type="button" value="登入" class="btn btn-primary" @click="submit">
        <input type="reset" value="重置" class="btn btn-warning">
        </p>
</form>
</template>
<script>
import { reactive ,ref} from 'vue'
export default {
    setup(){
        const acc=ref('')
        const pw=ref('')
        const error=reactive({
            show:false,
            meg:""
        })
        const submit=()=>{
            console.log(acc.value,pw.value)
            axios.post('/api/login',{acc:acc.value,pw:pw.value})
                .then(res=>{
                    console.log(res.data)
                    if(res.data.error=='success'){
                        location.href='/admin'
                    }else{
                        error.show=true;
                        error.meg=res.data.meg;
                        acc.value='';
                        pw.value='';
                    }
                })
        }
        return { error ,acc,pw,submit}
    }
    
}
</script>