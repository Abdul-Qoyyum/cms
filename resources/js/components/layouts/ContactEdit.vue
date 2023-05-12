<template>
    <main class="bg-white-300 flex-1 p-3 mt-5 overflow-hidden">
        <div  class="mx-auto px-10 py-10 bg-white shadow-lg rounded-sm border border-gray-200" style="width: 95%;">
            <form autocomplete="false">
                <input autoComplete="false" name="hidden" type="text" style="display:none;">
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <div class="flex w-full justify-between">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Update Contact</h2>

                            <div role="status" v-if="process_page_load">
                                <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>

                        </div>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="col-span-full">
                                <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">Photo</label>
                                <div class="mt-2 flex items-center gap-x-3">
                                    <!-- custom avatar -->
                                    <div class="personal-image">
                                        <label class="label">
                                            <input type="file"
                                                   accept="image/*"
                                                   ref="file"
                                                   @change="selectImage"
                                            />
                                            <figure class="personal-figure">
                                                <img
                                                    :src="photo.previewImage" class="personal-avatar" alt="avatar">
                                                <figcaption class="personal-figcaption">
                                                    <img
                                                        src="https://raw.githubusercontent.com/ThiagoLuizNunes/angular-boilerplate/master/src/assets/imgs/camera-white.png"
                                                    >
                                                </figcaption>
                                            </figure>
                                        </label>
                                    </div>
                                    <!-- end custom avatar -->


                                    <div v-if="photo.currentImage" class="w-24">
                                        <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                                            <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" :style="{width: photo.progress + '%'}"> {{ photo.progress }}%</div>
                                        </div>

                                    </div>
                                    <div v-if="photo.message" class="alert alert-secondary" role="alert">
                                        {{ photo.message }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Contact Information</h2>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                                <div class="mt-2">
                                    <input type="text" name="name" id="name" :class="{'border border-red-500' : nameError}" @focusout="onFieldTouch($event)" v-model="fields.name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <p v-if="nameError" class="text-red-500 text-xs italic">{{ nameError }}</p>
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                                <div class="mt-2">
                                    <input id="email" name="email" type="email" :class="{'border border-red-500' : errors.email}" @focusout="onFieldTouch($event)" v-model="fields.email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <p v-if="errors.email" class="text-red-500 text-xs italic">{{ errors.email }}</p>
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="phone_number" class="block text-sm font-medium leading-6 text-gray-900">Phone Number</label>
                                <div class="mt-2">
                                    <input id="phone_number" name="phone_number" type="text"  :class="{'border border-red-500' : errors.phone_number}" @focusout="onFieldTouch($event)" v-model="fields.phone_number" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <p v-if="errors.phone_number" class="text-red-500 text-xs italic">{{ errors.phone_number }}</p>
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
                                <div class="mt-2">
                                    <select  id="category_id" name="category_id" v-model="fields.category_id" :class="{'border border-red-500' : errors.category_id}" @focusout="onFieldTouch($event)" class="inline-block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                        <option v-for="(category,i) in categories" :key="i" :value="category.id">{{category.name}}</option>
                                    </select>
                                    <div v-if="processing_category_load" class="inline-block ml-2 mt-1">
                                        <svg aria-hidden="true" role="status" class="inline-l w-4 h-4 mr-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
                                        </svg>
                                    </div>
                                </div>
                                <p v-if="errors.category_id" class="text-red-500 text-xs italic">{{ errors.category_id }}</p>
                            </div>



                            <div class="sm:col-span-3">
                                <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Street address</label>
                                <div class="mt-2">
                                    <input type="text" name="address" id="address" v-model="fields.address" :class="{'border border-red-500' : errors.address}" @focusout="onFieldTouch($event)" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <p v-if="errors.address" class="text-red-500 text-xs italic">{{ errors.address }}</p>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Country</label>
                                <div class="mt-2">
                                    <input type="text" name="country" id="country" v-model="fields.country"  :class="{'border border-red-500' : errors.country}" @focusout="onFieldTouch($event)" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <p v-if="errors.country" class="text-red-500 text-xs italic">{{ errors.country }}</p>
                            </div>

                            <div class="sm:col-span-2 sm:col-start-1">
                                <label for="city" class="block text-sm font-medium leading-6 text-gray-900">City</label>
                                <div class="mt-2">
                                    <input type="text" name="city" id="city" v-model="fields.city"  :class="{'border border-red-500' : errors.city}" @focusout="onFieldTouch($event)" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <p v-if="errors.city" class="text-red-500 text-xs italic">{{ errors.city }}</p>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="state" class="block text-sm font-medium leading-6 text-gray-900">State / Province</label>
                                <div class="mt-2">
                                    <input type="text" name="state" id="state" v-model="fields.state" :class="{'border border-red-500' : errors.state}" @focusout="onFieldTouch($event)" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <p v-if="errors.state" class="text-red-500 text-xs italic">{{ errors.state }}</p>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="zip_code" class="block text-sm font-medium leading-6 text-gray-900">ZIP / Postal code</label>
                                <div class="mt-2">
                                    <input type="text" name="zip_code" id="zip_code" v-model="fields.zip_code" :class="{'border border-red-500' : errors.zip_code}" @focusout="onFieldTouch($event)" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <p v-if="errors.zip_code" class="text-red-500 text-xs italic">{{ errors.zip_code }}</p>
                            </div>
                        </div>
                        <div class="w-100 mt-12">
                            <!-- google map component -->
                            <GoogleMap :lat="latitude" :long="longitude" :key="componentKey"/>
                            <div class="sm:col-span-2">
                                <label for="state" class="block text-sm font-medium leading-6 text-gray-900">Address</label>
                                <div class="mt-2">
                                    <input type="text" name="address" v-model="fields.address" id="autocomplete_update" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" @click="goToIndex" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                    <button :disabled="processing_contact_update" @click="updateContact" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 inline-flex items-center">
                        <svg v-if="processing_contact_update" aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                        </svg>
                        {{ processing_contact_update ? 'Loading...' : 'Update'}}
                    </button>
                </div>
            </form>
        </div>
    </main>
</template>
<style lang="css" scoped>
@import "../../../css/contact.css";
</style>
<script>
import GoogleMap from "../external/GoogleMap.vue";
import {
    cleanUpPreviouslyUploadedImage,
    fetchCategories,
    handleRequestException, initializePlacesAutoComplete,
    onFieldTouch, processImageUpload,
    selectImage,
    setFieldError, uploadProfile,
    validateForm,
    validEmail
} from "../../../utilis/global";
import Avatar from "../../../../public/src/images/3d-rendering-zoom-call-avatar.jpg";
import axios from "axios";
export default {
    name: 'contact-edit',
    computed:{
        nameError(){
            return this.errors.name
        },
        latitude(){
            return Number(this.coordinates.lat)
        },
        longitude(){
            return Number(this.coordinates.long)
        }
    },
    components: { GoogleMap },
    data(){
        return {
            photo: {
                currentImage: undefined,
                previewImage: Avatar,
                progress: 0,
                message: "",
            },
            fields: {
                name: "",
                email: "",
                phone_number: "",
                address: "",
                state: "",
                city: "",
                country: "",
                zip_code: "",
                category_id: "",
            },
            coordinates: {
                lat: 6.5243793,
                long: 3.3792057
            },
            errors:{
                name: "",
                email: "",
                phone_number: "",
                address: "",
                state: "",
                city: "",
                country: "",
                zip_code: "",
                category_id: "",
            },
            processing_category_load: false,
            processing_contact_update: false,
            process_page_load: true,
            categories: [],
            componentKey: 0
        }
    },
    async mounted() {
        await Promise.all([
            this.fetchCategories(),
            this.fetchContact()
        ]);
        this.initializePlacesAutoComplete("autocomplete_update");
        this.process_page_load = false;
    },
    methods: {
        initializePlacesAutoComplete,
        onFieldTouch,
        setFieldError,
        validEmail,
        validateForm,
        handleRequestException,
        selectImage,
        cleanUpPreviouslyUploadedImage,
        uploadProfile,
        processImageUpload,
        forceRerender(){
            this.componentKey += 1;
        },
        goToIndex(){
            this.$router.push({ name: 'contacts'});
        },
        async fetchContact(){
            try {
                const {contact_id} = this.$route.params
                const response = await axios.get(`/api/contact/${contact_id}`);
                const { data, success } = response.data;
                if(success === true){
                    this.fields = data.contact;
                    const {lat, long} = data.contact;
                    this.coordinates = { lat, long};
                    this.photo.previewImage = data.contact.photo;
                }
            }catch ({ response }) {
                this.handleRequestException(response);
            }
        },
        fetchCategories,
        setCoords(lat, long){
            this.coordinates = { lat, long}
        },
        async updateContact(){
            try {
                if(this.validateForm()){
                    this.processing_contact_update = true;
                    const response = await axios.put(`/api/contact/${this.$route.params.contact_id}`, {
                        ...this.fields,
                        photo: this.photo.previewImage,
                        ...this.coordinates,
                    });
                    const { success, data } = response.data;
                    if(success === true){
                        this.processing_contact_update = false;
                        this.fields = data.contact;
                        const {lat, long} = data.contact;
                        this.coordinates = { lat, long};
                        this.photo.previewImage = data.contact.photo;
                        this.$toast.success('Contact updated successfully');
                        this.$router.push({ name: 'contacts'});
                    }
                }
            }catch ({ response }) {
                this.processing_contact_update = false;
                this.handleRequestException(response);
            }
        }
    }
}
</script>
