<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const selectedProductId = ref(null);
const showModal = ref(false);

const confirmDelete = (productId) => {
    selectedProductId.value = productId;
    showModal.value = true;
};

const deleteProduct = () => {
    router.delete(route('products.destroy', selectedProductId.value), {
        onSuccess: () => {
            showModal.value = false;
            selectedProductId.value = null;
        }
    });
};

const props = defineProps({
    products: Object,
    q: String,
});

const stripHtml = (html) => {
    return html.replace(/<[^>]*>?/gm, '');
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="row">
            <div class="col-md-3 order-2 order-md-1">
                <form>
                    <div class="input-group my-3">
                        <input type="text" class="form-control" placeholder="Pesquisar" aria-describedby="button-addon2" name="q" :value="q">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
                <div class="list-group">
                    <Link :href="route('products.create')" class="list-group-item list-group-item-action">
                        <i class="fa-solid fa-square-plus"></i> Cadastrar Produto
                    </Link>
                </div>
            </div>

            <div class="col-md-9 order-1 order-md-2">
                <div class="row">
                    <div class="col-md-4 mb-3" v-for="product in products.data" :key="product.id">
                        <div class="card h-100">
                            <div class="card-header">
                                <h6 class="card-title m-0">{{ product.title }}</h6>
                            </div>

                            <Link :href="route('products.edit', product.id)">
                                <img
                                    :src="product.images?.[0]?.path ? `/storage/${product.images[0].path}` : '/img/no-image.jpeg'"
                                    :alt="product.title"
                                    class="img-fluid"
                                />
                            </Link>

                            <div class="card-body">
                                <p class="card-text">{{ stripHtml(product.description).slice(0, 100) }}...</p>
                                <p class="mb-0"><strong>Preço:</strong> R$ {{ product.sale_price }}</p>
                            </div>

                            <div class="card-footer text-end">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-danger" @click="confirmDelete(product.id)">Deletar</button>
                                    <Link :href="route('products.edit', product.id)" class="btn btn-sm btn-outline-primary">Editar</Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <nav v-if="products.links.length > 3" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li
                            v-for="link in products.links"
                            :key="link.label"
                            :class="['page-item', { active: link.active, disabled: !link.url }]"
                        >
                            <Link
                                v-if="link.url"
                                :href="link.url"
                                class="page-link"
                                v-html="link.label"
                            />
                            <span v-else class="page-link" v-html="link.label" />
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </AuthenticatedLayout>

    <div class="modal fade" :class="{ show: showModal }" style="display: block;" tabindex="-1" role="dialog" v-if="showModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" @click="showModal = false"></button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja deletar este produto?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="showModal = false">Cancelar</button>
                    <button type="button" class="btn btn-danger" @click="deleteProduct">Deletar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show" v-if="showModal"></div>
</template>
