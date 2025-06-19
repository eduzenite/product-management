<script setup>
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps(['href', 'active'])

const classes = computed(() =>
    props.active
        ? 'nav-link active fw-bold'
        : 'nav-link'
)
</script>

<template>
    <li class="nav-item">
        <Link :href="href" :class="classes">
            <slot />
        </Link>
    </li>
</template>
