<template>
    <Head title="Cadastros | Produtos " />

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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Produtos</span>
                </div>
                </li>
            </ol>
        </nav>

        <div class="border-b border-gray-200 pb-5 sm:flex sm:items-center sm:justify-between">
            
            <h3 class="text-lg leading-6 text-gray-900">Cadastros: Lista de Produtos</h3>
           
            <div class="py-3 float-right">
                <div class="place-items-center rounded-md bg-indigo-600 px-4 py-2 text-center text-sm text-white hover:bg-indigo-500">
                    <Link :href="route('admin.cadastros.products.create')">
                        <span class="flex items-center gap-x-3 px-1 py-0.5">
                            <PlusIcon class="w-5 h-5 shrink-0"/> 
                            Novo Produto
                        </span>
                    </Link>
                </div>
            </div>           
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            
            <div v-if="report == '1'" class="p-6 border-b border-gray-200">
                <DataTable :data="clients" :columns="columns1"
                class="w-full border border-gray-400"
                :options="{ responsive:true, autoWidth:false, dom: 'Bfrtip', buttons:buttons1,
                language:{search:'Buscar', zeroRecords:'Nenhum registro ainda...', info:'Mostrando de _START_ a _END_ de _TOTAL_ registros',
                infoFiltered: '(Filtrados de _MAX_ registros.)',
                paginate:{ first:'Primeiro', previous: 'Anterior', next:'Seguinte', last:'Último'}}}">
                <thead>
                    <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">#</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">Nome fantasia</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">CPF/CNPJ</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">Telefone</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">Dt.Nascimento</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">Ação</p>
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
import { Link } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import SelectInput from '@/Components/SelectInput.vue';
import DangerButton from '@/Components/DangerButton.vue';
import WarningButtom from '@/Components/Warningbuttom.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
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
import { PlusIcon, InboxArrowDownIcon,PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/outline';

pdfmake.vfs = pdfFonts.pdfMake ? pdfFonts.pdfMake.vfs : pdfmake.vfs;
window.JSZip = JsZip;
DataTable.use(ButtonsHtml5);
DataTable.use(Select);

const props = defineProps({
    clients: {type:Object}, 
});
const table = ref([]);
const columns1 = ref([]);
const buttons1 = ref([]);
const report = ref([1]);
const types = ref([{'id':'1', 'name':'Clientes'}]);

columns1.value = [{data:null, render:function(data, type, row, meta)
{return (meta.row + 1)}},
{data:'corporate_name'},
{data:'cpf_cnpj'},
{data:'phone'},
{data:'date_of_birth'},
{data:null, render:function(data, type, row, meta){
    return '<a class="focus:outline-none text-white bg-orange-600 hover:bg-orange-800 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-4 py-2 mr-2 mb-2 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800" href="'+route('admin.cadastros.clients.edit',[data.id])+'"><i class="fa fa-pencil text-white-900"></i></a>'+
            '<button class="focus:outline-none text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" @click="editClient(' + data.id + ')"><i class="fa fa-trash text-white-900"></i></button>'}},

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

const form = useForm({
    id: ''
});

const deleteCliente = (id,name) =>{
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

const editClient = () =>  {
    table.value.dt.row({selected:true}).every(function(){
        let indice = props.clients.indexOf(this.data());
        let uid = props.clients[indice].id;
        window.location.href = 'admin/cadastros/clients/'+uid+'/edit';
    });
}

const showClient = () =>  {
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
        deleteCliente(did,dname);
    });
}
</script>
