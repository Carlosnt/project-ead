<template>
    <div :class="$page.props.showingMobileMenu ? 'block' : 'hidden'" @click="$page.props.showingMobileMenu = false"
         class="fixed inset-0 z-20 bg-black opacity-50 transition-opacity lg:hidden"></div>

    <div :class="$page.props.showingMobileMenu ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
         class="overflow-y-auto fixed inset-y-0 left-0 z-30 w-64 bg-gray-900 transition duration-300 transform lg:translate-x-0 lg:static lg:inset-0">
        <div class="flex justify-center items-center mt-8">
            <div class="flex items-center">
                <svg class="w-12 h-12" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M364.61 390.213C304.625 450.196 207.37 450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398 281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4 153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128 334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597 281.6C409.597 320.911 394.601 360.22 364.61 390.213Z"
                        fill="#4C51BF" stroke="#4C51BF" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"/>
                    <path
                        d="M201.694 387.105C231.686 417.098 280.312 417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8 313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2 230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8 179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z"
                        fill="white"/>
                </svg>

                <span class="mx-2 text-2xl font-semibold text-white">Dashboard</span>
            </div>
        </div>

        <nav class="mt-10" x-data="{ isMultiLevelMenuOpen: false }">
            
            <Item 
                :icon="'HomeIcon'" 
                :description="'Dashboard'" 
                :is-active="'admin.dashboard'" 
                :link="route('admin.dashboard')"                
            />

            <Item 
                :icon="'UserIcon'" 
                :description="'Administradores'" 
                :is-active="'admin.admins.*'" 
                :link="route('admin.admins.index')"                
            />

            <Item 
                :icon="'UsersIcon'" 
                :description="'Usuários'" 
                :is-active="'admin.users.*'" 
                :link="route('admin.users.index')"                
            />
            <Item 
                :icon="'TagIcon'" 
                :description="'Categorias'" 
                :is-active="'admin.categories.*'" 
                :link="route('admin.categories.index')"                
            />
            <SubMenu 
                :icon="'AcademicCapIcon'" 
                :description="'Cursos'" 
                :is-active="['admin.courses.*','admin.cocategories.*']" 
                :whenComponentActive="'Admin/Courses/Index'" 
                >
                <SubMenuItem 
                    :description="'Aulas'" 
                    :is-active="'admin.lessons*'" 
                    :link="route('admin.lessons.index')"
                />                 
                 <SubMenuItem 
                    :description="'Cursos'" 
                    :is-active="'admin.courses*'" 
                    :link="route('admin.courses.index')"
                /> 
                <SubMenuItem 
                    :description="'Modulos'" 
                    :is-active="'admin.modules.*'" 
                    :link="route('admin.modules.index')"
                /> 
            </SubMenu>

           
            

            <Item 
                :icon="'ChatBubbleOvalLeftIcon'" 
                :description="'Suportes'" 
                :is-active="'admin.supports.*'" 
                :link="route('admin.supports.index')"                
            />

            <Item 
                :icon="'AcademicCapIcon'" 
                :description="'Suportes'" 
                :is-active="'admin.supports.*'" 
                :link="route('admin.supports.index')"                
            />
            
        </nav>
    </div>

</template>

<script>
import NavLink from '@/Components/NavLink.vue';
import SubMenu from '@/Components/Admin/Molecules/Menu/SubMenu/SubMenu.vue';
import SubMenuItem from '@/Components/Admin/Molecules/Menu/SubMenu/SubMenuItem.vue';
import Item from '@/Components/Admin/Molecules/Menu/Item.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue'
import { NewspaperIcon, ChevronDownIcon} from '@heroicons/vue/24/outline';

export default {
    components: {
    NavLink,
    Link,
    SubMenu,
    SubMenuItem,
    Item,
    NewspaperIcon,
    ChevronDownIcon,
    },
}

</script>

