<template>
<li class="list-none">
    <div :class="[{'bg-gray-800 text-white' : submenu.open}, 'text-gray-400 hover:text-white hover:b-gray-800 transition duration-1000 ease-in-out']">
        <button type="button"
            :class="['w-full  group flex items-center justify-between text-sm leading-6 font-semibold mt-1 py-2 px-6']" 
            v-on:click="() => {submenu.open = !submenu.open}">
                
                <span class="flex gap-x-3 text-base mx-3">
                    <component :is="heroIcons[icon]" v-if="icon.length" class="h6 w-6 chrink-0"/>
                        {{  description }}
                </span>
                        
                <span>
                    <component :is="heroIcons['ChevronDownIcon']" :class="[{'rotate-180': submenu.open},'h4 w-4 chrink-0 transition-all']"/>
                </span>   
                        
        </button>
        <transition
                enter-to-class="transition duration-300 ease-linear"
                enter-from-class="max-h-0 opacity-25"
                leave-from-class="opacity-100 max-h-xl"
                leave-to-class="max-h-0 opacity-0">
        <ul v-if="submenu.open" 
        class="w-full flex flex-col pl-10 pb-6 gap-y-1 border-t border-gray-700">
            <slot />
        </ul>
        </transition>
    </div>
</li>

</template>

<script setup>
import { reactive } from 'vue';
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

import * as heroIcons from '@heroicons/vue/24/outline';

const props = defineProps({
        icon: String,
        description: String,
        isActive: String | Array,         
});
   
const submenu = reactive({
    open: false,
});

const routes = (!Array.isArray(props.isActive) ? props.isActive.toString().split(',') : props.isActive);
   
routes.forEach(function (item) {
    if(route().current(item) === true){
        submenu.open = true;
    }
});
   
</script>
