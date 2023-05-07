<template>
    <!-- dashboard home -->
    <main class="bg-white-300 flex-1 p-3 mt-5 overflow-hidden">
<!--        <div class="flex flex-col">-->
<!--            <p>Hello {{ user.name }}</p>-->
<!--        </div>-->
        <!-- table -->
        <div class="mx-auto bg-white shadow-lg rounded-sm border border-gray-200" style="width: 95%;">
            <header class="px-5 py-4 border-b border-gray-100">
                <div class="flex justify-between items-center">
                    <div class="font-semibold text-gray-800">Contacts</div>
                    <div class="pt-2 relative mx-auto text-gray-600" style="width: 40%">
                        <input class="border-2 border-gray-300 bg-white w-full h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                               type="search" name="search" placeholder="Search">
                        <button type="submit" class="absolute right-0 top-0 mt-5 mr-4">
                            <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                                 viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                                 width="512px" height="512px">
                            <path
                                d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                          </svg>
                        </button>
                    </div>
                    <!-- dropdown -->

                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-grey hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Select Category <svg class="w-3 h-3 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign out</a>
                            </li>
                        </ul>
                    </div>
                    <!-- end dropdown -->

                    <!-- export pdf button -->
                    <button type="button" class="text-black ml-4 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium mt-2 rounded-lg text-sm rounded-lg px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Export CSV</button>
                    <!-- end export pdf button -->

                </div>

            </header>
            <div class="p-3">
                <div class="overflow-x-auto" style="min-height: 250px">
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                        <tr>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Name</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Email</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Spent</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-center">Country</div>
                            </th>

                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-center">Country</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-center">Country</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-center">Country</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-center">Actions</div>
                            </th>

                        </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                        <tr>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img class="rounded-full" src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg" width="40" height="40" alt="Alex Shatov"></div>
                                    <div class="font-medium text-gray-800">Alex Shatov</div>
                                </div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left">alexshatov@gmail.com</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left font-medium text-green-500">$2,890.66</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-lg text-center">??</div>
                            </td>

                            <td class="p-2 whitespace-nowrap">
                                <div class="text-lg text-center">??</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-lg text-center">??</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-lg text-center">??</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="relative px-5 pt-2 w-full text-center">
                                    <button class="focus:ring-2 rounded-md focus:outline-none" data-id="1" @click="dropdownFunction($event)" role="button" aria-label="option">
                                        <svg class="dropbtn" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path d="M4.16667 10.8332C4.62691 10.8332 5 10.4601 5 9.99984C5 9.5396 4.62691 9.1665 4.16667 9.1665C3.70643 9.1665 3.33334 9.5396 3.33334 9.99984C3.33334 10.4601 3.70643 10.8332 4.16667 10.8332Z" stroke="#9CA3AF" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M10 10.8332C10.4602 10.8332 10.8333 10.4601 10.8333 9.99984C10.8333 9.5396 10.4602 9.1665 10 9.1665C9.53976 9.1665 9.16666 9.5396 9.16666 9.99984C9.16666 10.4601 9.53976 10.8332 10 10.8332Z" stroke="#9CA3AF" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M15.8333 10.8332C16.2936 10.8332 16.6667 10.4601 16.6667 9.99984C16.6667 9.5396 16.2936 9.1665 15.8333 9.1665C15.3731 9.1665 15 9.5396 15 9.99984C15 10.4601 15.3731 10.8332 15.8333 10.8332Z" stroke="#9CA3AF" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </button>
                                    <div class="dropdown-content bg-white shadow w-24 absolute right-0 mr-6" :class="{ 'hidden': !dropdownShow}">
                                        <div tabindex="0" class="focus:outline-none focus:text-indigo-600 text-xs w-full hover:bg-indigo-700 py-4 px-4 cursor-pointer hover:text-white">
                                            <p>Edit</p>
                                        </div>
                                        <div tabindex="0" class="focus:outline-none focus:text-indigo-600 text-xs w-full hover:bg-indigo-700 py-4 px-4 cursor-pointer hover:text-white">
                                            <p>Delete</p>
                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- table -->
    </main>
    <!-- end dashboard home -->
</template>

<script>
import { initFlowbite } from 'flowbite'
export default {
    name:"contact-list",
    data(){
        return {
            user:this.$store.state.auth.user,
            dropdownShow: false,
            filters:{
                page: 1,
                recordsPerPage: 10,
                searchParam: "",
                orderBy: "created_at",
                direction: "desc",
                status: "",
            },
            contacts: []
        }
    },
    mounted() {
        initFlowbite();
    },
    methods: {
        dropdownFunction(event){
            const { id } = event.currentTarget.dataset;
            console.log(id);
            this.dropdownShow = !this.dropdownShow;
        },
        fetchResource(){
            const url = `/customers/team-members/paginate?customer_id=${customerId}&search=${searchParam}&page=${page}&recordsPerPage=${recordsPerPage}&orderBy=${orderBy}&direction=${direction}&_token=${_token}`;
            // if(status !== "undefined"){
            //     url += `&status=${status}`;
            // }

        }
    }
}
</script>
