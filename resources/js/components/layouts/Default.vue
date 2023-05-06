<template>
    <button type="button" @click="logout">Logout</button>
    <!-- content section -->
    <router-view></router-view>
    <!-- content section -->
</template>
<!--<style lang="css" scoped>-->
<!--@import "../../../../public/assets/css/dashboard-view.css";-->
<!--</style>-->
<script>
import {mapActions} from 'vuex';
import axios from "axios";
// import Logo from '../../../../public/assets/images/sol-cms-logo.png'
export default {
    name:"default-layout",
    data(){
        return {
            user:this.$store.state.auth.user,
        }
    },
    mounted() {
        axios.get('/sanctum/csrf-cookie');
    }
    methods:{
        ...mapActions({
            signOut:"auth/logout"
        }),
        async logout(){
            this.signOut();
            this.$router.push({name:"login"})
            // await axios.post('/api/auth/logout').then(({data})=>{
            //     this.signOut()
            //     this.$router.push({name:"login"})
            // })
        }
    }
}
</script>

