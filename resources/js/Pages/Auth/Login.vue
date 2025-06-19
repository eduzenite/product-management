<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Entrar" />
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        <h4><i class="fas fa-sign-in-alt"></i> Login</h4>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submit">
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input id="email" type="email" v-model="form.email" required autofocus class="form-control" />
                                <div v-if="form.errors.email" class="text-danger small mt-1">{{ form.errors.email }}</div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input id="password" type="password" v-model="form.password" required autocomplete="current-password" class="form-control" />
                                <div v-if="form.errors.password" class="text-danger small mt-1">{{ form.errors.password }}</div>
                            </div>

                            <div class="mb-3 form-check">
                                <input id="remember" type="checkbox" v-model="form.remember" class="form-check-input" />
                                <label for="remember" class="form-check-label">Lembrar-me</label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100" :disabled="form.processing">
                                Entrar
                            </button>
                        </form>

                        <div class="mt-3 text-center d-flex justify-content-between">
                            <Link href="/forgot-password" class="text-decoration-none">
                                Esqueceu sua senha?
                            </Link>

                            <Link href="/register" class="text-decoration-none">
                                Criar conta
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
