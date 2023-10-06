<template>
    <Head title="Auxiliar | Subcategorias" />

    <AuthenticatedLayout>
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                <a :href="route('admin.dashboard')" class="inline-flex items-center text-sm font-medium text-slate-950 dark:text-gray-400 dark:hover:text-white">
                   <i class="fa fa-home mr-3"></i>
                    Home
                </a>
                </li>
                <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <a :href="route('admin.cadastros.home')" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Auxiliares</a>
                </div>
                </li>
                <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Subcategorias</span>
                </div>
                </li>
            </ol>
        </nav>

        <div class="border-b border-gray-200 pb-5 sm:flex sm:items-center sm:justify-between">
            
            <h3 class="text-lg leading-6 text-gray-900">Auxiliares: Lista de cadastro de subategorias</h3>

            
            <div class="py-3 float-right">
                <div class="bg-blue-400 rounded-lg place-items-center">
                    <PrimaryButton @click="$event => openModal(1)">
                        <span class="flex items-center gap-x-3 px-1 py-0.5">
                            <PlusIcon class="w-5 h-5 shrink-0"/> 
                            Nova subcategoria
                        </span>
                    </PrimaryButton>
                </div>
            </div>           
        </div>
        
    <div class="row">
        <div class="inline-block min-w-full overflow-w-auto rounded-lg shadow bg-white">
           
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">#</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">Nome</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">Categoria Pai</p>
                        </td>
                       
                        <td colspan="2" class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">Ações</p>
                        </td>

                    </tr>
                </thead>
                <tbody>
                    <tr v-for="subcat, i in subcategories.data" :key="subcat.id" class="text-gray-700">
                        <td class="border-b border-gray-200 bg-white px-4 py-4 text-sm">{{ (i+1) }}</td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ subcat.title }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ subcat.categoryname }}</p>
                        </td>
                      
                        
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <WarningButtom @click="event => openModal(2, subcat.title, subcat.category_id, subcat.id)">
                                <span class="flex intens-center gap-x-3">
                                    <PencilSquareIcon class="w-4 h-4 shrink-0" />
                                    Editar
                                </span>
                            </WarningButtom>  
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <DangerButton @click="event => deleteSubcategory(subcat.id, subcat.title)">
                                <span class="flex intens-center gap-x-3">
                                    <TrashIcon class="w-4 h-4 shrink-0" />
                                    Deletar
                                </span>
                            </DangerButton>                             
                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination class="mt-6 bg-white py-5 py-2" :links="subcategories.links" />
            
        </div>
        <Modal :show="modal" @close="closeModal">
            <h2 class="p-3 pt-3 text-lg text-center font.medium text-hray-900">{{ titleCat}}</h2>
            <div class="p-3 mt-3">
                <InputLabel for="title" value="Nome:"></InputLabel>
                <TextInput id="title" ref="titleInput"
                v-model="form.title" type="text" class="mt-1 block w-3/4"
                placeholder="Nome"></TextInput>
                <InputError :message="form.errors.title" class="mt-2"></InputError>
            </div>

            <div class="p-3">
                <InputLabel for="category_id" value="Categorias:"></InputLabel>
                <SelectInputSubCategory id="category_id" :options="categories"
                    v-model="form.category_id" type="text" class="mt-1 block w-3/4">
                </SelectInputSubCategory>
                <InputError :message="form.errors.category_id" class="mt-2"></InputError>
            </div>
           
            <div class="p-3 flex justify-around">
                <PrimaryButton :disabled="form.processing" @click="save">
                    <span class="flex items-center gap-x-3 px-1 py-0.5">
                            <InboxArrowDownIcon class="w-5 h-5 shrink-0"/> 
                            Salvar
                        </span>
                </PrimaryButton>
                <div class="flex justify-end">
                    <SecondaryButton :disabled="form.processing" @click="closeModal">
                        <span class="flex items-center gap-x-3 px-1 py-0.5">
                                <PlusIcon class="w-5 h-5 shrink-0"/> 
                                Cancelar
                            </span>
                    </SecondaryButton>
                </div>
            </div>            
        </Modal>
    </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue'
import DangerButton from '@/Components/DangerButton.vue';
import { Head,Link,useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import InputError from '@/Components/InputError.vue';
import SelectInputSubCategory from '@/Components/SelectInputSubCategory.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { nextTick, ref } from 'vue';
import WarningButtom from '@/Components/Warningbuttom.vue';

import Swal from 'sweetalert2';
import { PlusIcon, InboxArrowDownIcon,PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/outline';


const titleInput = ref(null);
const modal = ref(false);
const titleCat = ref('');
const operation = ref(1);
const id = ref('');


const props = defineProps({
    subcategories: {type:Object},
    categories: {type:Object}
});

const form = useForm({
    title: '',
    category_id: ''
});

const openModal = (op, title, category, subcategory) =>{
    modal.value = true;
    operation.value = op;
    id.value = subcategory;
    if(op == 1){
        titleCat.value = 'Nova Subcategoria';
    }else{
        titleCat.value = 'Editar Subcategoria';
        form.title=title;
        form.category_id=category;
        form.subcategory=subcategory;
    }
}

const closeModal = () => {
    modal.value = false;
    form.clearErrors();
    form.reset();
}

const save = () => {
    if(operation.value == 1){
        form.post(route('admin.cadastros.subcategories.store'),{
            onSuccess: () => {message('Subcategoria Cadastrado com sucesso!')}
        });
    }else{
        form.put(route('admin.cadastros.subcategories.update',id.value),{
            onSuccess: () => {message('Subcategoria atualizada com sucesso!')}
        });
    }
}

const message = (msg) =>{
    form.reset();
    closeModal();
    Swal.fire({title:msg, icon:'success'});
}

const deleteSubcategory = (id,title) =>{
    const alerta = Swal.mixin({
        buttonsStyling:true
    });

    alerta.fire({
        title:'Você realmente quer deletar '+title+' ?',
        icon:'question',showCancelButton:true,
        confirmButtonText:'<i class="fa-solid fa-check"</i> Sim, deletar',
        cancelButtonText:'<i class="fa-solid fa-ban text-red"</i> Cancel',
    }).then((result) =>{
        if(result.isConfirmed){
            form.delete(route('admin.cadastros.subcategories.destroy', id))
        }
    });
}
   
</script>
