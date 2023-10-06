<template>
    <Head title="Relatórios" />

    <AuthenticatedLayout>
        <template #header>
            Relatórios
        </template>

        <div class="mb-4 inline-flex w-full overflow-hidden rounded-lg bg-white shadow-md">
            <div class="flex w-12 items-center justify-center bg-blue-500">
                <svg class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"></path>
                </svg>
            </div>
    
            <div class="-mx-3 px-4 py-2 w-full">
                <div class="mx-3 ">            
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <InputLabel for="rep" value="Relatório:" class="font-semibold text-blue-500"></InputLabel>
                    <SelectInput id="rep" class="mt-1 block w-4/12"
                    v-model="report" :options="types"></SelectInput>
                </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            
            <div v-if="report == '1'" class="p-6 border-b border-gray-200">
                <DataTable :data="employees" :columns="columns1"
                class="w-full border border-gray-400"
                :options="{select:true, responsive:true, autoWidth:false, dom: 'Bfrtip', buttons:buttons1}">
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
                    </tr>
                </thead>
                </DataTable>
            </div>
            <div v-else class="p-6 border-b border-gray-200">
                <div class="m2 mb-3">
                    <WarningButtom @click="update" class="mr-3"><i class="fa-solid fa-edit"></i></WarningButtom>
                    <DangerButton @click="remove"><i class="fa-solid fa-trash"></i></DangerButton>
                </div>
                <DataTable :data="departments" :columns="columns2"
                class="w-full border border-gray-400" ref="table"
                :options="{select:true, responsive:true, autoWidth:false, dom: 'Bfrtip', buttons:buttons2}">
                <thead>
                    <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">#</p>
                        </td>
                       
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">Departamento</p>
                        </td>
                    </tr>
                </thead>
                </DataTable>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head,useForm } from '@inertiajs/vue3';
import { ref} from 'vue';
import InputLabel from '@/Components/InputLabel.vue';
import SelectInput from '@/Components/SelectInput.vue';
import DangerButton from '@/Components/DangerButton.vue';
import WarningButtom from '@/Components/Warningbuttom.vue';
import Swal from 'sweetalert2';
import DataTable from 'datatables.net-vue3';
import 'datatables.net-dt/css/jquery.dataTables.css';
import ButtonsHtml5 from 'datatables.net-buttons/js/buttons.html5';
import 'datatables.net-buttons/js/buttons.print';
import 'datatables.net-responsive-dt';
import 'datatables.net-responsive-dt/css/responsive.dataTables.min.css';
import JsZip from 'jszip';
import pdfmake from 'pdfmake/build/pdfmake';
import * as pdfFonts from "pdfmake/build/vfs_fonts";
import Select from 'datatables.net-select';

pdfmake.vfs = pdfFonts.pdfMake ? pdfFonts.pdfMake.vfs : pdfmake.vfs;
window.JSZip = JsZip;
DataTable.use(ButtonsHtml5);
DataTable.use(Select);

const props = defineProps({
    employees: {type:Object}, 
    departments: {type:Object}
});
const table = ref([]);
const columns1 = ref([]);
const columns2 = ref([]);
const buttons1 = ref([]);
const buttons2 = ref([]);
const report = ref([1]);
const types = ref([{'id':'1', 'name':'Funcionários'},{'id':'2', 'name':'Departamentos'}]);

columns1.value = [{data:null, render:function(data, type, row, meta)
{return (meta.row + 1)}},
{data:'name'},
{data:'email'},
{data:'phone'},
{data:'department'}
]

columns2.value = [{data:null, render:function(data, type, row, meta)
{return (meta.row + 1)}},
{data:'name'},
]

buttons1.value = [
    {
        title:'Funcionários',extend:'excelHtml5', 
        text:'<i class="fa fa-file-excel"></i> Excel',
        className:'focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800'
    },
    {
        title:'Funcionários',extend:'pdfHtml5', 
        text:'<i class="fa fa-file-pdf"></i> PDF',
        className:'focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900'
    },
    {
        title:'Funcionários',extend:'print', 
        text:'<i class="fa fa-print"></i> Imprimir',
        className:'text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700'
    },
    {
        title:'Funcionários',extend:'copy', 
        text:'<i class="fa fa-copy"></i> Copiar',
        className:'focus:outline-none text-black bg-white border border-gray-300 hover:bg-gray-300 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900'
    }
]

buttons2.value = [
{
        title:'Deparamentos',extend:'excelHtml5', 
        text:'<i class="fa fa-file-excel"></i> Excel',
        className:'focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800'
    },
    {
        title:'Deparamentos',extend:'pdfHtml5', 
        text:'<i class="fa fa-file-pdf"></i> PDF',
        className:'focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900'
    },
    {
        title:'Deparamentos',extend:'print', 
        text:'<i class="fa fa-print"></i> Imprimir',
        className:'text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700'
    },
    {
        title:'Deparamentos',extend:'copy', 
        text:'<i class="fa fa-copy"></i> Copiar',
        className:'focus:outline-none text-black bg-white border border-gray-300 hover:bg-gray-300 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900'
    }
]

const form = useForm({
    id: ''
});

const deleteDepartment = (id,name) =>{
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
            form.delete(route('departments.destroy', id))
        }
    });
}

const update = () =>  {
    table.value.dt.row({selected:true}).every(function(){
        let indice = props.departments.indexOf(this.data());
        let uid = props.departments[indice].id;
        window.location.href = 'departments/'+uid+'/edit';
    });
}
const remove = () =>  {
    table.value.dt.row({selected:true}).every(function(){
        let indice = props.departments.indexOf(this.data());
        let did = props.departments[indice].id;
        let dname = props.departments[indice].name;
        deleteDepartment(did,dname);
    });
}
</script>
