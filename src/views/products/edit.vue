<script setup>
    // Import ref, onMounted, useRouter, dan useRoute
    import { ref, onMounted } from "vue";
    import { useRouter, useRoute } from "vue-router";

    // Import API
    import api from "../../api";

    // Init router dan route
    const router = useRouter();
    const route = useRoute();

    // Define state
    const name = ref("");
    const category = ref("");
    const description = ref("");
    const price = ref(0);
    const stock = ref(0);
    const errors = ref([]);

    // Fetch data produk saat komponen dimuat
    onMounted(async () => {
        try {
            const response = await api.get(`/api/product/${route.params.id}`);
            const product = response.data.data;
            name.value = product.name;
            category.value = product.category;
            description.value = product.description;
            price.value = product.price;
            stock.value = product.stock;
        } catch (error) {
            errors.value = error.response?.data || { message: "Failed to fetch product details." };
        }
    });

    // Method untuk memperbarui produk
    const updateProduct = async () => {
        try {
            // Init formData
            let formData = new FormData();
            formData.append("name", name.value);
            formData.append("category", category.value);
            formData.append("description", description.value);
            formData.append("price", price.value);
            formData.append("stock", stock.value);
            formData.append("_method", "PATCH");

            // Kirim data ke API
            await api.post(`/api/product/${route.params.id}`, formData);

            // Redirect ke halaman produk
            router.push({ path: "/product" });
        } catch (error) {
            // Tampilkan error
            errors.value = error.response?.data || { message: "Failed to update product." };
        }
    };
</script>

<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <form @submit.prevent="updateProduct()">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    v-model="name" 
                                    placeholder="Product Name"
                                >
                                <div v-if="errors.name" class="alert alert-danger mt-2">
                                    <span>{{ errors.name[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Category</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    v-model="category" 
                                    placeholder="Product Category"
                                >
                                <div v-if="errors.category" class="alert alert-danger mt-2">
                                    <span>{{ errors.category[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea 
                                    class="form-control" 
                                    v-model="description" 
                                    rows="3" 
                                    placeholder="Product Description"
                                ></textarea>
                                <div v-if="errors.description" class="alert alert-danger mt-2">
                                    <span>{{ errors.description[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Price</label>
                                <input 
                                    type="number" 
                                    class="form-control" 
                                    v-model="price" 
                                    placeholder="Product Price"
                                >
                                <div v-if="errors.price" class="alert alert-danger mt-2">
                                    <span>{{ errors.price[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Stock</label>
                                <input 
                                    type="number" 
                                    class="form-control" 
                                    v-model="stock" 
                                    placeholder="Product Stock"
                                >
                                <div v-if="errors.stock" class="alert alert-danger mt-2">
                                    <span>{{ errors.stock[0] }}</span>
                                </div>
                            </div>
                            <button 
                                type="submit" 
                                class="btn btn-md btn-primary rounded-sm shadow border-0"
                            >
                                Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
