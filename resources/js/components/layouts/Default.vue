<template>
    <!-- dashboard main section -->
    <div class="mx-auto bg-grey-400">
        <!--Screen-->
        <div class="min-h-screen flex flex-col">
            <!--Header Section Starts Here-->
            <header class="bg-nav">
                <div class="flex justify-between">
                    <div class="p-1 mx-3 inline-flex items-center">
                        <i class="fas fa-bars pr-2 text-white" @click="sidebarToggle"></i>
                        <h1 class="text-white p-2">Logo</h1>
                    </div>
                    <div class="p-1 flex flex-row items-center cursor-pointer" @click="profileToggle">
                        <img class="inline-block h-8 w-8 rounded-full" src="https://avatars0.githubusercontent.com/u/4323180?s=460&v=4" alt="">
                        <div class="text-white p-2 no-underline hidden md:block lg:block">{{ user.name }}</div>
                        <div id="ProfileDropDown" class="rounded hidden shadow-md bg-white absolute pin-t mr-1 pin-r" style="margin-top: 110px;display: none;cursor: pointer;">
                            <ul class="list-reset">
                                <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">My account</a></li>
                                <li><hr class="border-t mx-2 border-grey-ligght"></li>
                                <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light" @click="logout">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
            <!--/Header-->

            <div class="flex flex-1">
                <!--Sidebar-->
                <aside id="sidebar" class="bg-side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">

                    <ul class="list-reset flex flex-col">
                        <li class=" w-full h-full py-3 px-2 border-b border-light-border bg-white">
                            <router-link to="/dashboard"
                               class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fas fa-tachometer-alt float-left mx-2"></i>
                                Dashboard
                                <span><i class="fas fa-angle-right float-right"></i></span>
                            </router-link>
                        </li>
                        <li class=" w-full h-full py-3 px-2 border-b border-light-border bg-white">
                            <router-link to="/dashboard/contacts"
                               class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fas fa-tachometer-alt float-left mx-2"></i>
                                Contact(s)
                                <span><i class="fas fa-angle-right float-right"></i></span>
                            </router-link>
                        </li>
                    </ul>

                </aside>
                <!--/Sidebar-->
                <!--Main-->
                <router-view></router-view>
                <!--/Main-->
            </div>
            <!--Footer-->
            <footer class="bg-grey-darkest text-white p-2">
                <div class="flex flex-1 mx-auto">&copy; My Design</div>
            </footer>
            <!--/footer-->
        </div>
    </div>
    <!-- end dashboard main section -->
</template>
<script>
import {mapActions} from 'vuex';
import axios from "axios";
export default {
    name:"default-layout",
    data(){
        return {
            user:this.$store.state.auth.user,
        }
    },
    mounted() {
        axios.get('/sanctum/csrf-cookie');
        if (document.querySelector('.modal-wrapper'))
        {
            // Open the modal
            document.querySelectorAll('.modal-trigger').forEach(btn => {
                this.toggleModal('add', btn);
            });

            // close the modal
            document.querySelectorAll('.close-modal').forEach(btn => {
                this.toggleModal('remove', btn);
            });
        }
    },
    methods:{
        ...mapActions({
            signOut:"auth/logout"
        }),
        sidebarToggle(){
            const sidebar = document.getElementById('sidebar');
            if (sidebar.style.display === "none") {
                sidebar.style.display = "block";
            } else {
                sidebar.style.display = "none";
            }
        },
        profileToggle(){
            const profileDropdown = document.getElementById('ProfileDropDown');
            if (profileDropdown.style.display === "none") {
                profileDropdown.style.display = "block";
            } else {
                profileDropdown.style.display = "none";
            }
        },
        toggleModal(action, elem_trigger){
            elem_trigger.addEventListener('click', function () {
                if (action == 'add') {
                    let modal_id = this.dataset.modal;
                    document.getElementById(`${modal_id}`).classList.add('modal-is-open');
                } else {
                    // Automaticlly get the opned modal ID
                    let modal_id = elem_trigger.closest('.modal-wrapper').getAttribute('id');
                    document.getElementById(`${modal_id}`).classList.remove('modal-is-open');
                }
            });
        },
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

