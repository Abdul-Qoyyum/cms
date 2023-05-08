import { createApp } from 'vue';
// import { createApp } from 'vue/dist/vue.esm-bundler';
import ToastPlugin from 'vue-toast-notification';
import axios from "axios";
import Router from '@/router';
import store from '@/store';


import './bootstrap';
import '../css/app.css'
import '../css/styles.css';
import '../css/all.css';
import 'vue-toast-notification/dist/theme-sugar.css';

import setupAxios from "./api/api";


axios.defaults.timeout = 10000;
setupAxios(axios, store);


createApp({}).use(Router)
    .use(store)
    .use(ToastPlugin,{
        position: 'top-right'
    })
    .mount('#app');
