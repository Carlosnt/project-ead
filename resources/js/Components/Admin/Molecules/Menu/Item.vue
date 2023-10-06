<template>
   
        <Link 
            :class="[{'bg-gray-800 text-white': routeIsActive()},'flex items-center text-base text-gray-400 font-semibold hover:text-white gap-x-3 mt-1 py-2 px-8']"
            :href="link">
            <component :is="heroIcons[icon]" v-if="icon.length" :class="[{'rotate-180': submenu.open},'h6 w-6 chrink-0']"/>
            {{ description }}
        </Link>
   
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import * as heroIcons from '@heroicons/vue/24/outline';
import { reactive } from 'vue';

const props = defineProps({
    icon: String,
    description: String,
    link: String,
    isActive: String|Array
});

const submenu = reactive({
    open: false,
});

const routeIsActive = () => {  
   const routes = (!Array.isArray(props.isActive) ? props.isActive.toString().split(',') : props.isActive); 

   let currentRouteFind = false;
    routes.forEach(function (item) {
       if(route().current(item) === true){
            currentRouteFind = true;
       }
    });
   return currentRouteFind;
};

</script>