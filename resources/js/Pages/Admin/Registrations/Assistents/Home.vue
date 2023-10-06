<template>
    <Head title="Auxiliares" />

    <AuthenticatedLayout>
       
        <div class="border-b border-gray-200 pb-5 sm:flex sm:items-center sm:justify-between">
            
            <h3 class="text-lg font-semibold leading-6 text-gray-900">Gerenciar nossos cadastros auxíliares</h3>

            <div class="mt-3 sm:ml-4 sm:mt-0">        
                <Link :href="route('admin.dashboard')" 
                    :class="'inline-flex items-center rouneded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:ring-4 focus:visible:outline rounded-lg  px-5 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-blue-800'">
                    <span class="flex items-center gap-x-3">
                        <ArrowUturnLeftIcon class="w-5 h-5 shrink-0"/> 
                        Voltar
                    </span>
                </Link>  
            </div>           
        </div>

        <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2 xl:grid-cols-3">
            <div class="flex flex-col rounded-lg bg-white md:max-w-xl md:flex-row">
                <span class="flex items-center gap-x-3 p-7">
                    <TagIcon class="w-10 h-10 shrink-0 "/>                    
                </span>
                <div class="flex flex-col justify-start p-6">
                    <h5
                    class="mb-2 text-xl text-gray-900 font-medium">
                    Categorias
                    
                    </h5>
                    <p class="mb-4 text-base text-green-600">                    
                    {{  categories ?? 0 }} +
                    </p>
                    <Link :href="route('admin.cadastros.categories.index')" 
                        :class="'inline-flex items-center rouneded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:ring-4 focus:visible:outline rounded-lg  px-5 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-blue-800'">
                        <span class="flex items-center gap-x-3">
                            <PlusIcon class="w-5 h-5 shrink-0"/> 
                            Gerenciar
                        </span>
                    </Link>  
                </div>
            </div>

            <div class="flex flex-col rounded-lg bg-white md:max-w-xl md:flex-row">
                <span class="flex items-center gap-x-3 p-7">
                    <RectangleGroupIcon class="w-10 h-10 shrink-0 "/>                    
                </span>
                <div class="flex flex-col justify-start p-6">
                    <h5
                    class="mb-2 text-xl text-gray-900 font-medium">
                    Subategorias
                    </h5>
                    <p class="mb-4 text-base text-green-600">
                    {{  subcategories ?? 0 }} +
                    </p>
                    <Link :href="route('admin.cadastros.subcategories.index')" 
                        :class="'inline-flex items-center rouneded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:ring-4 focus:visible:outline rounded-lg  px-5 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-blue-800'">
                        <span class="flex items-center gap-x-3">
                            <PlusIcon class="w-5 h-5 shrink-0"/> 
                            Gerenciar
                        </span>
                    </Link>  
                </div>
            </div>

            <div class="flex flex-col rounded-lg bg-white md:max-w-xl md:flex-row">
                <span class="flex items-center gap-x-3 p-7">
                    <CubeIcon class="w-10 h-10 shrink-0"/>                    
                </span>
                <div class="flex flex-col justify-start p-6">
                    <h5
                    class="mb-2 text-xl text-gray-900 font-medium">
                    Unidades
                    </h5>
                    <p class="mb-4 text-base text-green-600">
                        {{  unities ?? 0 }} +
                    </p>
                    <Link :href="route('admin.cadastros.unities.index')" 
                        :class="'inline-flex items-center rouneded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:ring-4 focus:visible:outline rounded-lg  px-5 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-blue-800'">
                        <span class="flex items-center gap-x-3">
                            <PlusIcon class="w-5 h-5 shrink-0"/> 
                            Nova Unidade
                        </span>
                    </Link> 
                </div>
            </div>
            <div class="flex flex-col rounded-lg bg-white md:max-w-xl md:flex-row">
                <span class="flex items-center gap-x-3 p-7">
                    <BanknotesIcon class="w-10 h-10 shrink-0"/>                    
                </span>
                <div class="flex flex-col justify-start p-6">
                    <h5
                    class="mb-2 text-xl text-gray-900 font-medium">
                    Banco
                    </h5>
                    <p class="mb-4 text-base text-green-600">
                    {{ banks ?? 0 }} +
                    </p>
                    <Link :href="route('admin.cadastros.banks.index')" 
                        :class="'inline-flex items-center rouneded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:ring-4 focus:visible:outline rounded-lg  px-5 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-blue-800'">
                        <span class="flex items-center gap-x-3">
                            <PlusIcon class="w-5 h-5 shrink-0"/> 
                            Novo Banco
                        </span>
                    </Link>  
                </div>
            </div>

            <div class="flex flex-col rounded-lg bg-white md:max-w-xl md:flex-row">
                <span class="flex items-center gap-x-3 p-7">
                    <CurrencyDollarIcon class="w-10 h-10 shrink-0"/>                    
                </span>
                <div class="flex flex-col justify-start p-6">
                    <h5
                    class="mb-2 text-xl text-gray-900 font-medium">
                    Tipo Conta corrente
                    </h5>
                    <p class="mb-4 text-base text-green-600">
                    {{ type_current_accounts ?? 0 }} +
                    </p>
                    <Link :href="route('admin.cadastros.type-current-accounts.index')" 
                        :class="'inline-flex items-center rouneded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:ring-4 focus:visible:outline rounded-lg  px-5 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-blue-800'">
                        <span class="flex items-center gap-x-3">
                            <PlusIcon class="w-5 h-5 shrink-0"/> 
                            Novo Conta
                        </span>
                    </Link>  
                </div>
            </div>

            <div class="flex flex-col rounded-lg bg-white md:max-w-xl md:flex-row">
                <span class="flex items-center gap-x-3 p-7">
                    <HandThumbUpIcon class="w-10 h-10 shrink-0"/>                    
                </span>
                <div class="flex flex-col justify-start p-6">
                    <h5
                    class="mb-2 text-xl text-gray-900 font-medium">
                    Status
                    </h5>
                    <p class="mb-4 text-base text-green-600">
                    {{  status ?? 0}} +
                    </p>
                    <Link :href="route('admin.cadastros.statuses.index')" 
                        :class="'inline-flex items-center rouneded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:ring-4 focus:visible:outline rounded-lg  px-5 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-blue-800'">
                        <span class="flex items-center gap-x-3">
                            <PlusIcon class="w-5 h-5 shrink-0"/> 
                            Novo Status
                        </span>
                    </Link>  
                </div>
            </div>

            <div class="flex flex-col rounded-lg bg-white md:max-w-xl md:flex-row">
                <span class="flex items-center gap-x-3 p-7">
                    <HandThumbUpIcon class="w-10 h-10 shrink-0"/>                    
                </span>
                <div class="flex flex-col justify-start p-6">
                    <h5
                    class="mb-2 text-xl text-gray-900 font-medium">
                    Forma pagamento
                    </h5>
                    <p class="mb-4 text-base text-green-600">
                    {{ payment_methods ?? 0}} +
                    </p>
                    <Link :href="route('admin.cadastros.payment-methods.index')" 
                        :class="'inline-flex items-center rouneded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:ring-4 focus:visible:outline rounded-lg  px-5 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-blue-800'">
                        <span class="flex items-center gap-x-3">
                            <PlusIcon class="w-5 h-5 shrink-0"/> 
                            Nova forma
                        </span>
                    </Link>  
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ArrowUturnLeftIcon, TagIcon,PlusIcon, BanknotesIcon, CubeIcon, CurrencyDollarIcon, TrashIcon, HandThumbUpIcon, RectangleGroupIcon } from '@heroicons/vue/24/outline';
import { Head,Link } from '@inertiajs/vue3';


const props = defineProps({
    categories: {type:Number},
    subcategories: {type:Number},
    unities: {type:Number},
    banks: {type:Number},
    type_current_accounts: {type:Number},
    status: {type:Number},
    payment_methods: {type:Number}
})

</script>
