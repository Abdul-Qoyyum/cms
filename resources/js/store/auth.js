import axios from 'axios';
import router from '@/router';

export default {
    namespaced: true,
    state:{
        user:{},
        authenticated:false,
        _token: {},
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
            const { token, user } = data;
            commit('SET_TOKEN', token);
            commit('SET_USER',user);
            commit('SET_AUTHENTICATED',true);
        },
        logout({commit}){
            commit('SET_USER',{})
            commit('SET_AUTHENTICATED',false);
            router.push({name: "login"})
        },
        refreshToken({commit},data){
            commit('SET_TOKEN', data);
        }
    }
}
