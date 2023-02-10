import { createRouter, createWebHistory } from 'vue-router'
import loginForm from "./components/LoginForm.vue";
import diaryHandler from "./components/DiaryHandler.vue";
import registerForm from "./components/RegisterForm.vue";

export default createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            component: diaryHandler,
        },
        {
            path: '/login',
            component: loginForm,
        },
        {
            path: '/register',
            component: registerForm,
        },
    ],
})
