<template>
    <div class="h-screen login font-sans bg-cover">
        <div class="container mx-auto h-full flex flex-1 justify-center items-center">
            <div class="w-full max-w-lg">
                <div class="leading-loose">
                    <form class="max-w-xl m-4 p-10 bg-white rounded shadow-xl">
                        <p class="text-gray-800 font-medium text-center text-lg font-bold">Login</p>
                        <div class="">
                            <label class="block text-sm text-gray-00" for="email">Email</label>
                            <input class="w-full px-2 py-1 text-gray-700 bg-gray-200 rounded" :class="{'border border-red-500' : emailError}" name="email" @focusout="onFieldTouch($event)" v-model="fields.email" type="email" placeholder="Email" aria-label="Email">
                            <p v-if="emailError" class="text-red-500 text-xs italic">{{ errors.email }}</p>
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="password">Password</label>
                            <input class="w-full px-2  py-1 text-gray-700 bg-gray-200 rounded mr" :class="{'border border-red-500' : passwordError}" name="password" @focusout="onFieldTouch($event)" v-model="fields.password" type="password" placeholder="*******" aria-label="password">
                            <p v-if="passwordError" class="text-red-500 text-xs italic">{{ errors.password }}</p>
                        </div>
                        <div class="mt-4 items-center justify-between">
                            <button v-if="this.processing_login" class="w-1/2 mr-4 px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" disabled type="button">
                                <svg class="w-5 h-4 mb-1 text-white animate-spin inline-block" fill="none"
                                     viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75"
                                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                          fill="currentColor"></path>
                                </svg>
                                Processing ...
                            </button>
                            <button v-else class="w-1/2 mr-4 px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" @click="login" type="button">Login</button>
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
import {handleRequestException, onFieldTouch, setFieldError, validateForm, validEmail} from "../../../utilis/global";
export default {
    name:"login",
    data(){
        return {
            fields:{
                email:"",
                password:""
            },
            validationErrors:{},
            errors: {
                email: '',
                password: '',
            },
            processing_login: false
        }
    },
    computed: {
        emailError(){
            return this.errors.email.length > 0;
        },
        passwordError(){
            return this.errors.password.length > 0;
        }
    },
    methods:{
        ...mapActions({
            signIn:'auth/login'
        }),
        onFieldTouch,
        setFieldError,
        validEmail,
        validateForm,
        handleRequestException,
        async login(){
            try {
                if(this.validateForm){
                    this.processing_login = true;
                    const response = await axios.post('/api/login',this.fields);
                    const { data, success } = response.data;
                    if(success === true){
                        const { user, token } = data;
                        this.signIn({token, user});
                        this.$router.push({ name: 'home'});
                    }
                }
            }catch ({ response }) {
                this.processing_login = false;
                this.handleRequestException(response);
            }
        },
    }
}
</script>
<style lang="css" scoped>
@import "../../../css/auth.css";
</style>

