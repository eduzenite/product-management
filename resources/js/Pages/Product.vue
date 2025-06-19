<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import { ref, watch } from 'vue'
import WysiwygEditor from '@/Components/WysiwygEditor.vue'

const props = defineProps({
    product: {
        type: Object,
        default: () => ({
            title: '',
            sale_price: '',
            cost_price: '',
            description: '',
            images: []
        })
    },
    images: {}
})

const isEdit = !!props.product.id

const form = useForm({
    title: props.product.title,
    sale_price: props.product.sale_price,
    cost_price: props.product.cost_price,
    description: props.product.description,
    images: []
})

const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

const images = props.product.images

const selectedImages = ref([])

watch(() => form.images, (newImages) => {
    selectedImages.value = []
    if (newImages && newImages.length) {
        for (const file of newImages) {
            const reader = new FileReader()
            reader.onload = e => selectedImages.value.push(e.target.result)
            reader.readAsDataURL(file)
        }
    }
})

const sanitizeDescription = (html) => {
    return html
        .replace(/<(?!\/?(p|br|b|strong)\b)[^>]*>/gi, '') // Remove todas as tags exceto <p>, <br>, <b>, <strong>
}

const submit = () => {
    form.description = sanitizeDescription(form.description)

    if (isEdit) {
        form.post(route('products.update', props.product.id), {
            preserveScroll: true,
            onSuccess: () => form.reset('images'),
            forceFormData: true, // FORÇA envio como multipart
            method: 'put'
        })
    } else {
        form.post(route('products.store'), {
            preserveScroll: true,
            onSuccess: () => form.reset(),
            forceFormData: true
        })
    }
}
</script>

<template>
    <Head :title="isEdit ? 'Editar Produto' : 'Cadastrar Produto'" />

    <AuthenticatedLayout>
        <div class="container py-4">
            <h2 class="mb-4">{{ isEdit ? 'Editar Produto' : 'Cadastrar Produto' }}</h2>

            <form @submit.prevent="submit" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input v-model="form.title" type="text" id="title" class="form-control" :class="{ 'is-invalid': form.errors.title }">
                    <div v-if="form.errors.title" class="invalid-feedback">{{ form.errors.title }}</div>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="sale_price" class="form-label">Preço de Venda</label>
                        <input v-model="form.sale_price" type="number" step="0.01" id="sale_price" class="form-control" :class="{ 'is-invalid': form.errors.sale_price }">
                        <div v-if="form.errors.sale_price" class="invalid-feedback">{{ form.errors.sale_price }}</div>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="cost_price" class="form-label">Preço de Custo</label>
                        <input v-model="form.cost_price" type="number" step="0.01" id="cost_price" class="form-control" :class="{ 'is-invalid': form.errors.cost_price }">
                        <div v-if="form.errors.cost_price" class="invalid-feedback">{{ form.errors.cost_price }}</div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <WysiwygEditor v-model="form.description" />
                    <div v-if="form.errors.description" class="text-danger mt-1">{{ form.errors.description }}</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Imagens (JPG ou PNG)</label>
                    <input
                        type="file"
                        class="form-control"
                        multiple
                        accept="image/jpeg,image/png"
                        @change="e => form.images = Array.from(e.target.files).filter(Boolean)"
                    />
                    <div v-if="form.errors.images" class="text-danger mt-1">{{ form.errors.images }}</div>
                    <div v-if="form.errors['images.0']" class="text-danger mt-1">{{ form.errors['images.0'] }}</div>

                    <div class="mt-3 row" v-if="selectedImages.length">
                        <div class="col-md-2 mb-3" v-for="(img, index) in selectedImages" :key="index">
                            <img :src="img" class="img-fluid border rounded" alt="Preview da imagem" />
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">
                    {{ isEdit ? 'Atualizar Produto' : 'Cadastrar Produto' }}
                </button>
            </form>

            <div v-if="images.length">
                <h3 class="mt-5">Imagens atuais</h3>
                <div class="mt-3 row">
                    <div class="col-md-2 mb-3" v-for="(img, index) in images" :key="index">
                        <img :src="`/storage/${img.path}`" class="img-fluid border rounded mb-2" alt="Preview da imagem" />

                        <form :action="route('product-images.destroy', img.id)" method="POST">
                            <input type="hidden" name="_method" value="DELETE" />
                            <input type="hidden" name="_token" :value="csrf" />
                            <button type="submit" class="btn btn-sm btn-danger w-100">Remover</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
