<template>
    <!-- dashboard home -->
    <main class="bg-white-300 flex-1 p-3 overflow-hidden">

        <div class="flex flex-col">
            <!-- Stats Row Starts Here -->
            <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
                <div class="shadow-lg bg-red-vibrant border-l-8 hover:bg-red-vibrant-dark border-red-vibrant-dark mb-2 p-2 md:w-1/4 mx-2">
                    <div class="p-4 flex flex-col">
                        <a href="#" class="no-underline text-white text-2xl">
                            $244
                        </a>
                        <a href="#" class="no-underline text-white text-lg">
                            Total Sales
                        </a>
                    </div>
                </div>

                <div class="shadow bg-info border-l-8 hover:bg-info-dark border-info-dark mb-2 p-2 md:w-1/4 mx-2">
                    <div class="p-4 flex flex-col">
                        <a href="#" class="no-underline text-white text-2xl">
                            $199.4
                        </a>
                        <a href="#" class="no-underline text-white text-lg">
                            Total Cost
                        </a>
                    </div>
                </div>

                <div class="shadow bg-warning border-l-8 hover:bg-warning-dark border-warning-dark mb-2 p-2 md:w-1/4 mx-2">
                    <div class="p-4 flex flex-col">
                        <a href="#" class="no-underline text-white text-2xl">
                            900
                        </a>
                        <a href="#" class="no-underline text-white text-lg">
                            Total Users
                        </a>
                    </div>
                </div>

                <div class="shadow bg-success border-l-8 hover:bg-success-dark border-success-dark mb-2 p-2 md:w-1/4 mx-2">
                    <div class="p-4 flex flex-col">
                        <a href="#" class="no-underline text-white text-2xl">
                            500
                        </a>
                        <a href="#" class="no-underline text-white text-lg">
                            Total Products
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
                                     style="width: 45%">45%
                                </div>
                            </div>


                            <div class="shadow w-full bg-grey-light mt-2">
                                <div class="bg-teal-500 text-xs leading-none py-1 text-center text-white"
                                     style="width: 55%">55%
                                </div>
                            </div>


                            <div class="shadow w-full bg-grey-light mt-2">
                                <div class="bg-orange-500 text-xs leading-none py-1 text-center text-white"
                                     style="width: 65%">65%
                                </div>
                            </div>


                            <div class="shadow w-full bg-grey-300 mt-2">
                                <div class="bg-red-800 text-xs leading-none py-1 text-center text-white"
                                     style="width: 75%">75%
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
export default {
    name:"dashboard",
    data(){
        return {
            user:this.$store.state.auth.user
        }
    },
}
</script>
