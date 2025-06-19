<script setup>
import { onMounted, ref, watch } from 'vue';
import Quill from 'quill';

const props = defineProps({
    modelValue: String
});

const emit = defineEmits(['update:modelValue']);
const editor = ref(null);
let quill;

onMounted(() => {
    quill = new Quill(editor.value, {
        theme: 'snow',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'header': 1 }, { 'header': 2 }]
            ]
        }
    });

    quill.root.innerHTML = props.modelValue || '';

    quill.on('text-change', () => {
        let html = quill.root.innerHTML;
        emit('update:modelValue', html);
    });
});

watch(() => props.modelValue, (newValue) => {
    if (quill && quill.root.innerHTML !== newValue) {
        quill.root.innerHTML = newValue;
    }
});
</script>

<template>
    <div ref="editor" style="min-height: 200px; background-color: white;"></div>
</template>

<style>
@import 'quill/dist/quill.snow.css';
</style>
