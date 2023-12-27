<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            Dashboard
        </template>
        <div class="">

                <div class="flex flex-wrap -mx-6">
                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                        <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                            <div class="flex-auto p-4">
                                <div class="flex flex-wrap">
                                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                        <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                                            Usuários
                                        </h5>
                                        <span class="font-semibold text-xl text-blueGray-700">{{ users }}</span>
                                    </div>
                                    <div class="relative w-auto pl-4 flex-initial">
                                        <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-500">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-sm text-indigo-500 mt-4">
                                    <Link :href="route('admin.users.index')" class="mr-2 text-sky-500">
                                        <i class="fas fa-link"></i> Gerenciar
                                    </Link>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                        <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                            <div class="flex-auto p-4">
                                <div class="flex flex-wrap">
                                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                        <h5 class="text-blueGray-400 uppercase font-bold text-xs">Admins</h5>
                                        <span class="font-semibold text-xl text-blueGray-700">{{ admins }}</span>
                                    </div>
                                    <div class="relative w-auto pl-4 flex-initial">
                                        <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500">
                                            <i class="fas fa-cogs"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-sm text-sky-500 mt-4">
                                    <Link :href="route('admin.admins.index')" class="mr-2 text-sky-500">
                                        <i class="fas fa-link"></i> Gerenciar
                                    </Link>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                        <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                            <div class="flex-auto p-4">
                                <div class="flex flex-wrap">
                                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                        <h5 class="text-blueGray-400 uppercase font-bold text-xs">Cursos</h5>
                                        <span class="font-semibold text-xl text-blueGray-700">{{ courses }}</span>
                                    </div>
                                    <div class="relative w-auto pl-4 flex-initial">
                                        <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500">
                                            <i class="fas fa-graduation-cap"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-sm text-sky-500 mt-4">
                                    <Link :href="route('admin.courses.index')" class="mr-2 text-sky-500">
                                        <i class="fas fa-link"></i> Gerenciar
                                    </Link>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                        <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                            <div class="flex-auto p-4">
                                <div class="flex flex-wrap">
                                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                        <h5 class="text-blueGray-400 uppercase font-bold text-xs">Pendentes</h5>
                                        <span class="font-semibold text-xl text-blueGray-700">{{ supports }}</span>
                                    </div>
                                    <div class="relative w-auto pl-4 flex-initial">
                                        <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-emerald-500">
                                            <i class="fas fa-comments"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-sm text-sky-500 mt-4">
                                    <Link :href="route('admin.supports.index')" class="mr-2 text-sky-500">
                                        <i class="fas fa-link"></i> Gerenciar
                                    </Link>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

        </div>


    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    users: Object,
    admins: Object,
    courses: Object,
    supports: Object,
})
</script>
