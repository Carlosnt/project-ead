<template>
    <Head title="Cadastrar Suporte" />

    <AuthenticatedLayout>
        <template #header>
            Novo Suporte
        </template>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <form @submit.prevent="$event => form.post(route('admin.supports.store'))">
                    <div class="space-y-12">
                        <div class="pb-12">                          

                            <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="col-span-full">
                                    <label for="subject" class="block text-sm font-medium leading-6 text-gray-900">Assunto</label>
                                    <div class="mt-2">
                                        <input type="text" v-model="form.subject" id="subject" autocomplete="Assunto" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                        <InputError :message="form.errors.subject" class="mt-2"></InputError>
                                    </div>
                                </div>

                                <div class="col-span-full">
                                    <label for="body" class="block text-sm font-medium leading-6 text-gray-900">Messagem</label>
                                    <div class="mt-2">
                                        <textarea id="body" v-model="form.body" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                        <InputError :message="form.errors.body" class="mt-2"></InputError>
                                    </div>
                                    <p class="mt-3 text-sm leading-6 text-gray-600">Deixe sua dúvida ou comentário aqui.</p>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                    <PrimaryButton :disabled="form.processing">
                        <i class="fa-solid fa-save"></i> Salvar
                    </PrimaryButton>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextInputArea from '@/Components/TextInputArea.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    subject: '',
    body: ''
});
</script>
