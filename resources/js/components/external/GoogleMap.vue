<template>
    <GoogleMap  class="map" :api-key="apiKey" style="width: 100%; height: 500px" :center="center" :zoom="15">
        <Marker :options="{ position: center }" />
    </GoogleMap>
</template>
<script>
import {computed, defineComponent, ref, watch} from "vue";
import { GoogleMap, Marker } from "vue3-google-map";

export default defineComponent({
    components: { GoogleMap, Marker },
    props:{
      lat: Number,
      long: Number,
    },
    data(){
        return{
            apiKey: import.meta.env.VITE_GOOGLE_MAP_API_KEY,
            center: { lat: 0, lng: 0 }
        }
    },
    setup(props) {
        const center = { lat: Number(props.lat), lng: Number(props.long) }
        return { center }
    },
});
</script>
<style scoped>
.map {
    position: relative;
    width: 100%;
    height: 500px;
}

.map::after {
    position: absolute;
    content: '';
    width: 1px;
    height: 100%;
    top: 0;
    left: 50%;
    background: red;
}

input[type='number'] {
    width: 200px;
    margin-top: 20px;
    margin-left: 10px;
}
</style>
