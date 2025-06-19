<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-vh-100 d-flex align-items-center justify-content-center bg-light">
        <div class="w-100" style="max-width: 500px">
            <slot />
        </div>
    </div>
</template>
