<template>
    <div class="h-screen login font-sans bg-cover">
        <div class="container mx-auto h-full flex flex-1 justify-center items-center">
            <div class="w-full max-w-lg">
                <div class="leading-loose">
                    <form class="max-w-xl m-4 p-10 bg-white rounded shadow-xl">
                        <p class="text-gray-800 font-medium text-center text-lg font-bold">Login</p>
                        <div class="">
                            <label class="block text-sm text-gray-00" for="username">Username</label>
                            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="username" name="username" type="text" required="" placeholder="User Name" aria-label="username">
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="password">Password</label>
                            <input class="w-full px-5  py-1 text-gray-700 bg-gray-200 rounded" id="password" name="password" type="text" required="" placeholder="*******" aria-label="password">
                        </div>
                        <div class="mt-4 items-center justify-between">
                            <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Login</button>
                            <a class="inline-block right-0 align-baseline  font-bold text-sm text-500 hover:text-blue-800" href="#">
                                Forgot Password?
                            </a>
                        </div>
                        <router-link class="inline-block right-0 align-baseline font-bold text-sm text-500 hover:text-blue-800" to="/register">
                            Not registered ?
                        </router-link>
                    </form>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {mapActions} from 'vuex';
export default {
    name:"login",
    data(){
        return {
            auth:{
                email:"",
                password:""
            },
            validationErrors:{},
            processing:false
        }
    },
    methods:{
        ...mapActions({
            signIn:'auth/login'
        }),
        async login(){
            this.processing = true
            await axios.post('/api/auth/login',this.auth).then(({data})=>{
                this.signIn(data)
            }).catch(({response})=>{
                if(response.status===422){
                    this.validationErrors = response.data.errors
                }else if(response.status === 401){
                    this.validationErrors = { errors: [
                            "Invalid Credentials"
                        ]
                    }
                }else {
                    this.validationErrors = {}
                }
            }).finally(() => {
                this.processing = false
            })
        },
    }
}
</script>
<style lang="css" scoped>
@import "../../../css/auth.css";
</style>

