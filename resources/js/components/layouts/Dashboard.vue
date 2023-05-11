<template>
    <!-- dashboard home -->
    <main class="bg-white-300 flex-1 p-3 overflow-hidden">

        <div class="flex flex-col">
            <!-- Stats Row Starts Here -->
            <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
                <div class="shadow-lg bg-red-vibrant border-l-8 hover:bg-red-vibrant-dark border-red-vibrant-dark mb-2 p-2 md:w-1/4 mx-2">
                    <div class="p-4 flex flex-col">
                        <a href="#" class="no-underline text-white text-2xl">
                            {{analytics.work}}
                        </a>
                        <a href="#" class="no-underline text-white text-lg">
                            Work
                        </a>
                    </div>
                </div>

                <div class="shadow bg-info border-l-8 hover:bg-info-dark border-info-dark mb-2 p-2 md:w-1/4 mx-2">
                    <div class="p-4 flex flex-col">
                        <a href="#" class="no-underline text-white text-2xl">
                            {{analytics.family}}
                        </a>
                        <a href="#" class="no-underline text-white text-lg">
                            Family
                        </a>
                    </div>
                </div>

                <div class="shadow bg-warning border-l-8 hover:bg-warning-dark border-warning-dark mb-2 p-2 md:w-1/4 mx-2">
                    <div class="p-4 flex flex-col">
                        <a href="#" class="no-underline text-white text-2xl">
                            {{analytics.personal}}
                        </a>
                        <a href="#" class="no-underline text-white text-lg">
                            Personal
                        </a>
                    </div>
                </div>

                <div class="shadow bg-success border-l-8 hover:bg-success-dark border-success-dark mb-2 p-2 md:w-1/4 mx-2">
                    <div class="p-4 flex flex-col">
                        <a href="#" class="no-underline text-white text-2xl">
                            {{analytics.friends}}
                        </a>
                        <a href="#" class="no-underline text-white text-lg">
                            Friends
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Stats Row Ends Here -->
            <!-- Progress Bar -->
            <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2 mt-2">
                <div class="rounded overflow-hidden shadow bg-white mx-2 w-full pt-2">
                    <div class="px-6 py-2 border-b border-light-grey">
                        <div class="font-bold text-xl">Progress Among Projects</div>
                    </div>
                    <div class="">
                        <div class="w-full">

                            <div class="shadow w-full bg-grey-light">
                                <div class="bg-blue-500 text-xs leading-none py-1 text-center text-white"
                                     :style="{width: analytics.work_percentage+'%'}">{{analytics.work_percentage}}%
                                </div>
                            </div>


                            <div class="shadow w-full bg-grey-light mt-2">
                                <div class="bg-teal-500 text-xs leading-none py-1 text-center text-white"
                                     :style="{width: analytics.family_percentage +'%'}">{{analytics.family_percentage}}%
                                </div>
                            </div>


                            <div class="shadow w-full bg-grey-light mt-2">
                                <div class="bg-orange-500 text-xs leading-none py-1 text-center text-white"
                                     :style="{width: analytics.friends_percentage + '%'}">{{analytics.friends}}%
                                </div>
                            </div>


                            <div class="shadow w-full bg-grey-300 mt-2">
                                <div class="bg-red-800 text-xs leading-none py-1 text-center text-white"
                                     :style="{width: analytics.personal_percentage+'%'}">{{analytics.personal}}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- end dashboard home -->
</template>

<script>
import axios from "axios";
import {handleRequestException} from "../../../utilis/global";

export default {
    name:"dashboard",
    data(){
        return {
            user:this.$store.state.auth.user,
            process_load: true,
            analytics: {
                work: 0,
                personal: 0,
                friends: 0,
                family: 0,
                work_percentage: 0,
                personal_percentage: 0,
                friends_percentage: 0,
                family_percentage: 0,
            },
        }
    },
    mounted() {
        this.fetchDashboardAnalytics();
    },
    methods:{
        handleRequestException,
        async fetchDashboardAnalytics(){
            try {
                this.process_load = true;
                const response = await axios.get('/api/dashboard-analytics');
                const { data } = response.data;
                for(let [key, value] of Object.entries(data)){
                    this.analytics[key] = value;
                }
                const total = this.analytics.work + this.analytics.friends + this.analytics.personal + this.analytics.family;
                this.analytics.work_percentage = Math.ceil((this.analytics.work / total) * 100);
                this.analytics.friends_percentage = Math.ceil((this.analytics.friends / total) * 100);
                this.analytics.personal_percentage = Math.ceil((this.analytics.personal / total) * 100);
                this.analytics.family_percentage = Math.ceil((this.analytics.family / total) * 100);
                this.process_load = false;
            }catch ({ response }){
                this.process_load = false;
                this.handleRequestException(response);
            }

        }
    }
}
</script>
