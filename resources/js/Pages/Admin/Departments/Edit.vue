<template>
    <Head title="Edição departamento" />

    <AuthenticatedLayout>
        <template #header>
            Editar departamento
        </template>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <form @submit.prevent="$event => form.patch(route('admin.departments.update', department))"
                    class="mt-6 space-y-6 max-w-xl">
                    <InputLabel for="name" value="Departamento"></InputLabel>
                    <TextInput id="name" v-model="form.name" autofocus required
                    type="text" class="mt-1 block w-full"></TextInput>
                    <InputError :message="form.errors.name" class="mt-2"></InputError>
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
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({ department: {type:Object} });
const form = useForm({
    name: props.department.name
});
</script>
