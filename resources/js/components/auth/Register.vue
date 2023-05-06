<template>
    <div class="h-screen font-sans login bg-cover">
        <div class="container mx-auto h-full flex flex-1 justify-center items-center">
            <div class="w-full max-w-lg">
                <div class="leading-loose">
                    <form class="max-w-xl m-4 p-10 bg-white rounded shadow-xl">
                        <p class="text-gray-800 font-medium">Register</p>
                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="name">Name</label>
                            <input class="w-full px-2 py-1 text-gray-700 bg-gray-200 rounded" :class="{'border border-red-500' : errors.name.length > 0}" name="name" v-model="credentials.name" @focusout="onFieldTouch($event)" type="text" placeholder="Your Name" aria-label="Name">
                            <p v-if="errors.name.length > 0" class="text-red-500 text-xs italic">{{ errors.name }}</p>
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="email">Email</label>
                            <input class="w-full px-2  py-1 text-gray-700 bg-gray-200 rounded" :class="{'border border-red-500' : errors.email.length > 0}" @focusout="onFieldTouch($event)" v-model="credentials.email" name="email" type="email" placeholder="Your Email" aria-label="Email">
                            <p v-if="errors.email.length > 0" class="text-red-500 text-xs italic">{{ errors.email }}</p>
                        </div>
                        <div class="mt-2">
                            <label class=" block text-sm text-gray-600" for="password">Password</label>
                            <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" name="password" v-model="credentials.password" :class="{'border border-red-500' : errors.password.length > 0}" @focusout="onFieldTouch($event)" type="password" required="" placeholder="Enter Password" aria-label="Password">
                            <p v-if="errors.password.length > 0" class="text-red-500 text-xs italic">{{ errors.password }}</p>
                        </div>
                        <div class="mt-2">
                            <label class="hidden text-sm block text-gray-600" for="cus_email">Confirm Password</label>
                            <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" v-model="credentials.password_confirmation" :class="{'border border-red-500' : errors.password_confirmation.length > 0}" @focusout="onFieldTouch($event)" name="password_confirmation" placeholder="Confirm Password" type="password" required="" aria-label="password confirmation">
                            <p v-if="errors.password_confirmation.length > 0" class="text-red-500 text-xs italic">{{ errors.password_confirmation }}</p>
                        </div>

                        <div class="mt-4">

                            <button v-if="this.processing_registration" class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" disabled type="button">
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
                            <button v-else class="w-1/3 px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" @click="signUp" type="button">
                                Register
                            </button>
                        </div>

                        <router-link class="inline-block right-0 align-baseline font-bold text-sm text-500 hover:text-blue-800" to="/login">
                            Already have an account ?
                        </router-link>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

  import {mapActions} from "vuex";
  import {isEmpty} from "lodash";
  import axios from "axios";

  export default {
      name: 'Register',
      data(){
          return {
              credentials: {
                  name: '',
                  email: '',
                  password: '',
                  password_confirmation: ''
              },
              errors: {
                  name: '',
                  email: '',
                  password: '',
                  password_confirmation: '',
              },
              processing_registration: false
          }
      },
      methods: {
          ...mapActions([
              'auth/register'
          ]),
          async signUp(){
             if(this.validateForm()){
                 try {
                     this.processing_registration = true;
                     const response = await axios.post('/api/register',this.credentials);
                     this.processing_registration = false;
                     if (response.data.success === true){
                         this.$toast.success('Registration successful');
                         this.$router.push({ name: 'login'})
                     }
                 }catch ({ response}){
                     this.processing_registration = false;
                     const data = response.data.data;
                     if(!isEmpty(data)){
                         const errors = Object.values((data));
                         for (let i = 0; i < errors.length; i++){
                             this.$toast.warning(errors[i]);
                         }
                     }
                 }
             }
          },
          validEmail: function (email) {
              const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
              return re.test(email);
          },
          onFieldTouch(event){
              const { name, value } = event.target;
              if(value.trim().length > 0){
                  if(name !== 'email'){
                      this.setFieldError(name);
                  }else {
                      if(!this.validEmail(value)) {
                          this.setFieldError(name, 'Invalid email format')
                      }else{
                          this.setFieldError(name);
                      }
                  }
              }else {
                  this.setFieldError(name, `The ${name} field is required`);
              }
          },
          setFieldError(field, errorMsg = ''){
              this.errors[field] = errorMsg;
          },
          validateForm(){
              const details = Object.keys(this.credentials);
              let result = true;
              for (let i = 0; i < details.length; i++){
                  if(isEmpty(this.credentials[details[i]])){
                      this.setFieldError(details[i],`The field ${details[i]} is required`)
                      result = false;
                      break;
                  }
                  if(details[i] === 'email'){
                      if(!this.validEmail(this.credentials[details[i]])){
                          this.setFieldError(details[i],'Invalid email format')
                          result = false;
                          break;
                      }
                  }
              }
              return result;
          }
      }
  }
</script>
<style lang="css" scoped>
@import "../../../css/auth.css";
</style>
