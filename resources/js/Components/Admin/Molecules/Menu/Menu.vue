<template>
<nav class="mt-10" x-data="{ isMultiLevelMenuOpen: false }">        

            <Item 
                :icon="'HomeIcon'" 
                :description="'Dashboard'" 
                :is-active="'admin.dashboard'" 
                :link="route('admin.dashboard')"                
            />

            <nav-link :href="route('admin.users.index')" :active="route().current('admin.users.index')">
                <i class="fa-solid fa-users mr-2"></i>
                Usuários
            </nav-link>

            <SubMenu 
                :icon="'NewspaperIcon'" 
                :description="'Blog'" 
                :is-active="['admin.blog.post.*','admin.blog.category.*']" 
                :whenComponentActive="'Admin/Blog/Posts/List'" 
                >
            <SubMenuItem 
                :description="'Ver Artigos'" 
                :is-active="'admin.blog.post.*'" 
                :link="route('admin.blog.posts.index')" 
                />

            <SubMenuItem 
                :description="'Ver Categorias'" 
                :is-active="'admin.blog.category.*'" 
                :link="route('admin.blog.categories.index')" 
                />
            </SubMenu>

            <nav-link >
                <template #icon>
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                         stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                    </svg>
                </template>
                About us
            </nav-link>
            

            <a class="flex items-center mt-4 py-2 px-6 text-gray-100" href="#" @click="showingTwoLevelMenu = !showingTwoLevelMenu">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"></path>
                </svg>
                <span class="mx-3">Two-level menu</span>
            </a>
            <transition
                enter-to-class="transition-all duration-300 ease-in-out"
                enter-from-class="max-h-0 opacity-25"
                leave-from-class="opacity-100 max-h-xl"
                leave-to-class="max-h-0 opacity-0">
                <div v:if="route('admin.blog.post.index')" v-show="showingTwoLevelMenu">
                    <ul class="overflow-hidden p-2 mx-4 mt-2 space-y-2 text-sm font-medium text-white bg-gray-700 bg-opacity-50 rounded-md shadow-inner"
                        aria-label="submenu">
                        <li class="px-2 py-1 transition-colors duration-150">
                            <Link class="w-full" :href="route('admin.dashboard')">Child menu</Link>
                        </li>
                    </ul>
                </div>
            </transition>
        </nav>
</template>

<script setup>

import NavLink from '@/Components/NavLink.vue';
import SubMenu from '@/Components/Admin/Molecules/Menu/SubMenu/SubMenu.vue';
import SubMenuItem from '@/Components/Admin/Molecules/Menu/SubMenu/SubMenuItem.vue';
import Item from '@/Components/Admin/Molecules/Menu/Item.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue'
import { NewspaperIcon, ChevronDownIcon, ChevronUpIcon} from '@heroicons/vue/24/outline';

export default {
   components: {      
       NavLink,
       Link,
       SubMenu,
       SubMenuItem,
       Item,
       NewspaperIcon,
       ChevronDownIcon,
    }
};

</script>