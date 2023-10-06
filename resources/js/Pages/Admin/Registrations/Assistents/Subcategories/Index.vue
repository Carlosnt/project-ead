<template>
    <Head title="Categorias" />

    <AuthenticatedLayout>
    
        <div class="border-b border-gray-200 pb-5 sm:flex sm:items-center sm:justify-between">
            
            <h3 class="text-lg leading-6 text-gray-900">Gerenciar nossos cadastros auxíliares</h3>

            <div class="mt-3 sm:ml-4 sm:mt-0">        
                <Link :href="route('admin.dashboard')" 
                    :class="'inline-flex items-center rouneded-md bg-indigo-600 px-3 py-2 text-sm text-white shadow-sm hover:bg-indigo-500 focus:ring-4 focus:visible:outline rounded-lg  px-5 py-2.5 mr-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-blue-800'">
                    <span class="flex items-center gap-x-3">
                        <ArrowUturnLeftIcon class="w-5 h-5 shrink-0"/> 
                        Voltar
                    </span>
                </Link>  
            </div>
            <div class="py-3 float-right">
            <div class="bg-blue-400 rounded-lg place-items-center">
                    <PrimaryButton click="$event => openModal(1)">
                        <span class="flex items-center gap-x-3 px-1 py-0.5">
                            <PlusIcon class="w-5 h-5 shrink-0"/> 
                            Nova categoria
                        </span>
                    </PrimaryButton>
            </div>
        </div>           
        </div>
        
    <div class="row">
        <div class="bg-white w-full overflow-hidden shadow-sm sm:rounded-lg">
            
            <div class="p-6 border-b border-gray-200">
                <DataTable :data="categories" :columns="columns"
                class="w-full"
                :options="{responsive:true, autoWidth:false, dom: 'Bfrtip', buttons:buttons, language:{
                    search: 'Buscar', zeroRecords:'Nenhum registro encontrado...',
                    info:'Mostrando _START_ a _END_ de _TOTAL_ registros',
                    infoFiltered: '(Filtrados de _MAX_ registros.)',
                    paginate: {first: 'Primeiro', previous: 'Anterior', next: 'Próximo', last:'Último'}
                }}">
                <thead>
                    <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">#</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">Nome</p>
                        </td>                        
                    </tr>
                </thead>
                </DataTable>
            </div>
            
        </div>
    </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InfoButton from '@/Components/InfoButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref} from 'vue';
import { Head,Link,useForm } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue'
import SelectInput from '@/Components/SelectInput.vue';
import WarningButtom from '@/Components/Warningbuttom.vue';
import SecundarygButtom from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import axios from 'axios';
import DataTable from 'datatables.net-vue3';
import DataTableLib from 'datatables.net-bs5';
import Buttons from 'datatables.net-buttons-bs5';
import ButtonsHtml5 from 'datatables.net-buttons/js/buttons.html5';
import 'datatables.net-dt/css/jquery.dataTables.css';
import 'datatables.net-buttons/js/buttons.print';
import 'datatables.net-responsive-dt';
import 'datatables.net-responsive-dt/css/responsive.dataTables.min.css';
import JsZip from 'jszip';
import pdfmake from 'pdfmake/build/pdfmake';
import * as pdfFonts from "pdfmake/build/vfs_fonts";
import Select from 'datatables.net-select';
import { ArrowUturnLeftIcon, TagIcon,PlusIcon, BanknotesIcon, CubeIcon, CurrencyDollarIcon, TrashIcon, HandThumbUpIcon } from '@heroicons/vue/24/outline';
pdfmake.vfs = pdfFonts.pdfMake ? pdfFonts.pdfMake.vfs : pdfmake.vfs;
window.JSZip = JsZip;
DataTable.use(DataTableLib);
DataTable.use(ButtonsHtml5);
DataTable.use(pdfmake);
DataTable.use(Select);

const props = defineProps({
    categories: {type:Object}, 
    
});

const table = ref([]);
const columns = ref([]);

const buttons = ref([]);

const report = ref([1]);
const types = ref([{'id':'1', 'name':'Funcionários'},{'id':'2', 'name':'Departamentos'}]);

columns.value = [{data:null, render:function(data, type, row, meta)
{return (meta.row + 1)}},
{data:'name'},
]

buttons.value = [
    {
        title:'Categorias',extend:'excelHtml5', 
        text:'<i class="fa fa-file-excel"></i> Excel',
        className:'focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800'
    },
    {
        title:'Categorias',extend:'pdfHtml5', 
        text:'<i class="fa fa-file-pdf"></i> PDF',
        className:'focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900'
    },
    {
        title:'Categorias',extend:'print', 
        text:'<i class="fa fa-print"></i> Imprimir',
        className:'text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700'
    },
    {
        title:'Categorias',extend:'copy', 
        text:'<i class="fa fa-copy"></i> Copiar',
        className:'focus:outline-none text-black bg-white border border-gray-300 hover:bg-gray-300 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900'
    }
]

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
const data = {
    components: {DataTable},
    data(){
        return {
            categories: null
        }
    }
}
   
</script>
