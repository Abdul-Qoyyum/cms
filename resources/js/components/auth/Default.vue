<template>
    <main>
        <router-view></router-view>
    </main>
</template>
<script>
import axios from "axios";
export default {
    name: 'auth',
    data(){
        return {}
    },
    mounted() {
        axios.get('/sanctum/csrf-cookie');
    }
}
</script>
<style lang="css" scoped>
@import "../../../css/styles.css";
</style>

