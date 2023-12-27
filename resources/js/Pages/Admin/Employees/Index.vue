<template>
    <Head title="Funcionários" />

    <AuthenticatedLayout>
        <template #header>
            Funcionários
        </template>
        <div class="py-3 float-right">
        <div class="bg-blue-400 rounded-lg place-items-center">
                <InfoButton @click="$event => openModal(1)">
                    <i class="fa fa-plus"> Adicionar</i>
                </InfoButton>
        </div>
    </div>

        <div class="inline-block min-w-full overflow-w-auto rounded-lg shadow">
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
                            <p class="text-gray-900 whitespace-no-wrap">E-mail</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">Telefone</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">Departamento</p>
                        </td>
                        <td colspan="2" class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">Ações</p>
                        </td>

                    </tr>
                </thead>
                <tbody>
                    <tr v-for="emp, i in employees.data" :key="emp.id" class="text-gray-700">
                        <td class="border-b border-gray-200 bg-white px-4 py-4 text-sm">{{ (i+1) }}</td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ emp.name }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ emp.email }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ emp.phone }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ emp.department }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <WarningButtom @click="event => openModal(2, emp.name, emp.email, emp.phone, emp.department_id, emp.id)">
                                <i class=" text-orange-400 fa-solid fa-pencil"></i>
                            </WarningButtom>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <DangerButttom @click="event => deleteEmployee(emp.id, emp.name)">
                                <i class=" text-red-400 fa-solid fa-trash"></i>
                            </DangerButttom>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="bg-white grid v-screen place-items-center">
                <VueTailindPagination
                :current="employees.currentPage" :total="employees.total"
                :per-page="employees.perPage"
                @page-changed="$event => onPageClick($event)"
                ></VueTailindPagination>
            </div>

        </div>
        <Modal :show="modal" @close="closeModal">
            <h2 class="p-3 pt-3 text-lg text-center font.medium text-hray-900">{{ title}}</h2>
            <div class="p-3 mt-3">
                <InputLabel for="name" value="Name:"></InputLabel>
                <TextInput id="name" ref="nameInput"
                v-model="form.name" type="text" class="mt-1 block w-3/4"
                placeholder="Nome"></TextInput>
                <InputError :message="form.errors.name" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="email" value="E-mail:"></InputLabel>
                <TextInput id="email"
                v-model="form.email" type="text" class="mt-1 block w-3/4"
                placeholder="E-mail"></TextInput>
                <InputError :message="form.errors.email" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="phone" value="Celular:"></InputLabel>
                <TextInput id="phone"
                v-model="form.phone" type="text" class="mt-1 block w-3/4"
                placeholder="Celular"></TextInput>
                <InputError :message="form.errors.phone" class="mt-2"></InputError>
            </div>

            <div class="p-3">
                <InputLabel for="department_id" value="Departamentos:"></InputLabel>
                <SelectInput id="department_id" :options="departments"
                v-model="form.department_id" type="text" class="mt-1 block w-3/4">
                </SelectInput>
                <InputError :message="form.errors.department_id" class="mt-2"></InputError>
            </div>
            <div class="p-3 flex justify-around">
                <PrimaryButton :disabled="form.processing" @click="save">
                    <i class="fa fa-save">  Salvar</i>
                </PrimaryButton>
                <div class="p-3 flex justify-end">
                <SecundaryButton :disabled="form.processing" @click="closeModal">
                    <i class="fa fa-plus text-red-900"> Cancelar</i>
                </SecundaryButton>
            </div>
            </div>

        </Modal>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InfoButton from '@/Components/InfoButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Pagination from '@/Components/Pagination.vue'
import SelectInput from '@/Components/SelectInput.vue';
import WarningButtom from '@/Components/Warningbuttom.vue';

import Modal from '@/Components/Modal.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';
import Swal from 'sweetalert2';
import VueTailindPagination from '@ocrv/vue-tailwind-pagination';

const nameInput = ref(null);
const modal = ref(false);
const title = ref('');
const operation = ref(1);
const id = ref('');

const props = defineProps({
    employees: {type:Object},
    departments: {type:Object}
})

const form = useForm({
    name:'', email:'', phone:'', department_id:''
});

const formPage = useForm({});
const onPageClick = (event)=>{
    formPage.get(route('admin.employees.index', {page:event}));
}

const openModal = (op, name, email, phone, department, employee) =>{
    modal.value = true;
    operation.value = op;
    id.value = employee;
    if(op == 1){
        title.value = 'Novo Funcionário';
    }else{
        title.value = 'Editar Funcionário';
        form.name=name;
        form.email=email;
        form.phone=phone;
        form.department_id=department;
        form.employee=employee;
    }
}

const closeModal = () => {
    modal.value = false;
    form.clearErrors();
    form.reset();
}

const save = () => {
    if(operation.value == 1){
        form.post(route('admin.employees.store'),{
            onSuccess: () => {message('Funcionário Cadastrado com sucesso!')}
        });
    }else{
        form.put(route('admin.employees.update',id.value),{
            onSuccess: () => {message('Funcionário atualizado com sucesso!')}
        });
    }
}

const deleteEmployee = (id,name) =>{
    const alerta = Swal.mixin({
        buttonsStyling:true
    });

    alerta.fire({
        title:'Você realmente quer deletar '+name+' ?',
        icon:'question',showCancelButton:true,
        confirmButtonText:'<i class="fa-solid fa-check"</i> Sim, deletar',
        cancelButtonText:'<i class="fa-solid fa-ban"</i> Cancel',
    }).then((result) =>{
        if(result.isConfirmed){
            form.delete(route('employees.destroy', id),{
                onSuccess: () => {message('Funcionário deletado com sucesso!')}
            })
        }
    });
}

const message = (msg) =>{
    form.reset();
    closeModal();
    Swal.fire({title:msg, icon:'success'});
}

</script>
