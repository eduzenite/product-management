<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Redefinir Senha" />
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        <h4><i class="fas fa-key"></i> Redefinir senha</h4>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submit">
                            <input type="hidden" :value="token" name="token" />

                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input id="email" type="email" v-model="form.email" required autofocus class="form-control" />
                                <div v-if="form.errors.email" class="text-danger small mt-1">{{ form.errors.email }}</div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Nova senha</label>
                                <input id="password" type="password" v-model="form.password" required autocomplete="new-password" class="form-control" />
                                <div v-if="form.errors.password" class="text-danger small mt-1">{{ form.errors.password }}</div>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirmar nova senha</label>
                                <input id="password_confirmation" type="password" v-model="form.password_confirmation" required autocomplete="new-password" class="form-control" />
                                <div v-if="form.errors.password_confirmation" class="text-danger small mt-1">{{ form.errors.password_confirmation }}</div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100" :disabled="form.processing">
                                Redefinir senha
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
