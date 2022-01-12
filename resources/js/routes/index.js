import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home';
import Register from '../pages/auth/Register';
import Login from '../pages/auth/Login';
import Dashboard from '../pages/Dashboard';

import Contacts from '../components/Contacts';
import CreateContact from '../components/Contacts/CreateContactComponent.vue';
import SingleContact from '../components/Contacts/SingleContactComponent';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'contacts',
        path: '/contacts',
        component: Contacts
    },
    {
        name: 'new-contact',
        path: '/new-contact',
        component: CreateContact
    },
    {
        name: 'single-contact',
        path: '/contacts/show/:id',
        component: SingleContact
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
