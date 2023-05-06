<template>
    <!-- dashboard home -->
    <main class="bg-white-300 flex-1 p-3 overflow-hidden">
        <div class="flex flex-col">
            <p>Hello {{ user.name }}</p>
        </div>
    </main>
    <!-- end dashboard home -->
</template>

<script>
export default {
    name:"contact-list",
    data(){
        return {
            user:this.$store.state.auth.user
        }
    },
}
</script>
