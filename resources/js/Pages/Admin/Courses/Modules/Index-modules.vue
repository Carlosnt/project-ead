<template>
    <Head title="Módulos" />

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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Módulos</span>
                </div>
                </li>
            </ol>
        </nav>

        <div class="border-b border-gray-200 pb-5 sm:flex sm:items-center sm:justify-between">
            <h3 class="text-lg leading-6 text-gray-900">Lista de Módulos</h3>
            <div class="py-3 float-right">
                <div class="py-3 float-right">
                        <div class="bg-blue-400 rounded-lg place-items-center">
                            <PrimaryButton @click="$event => openModal(1)">
                                <span class="flex items-center gap-x-3 px-1 py-0.5">
                                    <PlusIcon class="w-5 h-5 shrink-0"/>
                                    Novo Módulo
                                </span>
                            </PrimaryButton>
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
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Aulas</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Cadastro</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                    <tr v-for="mod in modules.data" :key="mod.id" class="hover:bg-gray-50">

                    <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                    <div class="text-sm">
                        <div class="font-medium text-gray-700">{{ mod.name }}</div>
                    </div>
                    </th>
                    <td class="px-6 py-4">{{ mod.lessons_count}}</td>
                    <td class="px-6 py-4">{{ mod.created_at }}</td>
                    <td class="px-6 py-4">
                    <div class="flex justify-end gap-4">

                        <Link :href="route('admin.lessons.index', mod.id)"
                            class="coursor-pointer" x-data="{ tooltip: 'Editar' }">
                            <VideoCameraIcon class="h-6 w-6 text-gray-500" />
                        </Link>

                        <LinkButton class="coursor-pointer" x-data="{ tooltip: 'Editar' }"
                        v-on:click="event => openModal(2, mod.name, props.course.id, mod.id)">
                            <PencilIcon class="h-6 w-6 text-gray-500" />
                        </LinkButton>

                        <Link x-data="{ tooltip: 'Deletar' }" @click="event => deleteModule(mod.id, mod.name)">
                            <TrashIcon class="h-6 w-6 text-gray-500" />
                        </Link>

                    </div>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="bg-white grid v-screen place-items-center">
                <Pagination :links="props.modules.links"></Pagination>
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
                <div class="p-3 flex flex-col self-center items-center mt-2 sm:col-span-2">
                    <PrimaryButton :disabled="search.processing" @click="save">
                            <span class="flex items-center gap-x-3 px-1 py-0.5">
                                <PlusIcon class="w-5 h-5 shrink-0"/>
                                Salvar
                            </span>
                    </PrimaryButton>
                </div>

                <div class="p-3 flex flex-col self-center items-center mt-2 sm:col-span-2 justify-end">
                    <SecondarygButton :disabled="form.processing" @click="closeModal" class="border-red-500">
                            <span class="flex items-center text-red-500 gap-x-3 px-1 py-0.5">
                                <XMarkIcon class="w-5 h-5 shrink-0"/>
                                Cancelar
                            </span>
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
import { PlusIcon,PencilIcon,TrashIcon, VideoCameraIcon } from '@heroicons/vue/24/outline';
import {MagnifyingGlassIcon, XMarkIcon} from "@heroicons/vue/24/outline/index.js";
import Pagination from "@/Components/Pagination.vue";


const modal = ref(false);
const title = ref('');
const operation = ref(1);
const id = ref('');
const moduleId = ref('');

const props = defineProps({
    modules: {type:Object},
    course: {type:Object}
})

const search = useForm({
    filter: ''
});

const form = useForm({
    name:'',
    course_id: props.course.id
});

const message = (msg) =>{
    form.reset();
    closeModal();
    Swal.fire({title:msg, icon:'success'});
}

const searchForm = () => {
    search.get(route('admin.modules.index',props.course.id))
}

const openModal = (op, name, course, module) =>{
    modal.value = true;
    operation.value = op;
    id.value = course;
    moduleId.value = module;
    if(op == 1){
        title.value = 'Novo Módulo';
    }else{
        title.value = 'Editar Módulo';
        form.name=name;
        form.course_id=course;
        form.module=module;
    }
}

const closeModal = () => {
    modal.value = false;
    form.clearErrors();
    form.reset();
}

const save = () => {
    if(operation.value == 1){
        form.post(route('admin.modules.store', props.course.id),{
            onSuccess: () => {message('Módulo cadastrado com sucesso!')}
        });
    }else{
        form.put(route('admin.modules.update', [props.course.id, moduleId.value]),{
            onSuccess: () => {message('Módulo atualizado com sucesso!')}
        });
    }
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
            form.delete(route('admin.modules.destroy', [props.course.id, id]))
        }
    });
}
</script>
