// import { createApp } from 'vue';
import { createApp } from 'vue/dist/vue.esm-bundler';
import axios from "axios";
import Router from '@/router';
import store from '@/store';


import './bootstrap';
import '../css/app.css'
import '../css/styles.css';

import setupAxios from "./api/api";


axios.defaults.timeout = 10000;
setupAxios(axios, store);


const app = createApp({}).use(Router)
    .use(store)
    .mount('#app');
