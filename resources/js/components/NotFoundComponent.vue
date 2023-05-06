<template>
    <div>
        <p>Oops, we could not find the path you're looking for {{$route.params.pathMatch}} :)</p>
    </div>
</template>
<script>
export default {
    name: 'notFound',
}
</script>
