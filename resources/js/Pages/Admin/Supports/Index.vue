<template>
    <Head title="Suportes" />

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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Suportes</span>
                </div>
                </li>
            </ol>
        </nav>

        <div class="border-b border-gray-200 pb-5 sm:flex sm:items-center sm:justify-between">
            <h3 class="text-lg leading-6 text-gray-900">Lista de Suportes</h3>
        </div>

       <div class="w-full rounded-lg bg-white mb-2">
        <form v-on:submit.prevent="searchForm()" class="w-full grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="p-3 mt-3 sm:col-span-4 sm:col-start-1">
                    <div class="sm:col-span-3">
                        <label for="category_id" class="block text-sm font-medium leading-6 text-gray-900">Selecione o tipo de status do suporte</label>
                        <div class="mt-2">
                            <SelectInputStatus v-model="search.status" :options="statusOptions"></SelectInputStatus>
                        </div>
                    </div>
                </div>
                <div class="p-3 flex flex-col self-center items-center mt-10 sm:col-span-2">
                    <PrimaryButton :disabled="search.processing">
                        <span class="flex items-center gap-x-3 px-1 py-0.5">
                            <MagnifyingGlassIcon   class="w-5 h-5 shrink-0"/>
                            Filtrar
                        </span>
                    </PrimaryButton>
                </div>

            </form>
            </div>

        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md">
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Aluno</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Aula</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Status</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Cadastro</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                <tr v-for="support in props.supports.data" :key="support.id" class="hover:bg-gray-50">
                    <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                    <div class="relative h-10 w-10">
                        <img v-if="support.user.image" :src="'../storage/'+support.user.image"/>
                        <img v-else :src="'../back/assets/images/no-image.png'">
                    </div>
                    <div class="text-sm">
                        <div class="font-medium text-gray-700">{{ support.user.name }}</div>
                        <div class="text-gray-400">{{ support.user.email }}</div>
                    </div>
                    </th>
                    <td class="px-6 py-4">{{ support.lesson.name }}  </td>
                    <td class="px-6 py-4">
                    <span
                        :class="[
                            support.status === 'P' ? 'bg-orange-50 text-orange-600 ' : '',
                            support.status === 'A' ? 'bg-sky-50 text-sky-600 ' : '' ,
                            support.status === 'C' ? 'bg-green-50 text-green-600 ' : '', 'inline-flex items-center gap-1 rounded-full px-2 py-1 text-xs font-semibold']">
                        <span :class="[
                            support.status === 'P' ? 'bg-orange-600' : '',
                            support.status === 'A' ? 'bg-sky-600' : '' ,
                            support.status === 'C' ? 'bg-green-600' : '', 'h-1.5 w-1.5 rounded-full']"></span>
                        {{  support.statusurl }}
                    </span>
                    </td>

                    <td class="px-6 py-4">{{ support.created_at }}</td>
                    <td class="px-6 py-4">
                    <div class="flex justify-end gap-4">
                        <Link :href="route('admin.supports.show', support.id)"
                        :class="'hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-gray-300 hover:bg-gray-50 sm:block'"
                        >
                        <span class="flex intens-center gap-x-3">
                            <PencilSquareIcon class="w-4 h-4 shrink-0" />
                            Detalhes
                        </span>
                        </Link>

                        <Link href="" @click="event => deleteDepartment(support.id, support.name)">
                            <svg class="w-6 h-6"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 18 20">
                                <path stroke="currentColor"
                                 stroke-linecap="round"
                                 stroke-linejoin="round"
                                 stroke-width="1.5"
                                 d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                            </svg>
                        </Link>

                    </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="bg-white grid v-screen place-items-center">
                <Pagination :links="props.supports.links"></Pagination>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue'
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { ref } from 'vue';
import SelectInputStatus from "@/Components/SelectInputStatus.vue";
import { PencilSquareIcon, MagnifyingGlassIcon  } from '@heroicons/vue/24/outline';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {PlusIcon} from "@heroicons/vue/24/outline/index.js";

const modal = ref(false);
const title = ref('');
const id = ref('');
const status = ref('');

const props = defineProps({
    supports: Object,
    statusOptions: Object
})

const formPage = useForm({
});

const search = useForm({
    status: ''
});

const searchForm = () => {
    search.get(route('admin.supports.index'))
}
const onPageClick = (event) => {
    formPage.get(route('admin.supports.index', {page:event}));
}
const closeModal = () => {
    modal.value = false;
    form.clearErrors();
    form.reset();
}

const message = (msg) =>{
    form.reset();
    closeModal();
    Swal.fire({title:msg, icon:'success'});
}

const deleteDepartment = (id,name) =>{
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
            form.delete(route('admin.supports.destroy', id))
        }
    });
}
</script>
