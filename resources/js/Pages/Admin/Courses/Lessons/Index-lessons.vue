<template>
    <Head title="Aulas"/>

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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Aulas</span>
                </div>
                </li>
            </ol>
        </nav>

        <div class="border-b border-gray-200 pb-5 sm:flex sm:items-center sm:justify-between">
            <h3 class="text-lg leading-6 text-gray-900">Lista de Aulas</h3>
            <div class="py-3 float-right">
                <div class="py-3 float-right">
                        <div class="rounded-md bg-indigo-600 px-4 py-2 text-center text-sm text-white hover:bg-indigo-500">
                            <Link :href="route('admin.lessons.create', props.module.id)">
                                <span class="flex items-center gap-x-3 px-1 py-0.5">
                                    <PlusIcon class="w-5 h-5 shrink-0"/>
                                    Nova Aula
                                </span>
                            </Link>
                        </div>
                    </div>
            </div>
        </div>

       <div class="w-full rounded-lg bg-white mb-2">
        <form v-on:submit.prevent="searchForm()" class="w-full grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="p-3 mt-3 sm:col-span-4 sm:col-start-1">

                    <input id="filter" v-model="search.filter" placeholder="Pesquisar" class="block w-full w-3/4 rounded-md form-input focus:border-indigo-600"
                     type="text" />
                </div>

            <div class="p-3 flex flex-col self-center items-center mt-2 sm:col-span-2">
                <PrimaryButton :disabled="search.processing">
                            <span class="flex items-center gap-x-3 px-1 py-0.5">
                                <MagnifyingGlassIcon   class="w-5 h-5 shrink-0"/>
                                Pesquisar
                            </span>
                </PrimaryButton>
            </div>
        </form>
        </div>

        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md">
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Nome</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Duração</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Plataforma</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Cadastro</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                    <tr v-for="lesson in lessons.data" :key="lesson.id" class="hover:bg-gray-50">

                    <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                    <div class="text-sm">
                        <div class="font-medium text-gray-700">{{ lesson.name }}</div>
                    </div>
                    </th>
                    <td class="px-6 py-4">{{ lesson.duration }}</td>
                    <td class="px-6 py-4">{{ lesson.plataform }}</td>
                    <td class="px-6 py-4">{{ lesson.created_at }}</td>
                    <td class="px-6 py-4">
                    <div class="flex justify-end gap-4">

                        <Link :href="route('admin.lessons.index', lesson.id)"
                            class="coursor-pointer" x-data="{ tooltip: 'Editar' }">
                            <EyeIcon class="h-6 w-6 text-gray-500" />
                        </Link>

                        <Link :href="route('admin.lessons.edit', [props.module.id, lesson.id])">
                            <PencilIcon class="h-6 w-6 text-gray-500" />
                        </LinK>

                        <Link x-data="{ tooltip: 'Deletar' }" @click="event => deleteModule(lesson.id, lesson.name)">
                            <TrashIcon class="h-6 w-6 text-gray-500" />
                        </Link>

                    </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="bg-white grid v-screen place-items-center">
                <Pagination :links="props.lessons.links"></Pagination>
            </div>
        </div>
        <Modal :show="modal" @close="closeModal">
                <h2 class="p-3 pt-3 text-lg text-center font.medium text-hray-900">{{ title}}</h2>
                <div class="p-3 mt-3">
                    <InputLabel for="name" value="Nome"></InputLabel>
                    <input id="name" v-model="form.name" class="block w-full w-3/4 rounded-md form-input focus:border-indigo-600"
                     />
                    <InputError :message="form.errors.name" class="mt-2"></InputError>
                </div>

                <div class="p-3 flex justify-around">
                    <PrimaryButton :disabled="form.processing" @click="save">
                        <i class="fa fa-save">  Salvar</i>
                    </PrimaryButton>
                    <div class="p-3 flex justify-end">
                        <SecondarygButton :disabled="form.processing" @click="closeModal">
                            <i class="fa fa-plus text-red-900"> Cancelar</i>
                        </SecondarygButton>
                    </div>
                </div>
        </Modal>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondarygButton from '@/Components/SecondaryButton.vue';
import InputError from '@/Components/InputError.vue';
import LinkButton from '@/Components/LinkButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { ref } from 'vue';
import { PlusIcon,PencilIcon,TrashIcon, EyeIcon } from '@heroicons/vue/24/outline';
import {MagnifyingGlassIcon} from "@heroicons/vue/24/outline/index.js";
import Pagination from "@/Components/Pagination.vue";


const modal = ref(false);
const title = ref('');
const operation = ref(1);
const id = ref('');
const lessonId = ref('');

const props = defineProps({
    module: {type:Object},
    lessons: {type:Object}
})

const search = useForm({
    filter: ''
});

const form = useForm({
    name:'',
    module_id: props.module.id
});

const message = (msg) =>{
    form.reset();
    closeModal();
    Swal.fire({title:msg, icon:'success'});
}

const searchForm = () => {
    search.get(route('admin.lessons.index',props.module.id))
}

const deleteModule = (id, name) =>{
    const alerta = Swal.mixin({
        buttonsStyling:true
    });

    alerta.fire({
        title:'Você realmente quer deletar '+name+' ?',
        icon:'question',showCancelButton:true,
        confirmButtonText:'<i class="fa-solid fa-check"</i> Sim, deletar',
        cancelButtonText:'<i class="fa-solid fa-ban text-red"</i> Cancel',
    }).then((result) =>{
        if(result.isConfirmed){
            form.delete(route('admin.lessons.destroy', [props.module.id, id]))
        }
    });
}
</script>
