import axios from 'axios';
import router from '@/router';

export default {
    namespaced: true,
    state:{
        auth: {
            email: "",
            password: ""
        },
        authenticated:false,
        _token: {},
        user:{}
    },
    getters:{
        authenticated(state){
            return state.authenticated;
        },
        user(state){
            return state.user;
        },
        _token(state){
            return state._token;
        }
    },
    mutations:{
        SET_AUTHENTICATED (state, value) {
            state.authenticated = value;
        },
        SET_USER (state, value) {
            state.user = value;
        },
        SET_TOKEN(state, value){
            state._token = value;
        }
    },
    actions:{
        login({commit}, data){
            commit('SET_TOKEN', data);
            return axios.post('/api/auth/me').then(({data})=>{
                commit('SET_USER',data)
                commit('SET_AUTHENTICATED',true)
                router.push({name:'dashboard'})
            }).catch(({response:{data}})=>{
                commit('SET_USER',{})
                commit('SET_AUTHENTICATED',false)
            })
        },
        logout({commit}){
            commit('SET_USER',{})
            commit('SET_AUTHENTICATED',false)
        },
        refreshToken({commit},data){
            console.log('Line 49 refresh gets called');
            console.log(data);
            commit('SET_TOKEN', data);
        }
    }
}
