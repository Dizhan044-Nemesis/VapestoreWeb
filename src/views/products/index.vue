<script setup>
 
    // Import ref and onMounted
    import { ref, onMounted } from 'vue';
 
    // Import API
    import api from '../../api';
 
    // Define state
    const product = ref([]);
 
    // Method fetchDataProduct
    const fetchDataProduct = async () => {
 
        // Fetch data
        await api.get('/api/product')
        .then(response => {
            // Set response data to state "product"
            product.value = response.data.data.data;
        });
    };
 
    // Run hook "onMounted"
    onMounted(() => {
        // Call method "fetchDataProduct"
        fetchDataProduct();
    });
 
    // Method deleteProduct
    const deleteProduct = async (id) => {
        // Delete product with API
        await api.delete(`/api/product/${id}`)
        .then(() => {
            // Call method "fetchDataProduct"
            fetchDataProduct();
        });
    };
</script>
 
<template>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <router-link :to="{ name: 'product.create' }" class="btn btn-md btn-success rounded shadow border-0 mb-3">ADD NEW PRODUCT</router-link>
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col" style="width:15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="product.length == 0">
                                    <td colspan="6" class="text-center">
                                        <div class="alert alert-danger mb-0">
                                            Data Not Available!
                                        </div>
                                    </td>
                                </tr>
                                <tr v-else v-for="(item, index) in product" :key="index">
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.category }}</td>
                                    <td>{{ item.description }}</td>
                                    <td>{{ item.price }}</td>
                                    <td>{{ item.stock }}</td>
                                    <td class="text-center">
                                        <router-link :to="{ name: 'product.edit', params:{id: item.id} }" class="btn btn-sm btn-primary rounded-sm shadow border-0 me-2">EDIT</router-link>
                                        <button @click.prevent="deleteProduct(item.id)" class="btn btn-sm btn-danger rounded-sm shadow border-0">DELETE</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</template>
