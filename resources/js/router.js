import { createRouter,createWebHistory } from 'vue-router';
import Mvims from './components/Mvims';
import News from './components/News';
import Login from './components/Login';

const routes=[
    {path:'/',components:{default:News,mvim:Mvims},props:{default:{route:'index'}}},
    {path:'/news',component:News,props:{route:'news'}},
    {path:'/login',component:Login},
]

 const router=createRouter({
     history:createWebHistory(),
     routes,
 })

 export default router