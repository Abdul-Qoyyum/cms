<template>
    <!-- dashboard home -->
    <main class="bg-white-300 flex-1 p-3 mt-5 overflow-hidden">
        <div class="mx-auto bg-white shadow-lg rounded-sm border border-gray-200" style="width: 95%;">
            <header class="px-5 py-4 border-b border-gray-100">
                <div class="flex justify-between items-center">
                    <div class="font-semibold text-gray-800">Contacts</div>
                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown_filter" class="text-grey ml-4 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">{{filters.recordsPerPage}}<svg class="w-3 h-3 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdown_filter" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow md:w-16  dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <button type="button" @click="filterResource(10)" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">10</button>
                                <button type="button" @click="filterResource(25)" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">25</button>
                                <button type="button" @click="filterResource(50)" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">50</button>
                                <button type="button" @click="filterResource(100)" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">100</button>
                            </li>
                        </ul>
                    </div>

                    <div class="pt-2 relative mx-auto text-gray-600" style="width: 40%">
                        <input class="border-2 border-gray-300 bg-white w-full h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                               type="search" name="search" v-model="filters.searchParam" placeholder="Search by name or email">
                        <button type="button" @click="searchResource" class="absolute right-0 top-0 mt-5 mr-4">
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

                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-grey hover:bg-blue-800 w-32 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button"><span class="inline-block w-24 ml-0">{{filters.category_name}}</span> <svg class="w-4 h-3 ml-6" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-32  dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <button type="button" @click="sortByCategory('All')" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">All</button>
                            </li>
                            <li v-for="(category, i) in categories" :key="i">
                                <button type="button" @click="sortByCategory(category.name,category.id)" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{category.name}}</button>
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
                <div class="overflow-x-auto" style="min-height: 470px">
                    <div v-if="processing" class="block flex items-center justify-center" style="min-height: 470px">
                        <div
                            class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] text-primary motion-reduce:animate-[spin_1.5s_linear_infinite]"
                            role="status">
                      <span
                          class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]"
                      >Loading...</span
                      >
                        </div>
                    </div>
                    <table v-else class="table-auto w-full" >
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                        <tr>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Name</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Email</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Phone</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">City</div>
                            </th>

                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Country</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">State</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Category</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Zip Code</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-center">Actions</div>
                            </th>

                        </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                        <tr v-for="(contact, i) in contacts" :key="i">
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img class="rounded-full" :src="contact.photo" width="40" height="40" alt="Alex Shatov"></div>
                                    <div class="font-medium text-gray-800">{{contact.name}}</div>
                                </div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left">{{contact.email}}</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left font-medium text-green-500">{{contact.phone_number}}</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left font-medium">{{contact.city}}</div>
                            </td>

                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left font-medium">{{contact.country}}</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left font-medium">{{contact.state}}</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left font-medium">{{contact?.category?.name}}</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left font-medium">{{contact.zip_code}}</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <router-link :to="'contact-edit/' + contact.id" class="cursor-pointer rounded p-1 mx-1 text-green-500">
                                    <i class="fas fa-eye"></i></router-link>
                                <a class="cursor-pointer rounded p-1 mx-1 text-yellow-500">
                                    <i class="fas fa-edit"></i></a>
                                <a class="cursor-pointer rounded p-1 mx-1 text-red-500">
                                    <i class="fas fa-trash"></i>
                                </a>
                        </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- pagination -->

            <div class="flex w-full justify-end pr-3 pb-2">
                <nav class="inline-block"  aria-label="Page navigation example">
                    <ul class="inline-flex items-center -space-x-px">
                        <li v-if="passedFirstPage">
                            <button type="button" @click="goToPage(pagination.previous_page)" class="block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Previous</span>
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                            </button>
                        </li>

                        <li v-for="(page, i) in pagination.pages" :key="i">
                            <button type="button" @click="goToPage(page)" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{page}}</button>
                        </li>

                        <li v-if="hasReachedLastPage">
                            <button type="button" @click="goToPage(pagination.next_page)" class="block px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Next</span>
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- end pagination section -->
        </div>
    </main>
    <!-- end dashboard home -->
</template>

<script>
import { initFlowbite } from 'flowbite';

export default {
    name:"contact-list",
    computed: {
      hasReachedLastPage(){
          return this.pagination.current_page < this.pagination.noOfPages;
      },
      passedFirstPage(){
          return this.pagination.current_page > 1;
      }
    },
    data(){
        return {
            user:this.$store.state.auth.user,
            filters:{
                recordsPerPage: 10,
                searchParam: "",
                orderBy: "created_at",
                direction: "desc",
                category_id: "",
                category_name: "Sort By",
            },
            pagination: {
                noOfPages: 1,
                current_page: 1,
                pages: [],
                next_page: 2,
                previous_page: 1,
            },
            contacts: [],
            categories: [],
            processing: false
        }
    },
    mounted() {
        initFlowbite();
        Promise.all([
            this.fetchResource(),
            this.fetchCategories(),
        ]);
    },
    methods: {
        getPages(noOfPages){
            const list = [];
            for (let i = 1; i <= noOfPages; i++){
                list.push(i);
            }
            return list;
        },
        goToPage(page){
            this.pagination.current_page = page;
            this.fetchResource()
        },
        sortByCategory(category_name = "Sort By", category_id = "",){
          this.filters.category_id = category_id;
          this.pagination.current_page = 1;
          this.filters.category_name = category_name;
          this.fetchResource();
        },
        filterResource(limit){
          this.filters.recordsPerPage = limit;
          this.pagination.current_page = 1;
          this.fetchResource();
        },
        searchResource(){
            if(this.filters.searchParam.length > 0){
                this.fetchResource();
            }
        },
        async fetchCategories(){
            const response = await axios.get('/api/categories');
            const { data } = response.data;
            this.categories = data;
        },
        async fetchResource(){
            try {
                const { searchParam,recordsPerPage,orderBy,direction, category_id} = this.filters;
                const {current_page} = this.pagination;
                const url = `/api/contacts?search=${searchParam}&page=${current_page}&recordsPerPage=${recordsPerPage}&orderBy=${orderBy}&direction=${direction}&category_id=${category_id}`;
                this.processing = true;
                const response = await axios.get(url);
                const { data, success } = response.data;
                if(success === true){
                    console.log('Line 183');
                    console.log(data);
                    const { page, noOfPages } = data;
                    this.contacts = data.data;
                    this.pagination.current_page = page;
                    this.pagination.pages = this.getPages(noOfPages);
                    if(page < noOfPages){
                        this.pagination.next_page = page + 1;
                    }
                    if(page > 1){
                        this.pagination.previous_page = page - 1;
                    }
                    this.pagination.noOfPages = noOfPages;
                    this.filters.searchParam = searchParam;
                    this.filters.recordsPerPage = recordsPerPage;
                    this.filters.orderBy = orderBy;
                    this.filters.direction = direction;
                    this.filters.category_id = category_id;
                    this.processing = false;
                }


            }catch (error){
                this.processing = false;
                console.log('Line 178');
                console.log(error);
            }
        }
    }
}
</script>
