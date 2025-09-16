import { createRouter, createMemoryHistory, createWebHashHistory } from "vue-router";
import Home from '../components/home.vue';
import Courses from '../components/courses.vue';
import About from '../components/about.vue';
import Contact from '../components/contact.vue';
import Facility from '../components/facility.vue';
const routes = [
     
    // {
    //     path: '/clcst', name:'home', component: () => import("../components/home.vue")
    // },
    {
        path: '/Home', name:'Home', component: Home
    },
    {
        path: '/Courses', name:'Courses', component: Courses
    },
    {
        path: '/About', name:'About', component: About
    },
    {
        path: '/Contact', name:'Contact', component: Contact
    },
    {
        path: '/Facility', name:'Facility', component: Facility
    }
];


const router = createRouter({
    history:createWebHashHistory(),
    routes
})

export default router;
