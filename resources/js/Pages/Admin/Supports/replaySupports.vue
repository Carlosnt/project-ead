<template>
    <Head title="Suportes" />

    <AuthenticatedLayout>
        <template #header>
            Suportes
        </template>
        <div class="border-b border-gray-200 pb-5 sm:flex sm:items-center sm:justify-between">
            <h3 class="text-lg leading-6 text-gray-900">Detalhes do Suportes</h3>
            <div class="py-3 float-right">
                <Link :href="route('admin.supports.index')"
                    :class="'px-4 py-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800'">
                    <i class="fa-solid fa-arrow-left"></i> Voltar
                </Link>
            </div>
        </div>

        <div class="flex-1 p:2 sm:p-6 justify-between flex flex-col h-screen w-full rounded-lg bg-white mb-2">
            <div class="flex sm:items-center justify-between py-3 border-b-2 border-gray-200">
                <div class="relative flex items-center space-x-4">
                    <div class="relative">
                        <span class="absolute text-green-500 right-0 bottom-0">
                        <svg width="20" height="20">
                            <circle cx="8" cy="8" r="8" fill="currentColor"></circle>
                        </svg>
                        </span>
                    <img :src="support.user.photo" alt="" class="w-10 sm:w-16 h-10 sm:h-16 rounded-full">

                    </div>
                    <div class="flex flex-col leading-tight">
                        <div class="text-2xl mt-1 flex items-center">
                        <span class="text-gray-700 mr-3">{{  support.user.name }}</span>
                        </div>
                        <span class="text-lg text-gray-600">{{  support.user.email }}</span>
                    </div>
                </div>
            </div>
            <div class="w-full text-bold flex items-center mt-3 mb-3">
                {{ support.name }}
            </div>
            <div id="messages" class="flex flex-col space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
                <div v-for="reply in support.replies" :key="reply.id">
                    <div class="chat-message">
                        <div v-if="reply.user != null ">
                            <div v-if="reply.user.id === support.user.id" :class="reply.user_id === support.user.id ? 'flex items-end mb-2':'flex items-end mb-2'">
                                <div :class="reply.user_id === support.user.id ? 'flex flex-col space-y-2 text-xs max-w-xs mx-2 order-2 items-start': 'flex flex-col space-y-2 text-xs max-w-xs mx-2 order-1 items-start'">
                                <div><span :class="reply.user_id === support.user.id ? 'px-4 py-2 rounded-lg inline-block rounded-bl-none bg-gray-300 text-gray-600' : 'px-4 py-2 rounded-lg inline-block rounded-br-none bg-blue-600 text-white' " v-html="reply.htmldescription"></span></div>
                                </div>
                                <img :src="reply.user.photo" alt="My profile" :class="reply.user_id === support.user.id ? 'order-1' + 'w-6 h-6 rounded-full' : 'order-2 '+ 'w-6 h-6 rounded-full'">
                            </div>
                        </div>
                        <div v-else="reply.user.id === support.user.id" :class="reply.user_id === support.user.id ? 'flex items-end mb-2':'flex items-end justify-end mb-2'">
                            <div :class="reply.user_id === support.user.id ? 'flex flex-col space-y-2 text-xs max-w-xs mx-2 order-2 items-start': 'flex flex-col space-y-2 text-xs max-w-xs mx-2 order-1 items-start'">
                                <div><span :class="reply.user_id === support.user.id ? 'px-4 py-2 rounded-lg inline-block rounded-bl-none bg-gray-300 text-gray-600' : 'px-4 py-2 rounded-lg inline-block rounded-br-none bg-blue-600 text-white' " v-html="reply.htmldescription"></span></div>
                            </div>
                            <img :src="reply.admin.photo" alt="My profile" :class="reply.user_id === support.user.id ? 'order-1' + 'w-6 h-6 rounded-full' : 'order-2 '+ 'w-6 h-6 rounded-full'">
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="flex-1 p:2 sm:p-6 flex flex-col w-full rounded-lg bg-white mb-2">

                <div class="flex w-full">
                    <form @submit.prevent="$event => form.post(route('admin.replies.store', props.support.id))" class="w-full">
                        <Editor type="text" v-model="form.description" class="w-full focus:outline-none focus:placeholder-gray-400 text-gray-600 placeholder-gray-600 pl-12 bg-gray-200 rounded-md py-3"></Editor>
                        <input type="hidden" v-model="form.support_id">
                        <InputError :message="form.errors.description" class="mt-2"></InputError>

                        <div class=" items-center inset-y-0 hidden sm:flex">
                            <button type="submit" class="mt-5 inline-flex items-center justify-center rounded-lg px-4 py-3 transition duration-500 ease-in-out text-white bg-blue-500 hover:bg-blue-400 focus:outline-none">
                                <span class="font-bold">Responder</span>
                                <PaperAirplaneIcon class="h-6 w-6 text-white-500" />
                            </button>
                        </div>
                    </form>
                </div>

        </div>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Editor from '@/Components/Editor.vue'
import { Head,Link,useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import InputError from "@/Components/InputError.vue";
import { PaperAirplaneIcon } from '@heroicons/vue/24/outline';

const props = defineProps({
    support: {type:Object}
})

const form = useForm({
    user_id: '',
    admin_id: '',
    support_id: props.support.id,
    description: ''
});

</script>
