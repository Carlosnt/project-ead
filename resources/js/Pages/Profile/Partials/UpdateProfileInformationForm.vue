<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

const modal = ref(false);
const title = ref('');
const id = ref('');

const openModal = (name, user) =>{
    modal.value = true;
    id.value = user;
    title.value = 'Adicionar foto em '+name;
}

const closeModal = () => {
    modal.value = false;
    formImage.clearErrors();
    formImage.reset();
}

const formImage = useForm({
    image: ''
});

const submitForm = () => {
    formImage.post(route('admin.profile.update.image', id.value), {
        forceFormData: true,
        onSuccess: () => {message('Foto atualizada com sucesso!')},

    })
};

const message = (msg) =>{
    form.reset();
    closeModal();
    Swal.fire({title:msg, icon:'success'});
}


defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Informações do perfil</h2>

            <p class="mt-1 text-sm text-gray-600">
                Edite sua informações do perfil e endereço de e-mail.
            </p>
        </header>
        <div class="grid grid-cols-2 gap-2">
            <form @submit.prevent="form.patch(route('admin.profile.update'))" class="mt-6 space-y-6">
                <div>
                    <InputLabel for="name" value="Nome" />

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div>
                    <InputLabel for="email" value="E-mail" />

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autocomplete="username"
                    />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div v-if="mustVerifyEmail && user.email_verified_at === null">
                    <p class="text-sm mt-2 text-gray-800">
                        Seu endereço de e-mail ainda não foi verificado.
                        <Link
                            :href="route('verification.send')"
                            method="post"
                            as="button"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Clicque aqui para reenviar a verificação de email.
                        </Link>
                    </p>

                    <div
                        v-show="status === 'verification-link-sent'"
                        class="mt-2 font-medium text-sm text-green-600"
                    >
                        Um novo link para verificação de email foi enviado para seu endereço de e-mail.
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <PrimaryButton :disabled="form.processing">Salvar</PrimaryButton>

                    <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                        <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Salvar.</p>
                    </Transition>
                </div>
            </form>

            <div class="flex items-center justify-center gap-x-6">
                <a @click="event => openModal(user.name, user.id)" class="cursor-pointer items-center">
                <img class="h-48 w-48 rounded-full"  :src="user.photo"/>
                </a>
            </div>
        </div>
    </section>
    <Modal :show="modal" @close="closeModal">
                <form v-on:submit.prevent="submitForm()">
                <h2 class="p-3 pt-3 text-lg text-center font.medium text-hray-900">{{ title}}</h2>
                <div class="p-3 mt-3">
                    <InputLabel for="image" value="Imagem"></InputLabel>
                    <input id="image" name="image" class="block w-full w-3/4 rounded-md form-input focus:border-indigo-600"
                    @input="formImage.image = $event.target.files[0]" type="file" />
                    <InputError :message="formImage.errors.image" class="mt-2"></InputError>
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
</template>
