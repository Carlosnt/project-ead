<template>
        <li>
            <Link :class="[{'text-white': routeIsActive()},'text-sm text-gray-400 font-semibold hover:text-white flex gap-x-3 mb-3 mt-3']"
            :href="link">
                <MinusSmallIcon class="h3 w-3 chrink-0"/> 
                {{ description }}
            </Link>
        </li>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { ChevronRightIcon, MinusSmallIcon } from '@heroicons/vue/24/outline';

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

const props = defineProps({
    description: String,
    link: String,
    isActive: true
});
</script>