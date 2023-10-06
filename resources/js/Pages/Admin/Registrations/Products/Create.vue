<template>
    <Head title="Cadastrar produto" />

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
                    <a :href="route('admin.cadastros.products.index')" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Produtos</a>
                </div>
                </li>
                <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Novo Produto</span>
                </div>
                </li>
            </ol>
        </nav>

        <div class="border-b border-gray-200 pb-5 sm:flex sm:items-center sm:justify-between">
            
                <div class="grid md-12-6">  
                    <h3 class="text-lg leading-6 text-gray-900">Formulário de cadastro de produto</h3>
                </div>

                <div class="grid md-12-6">
                    <div class="py-3 float-right">
                        <div class="place-items-center rounded-md bg-indigo-600 px-4 py-2 text-center text-sm text-white hover:bg-indigo-500">
                            <Link :href="route('admin.cadastros.products.index')">
                                <span class="flex items-center gap-x-3 px-1 py-0.5">
                                    <PlusIcon class="w-5 h-5 shrink-0"/> 
                                    Voltar
                                </span>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>           
      

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <form @submit.prevent="$event => form.post(route('admin.departments.store'))"
                    class="mt-6 space-y-6 w-full">
                    <div class="space-y-12">               
                        <div class="border-b border-gray-900/10 pb-12">  
                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"> 
                                <div class="col-span-full">
                                    <label for="product_title" class="block text-sm font-medium leading-6 text-gray-900">Nome do produto</label>
                                    <div class="mt-2">
                                    <TextInput type="text" v-model="form.product_title" id="product_title" 
                                    autocomplete="Nome do produto" 
                                    class="mt-1 block">
                                    </TextInput>
                                    <InputError :message="form.errors.product_title" class="mt-2"></InputError>
                                    </div>
                                </div>

                                <div class="sm:col-span-2 sm:col-start-1">
                                    <InputLabel for="ncm" value="NCM"></InputLabel>
                                    <div class="mt-2">
                                    <TextInput type="text" v-model="form.ncm" id="ncm" autocomplete="ncm" 
                                    class="mt-1 block"></TextInput>
                                    <InputError :message="form.errors.ncm" class="mt-2"></InputError>
                                    </div>
                                </div> 
                                
                                <div class="sm:col-span-2 ">
                                    <InputLabel for="gtim" value="Código Barra/Gtin/EanTrib"></InputLabel>
                                    <TextInput id="gtim" v-model="form.gtim" required
                                    type="text" class="mt-1 block"></TextInput>
                                    <InputError :message="form.errors.gtim" class="mt-2"></InputError>
                                </div>

                                <div class="sm:col-span-2 ">                       
                                    <InputLabel for="cest" value="Cest"></InputLabel>
                                    <TextInput id="cest" v-model="form.cest" required
                                    type="text" class="mt-1 block"></TextInput>
                                    <InputError :message="form.errors.cest" class="mt-2"></InputError>
                                </div>

                                <div class="sm:col-span-2 sm:col-start-1">
                                    <InputLabel for="category_id" value="Origem:"></InputLabel>
                                    <SelectInput id="category_id" :options="categories"
                                    v-model="form.category_id" type="text" class="mt-1 block">
                                    </SelectInput>
                                    <InputError :message="form.errors.category_id" class="mt-2"></InputError>
                                </div>
                                
                                <div class="sm:col-span-2">
                                    <InputLabel for="title" value="Categorias:"></InputLabel>
                                    <SelectInputCategory id="title" :options="categories"
                                    v-model="form.title" type="text" class="mt-1 block" placeholder="Selecione uma categoria">
                                    </SelectInputCategory>
                                    <InputError :message="form.errors.title" class="mt-2"></InputError>
                                </div>

                                <div class="sm:col-span-2">
                                    <InputLabel for="subcategory_id" value="Subcategorias:"></InputLabel>
                                    <SelectInputSubCategory id="subcategory_id" :options="subcategories"
                                    v-model="form.subcategory_title" type="text" class="mt-1 block">
                                    </SelectInputSubCategory>
                                    <InputError :message="form.errors.subcategory_title" class="mt-2"></InputError>
                                </div>
                                
                                <div class="sm:col-span-2">
                                    <InputLabel for="unity_id" value="Unidade:"></InputLabel>
                                    <SelectInputUnity id="unity_id" :options="unities"
                                    v-model="form.unity_name" type="text" class="mt-1 block">
                                    </SelectInputUnity>
                                    <InputError :message="form.errors.unity_name" class="mt-2"></InputError>
                                </div>

                                 <div class="sm:col-span-2">                       
                                    <InputLabel for="initial_stock" value="Estoque Inicial"></InputLabel>
                                    <TextInput id="initial_stock" v-model="form.initial_stock" required
                                    type="text" class="mt-1 block"></TextInput>
                                    <InputError :message="form.errors.initial_stock" class="mt-2"></InputError>
                                </div>

                                <div class="sm:col-span-2">                       
                                    <InputLabel for="maximum_stock" value="Estoque Máximo"></InputLabel>
                                    <TextInput id="maximum_stock" v-model="form.maximum_stock" required
                                    type="text" class="mt-1 block"></TextInput>
                                    <InputError :message="form.errors.maximum_stock" class="mt-2"></InputError>
                                </div>

                                <div class="sm:col-span-1 sm:col-start-1">                       
                                    <InputLabel for="minimum_stock" value="Estoque Mínino"></InputLabel>
                                    <TextInput id="minimum_stock" v-model="form.minimum_stock" required
                                    type="text" class="mt-1 block"></TextInput>
                                    <InputError :message="form.errors.minimum_stock" class="mt-2"></InputError>
                                </div>

                                <div class="sm:col-span-1">                       
                                    <InputLabel for="cost_price" value="Preço custo"></InputLabel>
                                    <TextInput id="cost_price" v-model="form.cost_price" required placeholder="0,00"
                                    type="text" class="mt-1 block"></TextInput>
                                    <InputError :message="form.errors.cost_price" class="mt-2"></InputError>
                                </div>

                                <div class="sm:col-span-2">                       
                                    <InputLabel for="markup" value="(%) Margem Lucro"></InputLabel>
                                    <TextInput id="markup" v-model="form.markup" required placeholder="0,00"
                                    type="text" class="mt-1 block"></TextInput>
                                    <InputError :message="form.errors.markup" class="mt-2"></InputError>
                                </div>

                                <div class="sm:col-span-2">                       
                                    <InputLabel for="sale_price" value="Preço venda"></InputLabel>
                                    <TextInput id="sale_price" 
                                     v-model="form.sale_price" required placeholder="0,00"
                                    type="text" class="mt-1 block">{{  showMoney(form.sale_price) }}</TextInput>
                                    <InputError :message="form.errors.sale_price" class="mt-2"></InputError>
                                </div>



                                <div class="col-span-full">
                                    <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Descrição do produto</label>
                                    <div class="mt-2">
                                        <textarea id="description" v-model="form.description" rows="3" class="block w-full rounded-md border-1 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                        <InputError :message="form.errors.description" class="mt-2"></InputError>
                                    </div>
                                    <p class="mt-3 text-sm leading-6 text-gray-600">Detalhe seu produto acima.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">                      
                            <PrimaryButton :disabled="form.processing">
                                <i class="fa-solid fa-save"></i> Salvar
                            </PrimaryButton>
                        </div>
               
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { reactive } from 'vue';  
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputError from '@/Components/InputError.vue';
import SelectInput from '@/Components/SelectInput.vue';
import SelectInputCategory from '@/Components/SelectInputCategory.vue';
import SelectInputUnity from '@/Components/SelectInputUnity.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { PlusIcon, InboxArrowDownIcon,PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/outline';
import { Link } from '@inertiajs/vue3';
import { showMoney,MoneyToDB} from '@/Money'
import SelectInputSubCategory from '@/Components/SelectInputSubCategory.vue';

const options = reactive({
    mask: "###.###,##",
    eager: true
 
});


const props = defineProps({
      categories: Object,
      subcategories: Object,
      unities: Object
});

const form = useForm({
    product_name: '',
    sale_price: '',
});
</script>
