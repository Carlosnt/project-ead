<template>
    <Head title="Cadastro Módulo" />

    <AuthenticatedLayout>
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                <a :href="route('admin.dashboard')" class="inline-flex items-center text-sm font-medium text-slate-950 dark:text-gray-400 dark:hover:text-white">
                   <i class="fa fa-home mr-3"></i>
                    Home
                </a>
                </li>
                
               
                <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Novo Módulo</span>
                </div>
                </li>
            </ol>
        </nav>

        <div class="border-b border-gray-200 pb-5 sm:flex sm:items-center sm:justify-between">
            
            <h3 class="text-lg leading-6 text-gray-900">Cadastro de Módulo</h3>

            <div class="py-3 float-right">
                <div class="rounded-md bg-indigo-600 px-4 py-2 text-center text-sm text-white hover:bg-indigo-500">
                    <Link :href="route('admin.courses.index')">
                        <span class="flex items-center gap-x-3 px-1 py-0.5">
                            <PlusIcon class="w-5 h-5 shrink-0"/> 
                           Voltar
                        </span>
                    </Link>
                    
                </div>
            </div>           
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <form @submit.prevent="$event => form.post(route('admin.courses.store'))">
                    
                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Informações de Cadastro</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">Coloque as informações sobre o curso que quer cadastrar.</p>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nome</label>
                            <div class="mt-2">
                            <input type="text" id="name" v-model="form.name" autocomplete="Seu nome aqui" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            <InputError :message="form.errors.name" class="mt-2"></InputError>
                            </div>
                        </div>
                    
                        <div class="sm:col-span-3">
                            <label for="category_id" class="block text-sm font-medium leading-6 text-gray-900">Categorias</label>
                            <div class="mt-2">
                            <select id="category_id" v-model="form.category_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option disabled value="">Selecione uma categoria...</option>
                                <option v-for="cat in categories" :value="cat.id">
                                    {{ cat.name }}
                                </option>
                    
                            </select>
                             <InputError :message="form.errors.category_id" class="mt-2"></InputError>
                            </div>
                        </div>
                    
                        <div class="mt-9 space-y-4">
                            <div class="relative flex gap-x-3">
                                <div class="flex h-6 items-center">
                                <input id="avaialble" v-model="form.avaialble" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                </div>
                                <div class="text-sm leading-6">
                                <label for="avaialble" class="font-medium text-gray-900">Publicado</label>                                
                                </div>
                            </div>          
                        </div>
                        
                        <div class="sm:col-span-10">
                            <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Descrição</label>
                            <div class="mt-2">
                            <Editor id="description"
                            v-model="form.description"                          
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></Editor>
                            <InputError :message="form.errors.description" class="mt-2"></InputError>
                            </div>
                        </div>
                        
                        </div>
                    </div>                  

                    <div class="mt-6 flex items-center justify-end gap-x-6">                  
                        <PrimaryButton :disabled="form.processing">
                        <i class="fa-solid fa-save"></i> Cadastrar
                    </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Editor from '@/Components/Editor.vue'
import { Head, useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { PlusIcon } from '@heroicons/vue/24/outline';


const props = defineProps({
    categories: {type:Object}
})

const form = useForm({
    name: '',
    category_id: '',
    avaialble: '',
    description: '',
});


</script>
