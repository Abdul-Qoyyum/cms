import { createApp } from 'vue';
import axios from "axios";
import Router from '@/router';
import store from '@/store';


import './bootstrap';
import '../css/app.css'

import setupAxios from "./api/api";


axios.defaults.timeout = 10000;
setupAxios(axios, store);


const app = createApp({}).use(Router)
    .use(store)
    .mount('#app');
