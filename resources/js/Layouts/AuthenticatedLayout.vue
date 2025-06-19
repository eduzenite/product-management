<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'
import NavLink from '@/Components/NavLink.vue'
import config from "tailwindcss/defaultConfig";
import { usePage } from '@inertiajs/vue3'

const showingNavigationDropdown = ref(false)
const page = usePage()
const appName = page.props.appName
</script>

<template>
    <div class="border-bottom py-3 mb-4">
        <div class="container">
            <header class="d-flex flex-wrap justify-content-center">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                    <i class="fa-solid fa-heart-pulse fa-2x me-2"></i>
                    <h4 class="d-inline">{{ appName }}</h4>
                </a>

                <ul class="nav nav-pills">
                    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                        Início
                    </NavLink>
                    <NavLink :href="route('profile.edit')" :active="route().current('profile.edit')">
                        Perfil
                    </NavLink>
                    <NavLink :href="route('logout')" method="post" as="button">
                        Sair
                    </NavLink>
                </ul>
            </header>
        </div>
    </div>
    <div class="container">
        <slot />
    </div>
</template>
