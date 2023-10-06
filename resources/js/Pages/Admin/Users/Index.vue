<template>
    <Head title="Usuários" />

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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Usuários</span>
                </div>
                </li>
            </ol>
        </nav>

        <div class="border-b border-gray-200 pb-5 sm:flex sm:items-center sm:justify-between">
            
            <h3 class="text-lg leading-6 text-gray-900">Lista de Usuários</h3>

            
            <div class="py-3 float-right">
                <div class="rounded-md bg-indigo-600 px-4 py-2 text-center text-sm text-white hover:bg-indigo-500">
                    <Link :href="route('admin.users.create')">
                        <span class="flex items-center gap-x-3 px-1 py-0.5">
                            <PlusIcon class="w-5 h-5 shrink-0"/> 
                            Novo usuário
                        </span>
                    </Link>
                    
                </div>
            </div>           
        </div>
       <div class="w-full rounded-lg bg-white mb-2">
        <form v-on:submit.prevent="searchForm()" class="w-full grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="p-3 mt-3 sm:col-span-4 sm:col-start-1">
                    
                    <input id="filter" v-model="search.filter" placeholder="Pesquisar" class="block w-full w-3/4 rounded-md form-input focus:border-indigo-600"
                     type="text" />
                </div>
        
            
                <div class="p-3 flex flex-col self-center items-center mt-3 sm:col-span-2 ">
                    <PrimaryButton :disabled="search.processing">
                        <i class="fa fa-search">  Pesquisar</i>
                    </PrimaryButton>
                    
                </div>  
            </form> 
            </div> 

        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md">
            
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Nome</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Tipo</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Status</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Cadastro</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                    
                <tr v-for="user in users" :key="user.id" class="hover:bg-gray-50">
                    
                    <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                    <div class="relative h-10 w-10">
                        <a @click="event => openModal(user.name, user.id)">                           
                        <img v-if="user.image" :src="user.image"/>
                        <img v-else :src="user.image"/></a>
                        <!--<span class="absolute right-0 bottom-0 h-2 w-2 rounded-full bg-green-400 ring ring-white"></span>-->
                    </div>
                    <div class="text-sm">
                        <div class="font-medium text-gray-700">{{ user.name }}</div>
                        <div class="text-gray-400">{{ user.email }}</div>
                    </div>
                    </th>
                    <td class="px-6 py-4">Admin</td>
                    <td class="px-6 py-4">
                    <span
                        class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600"
                    >
                        <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                        Active
                    </span>
                    </td>
                   
                    <td class="px-6 py-4">{{ user.created_at }}</td>
                    <td class="px-6 py-4">
                    <div class="flex justify-end gap-4">
                        <Link x-data="{ tooltip: 'Detalhes' }" :href="route('admin.users.show', user.id)">
                            <svg 
                                class="w-6 h-6" 
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none" 
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                x-tooltip="tooltip">
                                <path 
                                stroke="currentColor" 
                                stroke-linecap="round" 
                                stroke-linejoin="round" 
                                stroke-width="2" 
                                d="M8 9h2v5m-2 0h4M9.408 5.5h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>                        
                        </Link>

                        <Link x-data="{ tooltip: 'Editar' }" :href="route('admin.users.edit', user.id)">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="h-6 w-6"
                                x-tooltip="tooltip">
                                <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
                                />
                            </svg>
                        </link>

                        <Link x-data="{ tooltip: 'Deletar' }" @click="event => deleteDepartment(user.id, user.name)">
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
           
        </div>
            <Modal :show="modal" @close="closeModal">
                <form v-on:submit.prevent="submitForm()">
                <h2 class="p-3 pt-3 text-lg text-center font.medium text-hray-900">{{ title}}</h2>
                <div class="p-3 mt-3">
                    <InputLabel for="image" value="Imagem"></InputLabel>
                    <input id="image" name="image" class="block w-full w-3/4 rounded-md form-input focus:border-indigo-600"
                    @input="form.image = $event.target.files[0]" type="file" />
                    <InputError :message="form.errors.image" class="mt-2"></InputError>
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
            </form>    
            
        </Modal>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondarygButton from '@/Components/SecondaryButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Modal from '@/Components/Modal.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { ref } from 'vue';
import { PlusIcon } from '@heroicons/vue/24/outline';


const imageInput = ref(null);
const modal = ref(false);
const title = ref('');
const id = ref('');

const props = defineProps({
    users: {type:Object}
})

const openModal = (name, user) =>{
    modal.value = true;
    id.value = user;
    title.value = 'Adicionar foto em '+name;
}

const closeModal = () => {
    modal.value = false;
    form.clearErrors();
    form.reset();
}

const search = useForm({
    filter: ''
});

const form = useForm({
    image: ''
});

const message = (msg) =>{
    form.reset();
    closeModal();
    Swal.fire({title:msg, icon:'success'});
}

const searchForm = () => {
    search.get(route('admin.users.index'))
}
const submitForm = () => {
    form.post(route('admin.users.update.image', id.value), {
        forceFormData: true,
        onSuccess: () => {message('Foto atualizada com sucesso!')},
       
    })
};
/*const submitForm = async () => {

    let formData = new FormData();
    formData.append('image', image)

        await httpClient.post(route('admin.users.update.image', {'aplication': aplicationId}),formData, {
            headers: {
                'Content-Type': 'multipart/form-data; charset=utf8; boundary='+Math.random().toString().substr(2),
            },
            
        }).then(async response => {
            if(response.request.sttus == 200 && response.data){
                data = response.data;
            }
        });
    
}*/

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
            form.delete(route('admin.users.destroy', id))
        }
    });
}
</script>
