<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: String,
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <Head title="Verificar E-mail" />
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="card shadow-sm p-4">
                    <h3><i class="fas fa-envelope-open-text"></i> Verifique seu e-mail</h3>
                    <p class="mb-4 text-muted">Antes de continuar, por favor verifique seu e-mail para um link de verificação.</p>

                    <div v-if="status === 'verification-link-sent'" class="alert alert-success" role="alert">
                        Um novo link de verificação foi enviado para seu e-mail.
                    </div>

                    <form @submit.prevent="sendVerification" class="d-inline">
                        <button type="submit" class="btn btn-primary me-3" :disabled="processing">
                            Reenviar link de verificação
                        </button>
                    </form>

                    <form @submit.prevent="logout" class="d-inline">
                        <button type="submit" class="btn btn-outline-secondary">
                            Sair
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
