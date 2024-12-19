<script setup>
 
    //import ref and onMounted
    import { ref, onMounted } from 'vue';
 
    //import api
    import api from '../../api';
 
    //define state
    const orders = ref([]);
 
    //method fetchDataorders
    const fetchDataorders = async () => {
        try {
            //fetch data 
            const response = await api.get('/api/order');
            //set response data to state "orders"
            orders.value = response.data.data.data;
        } catch (error) {
            console.error("Error fetching orders:", error);
        }
    };
 
    //run hook "onMounted"
    onMounted(() => {
        //call method "fetchDataorders"
        fetchDataorders();
    });
 
    //method deleteorders
    const deleteorders = async (id) => {
        try {
            //delete orders with API
            await api.delete(`/api/order/${id}`);
            //call method "fetchDataorders"
            fetchDataorders();
        } catch (error) {
            console.error("Error deleting order:", error);
        }
    };
 
</script>
 
<template>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <router-link :to="{ name: 'orders.create' }" class="btn btn-md btn-success rounded shadow border-0 mb-3">ADD NEW ORDER</router-link>
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Payment Method</th>
                                    <th scope="col" style="width:15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="orders.length === 0">
                                    <td colspan="9" class="text-center">
                                        <div class="alert alert-danger mb-0">
                                            Data Belum Tersedia!
                                        </div>
                                    </td>
                                </tr>
                                <tr v-else v-for="(order, index) in orders" :key="index">
                                    <td>{{ order.name }}</td>
                                    <td>{{ order.email }}</td>
                                    <td>{{ order.phone }}</td>
                                    <td>{{ order.address }}</td>
                                    <td>{{ order.category }}</td>
                                    <td>{{ order.total_price }}</td>
                                    <td>{{ order.status }}</td>
                                    <td>{{ order.payment_method }}</td>
                                    <td class="text-center">
                                        <router-link :to="{ name: 'orders.edit', params:{id: order.id} }" class="btn btn-sm btn-primary rounded-sm shadow border-0 me-2">EDIT</router-link>
                                        <button @click.prevent="deleteorders(order.id)" class="btn btn-sm btn-danger rounded-sm shadow border-0">DELETE</button>
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
