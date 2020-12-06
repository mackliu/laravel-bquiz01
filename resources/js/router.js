import { createRouter,createWebHistory } from 'vue-router';
import Mvims from './components/Mvims';
import News from './components/News';
import Login from './components/Login';

const routes=[
    {path:'/',component:Mvims},
    {path:'/news',component:News},
    {path:'/login',component:Login},
]

 const router=createRouter({
     history:createWebHistory(),
     routes,
 })

 export default router