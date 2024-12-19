<script setup>
    // Import ref dan lifecycle hooks
    import { ref, onMounted } from "vue";

    // Import router dan route
    import { useRouter, useRoute } from "vue-router";

    // Import API
    import api from "../../api";

    // Inisialisasi router dan route
    const router = useRouter();
    const route = useRoute();

    // Definisi state
    const name = ref("");
    const email = ref("");
    const phone = ref("");
    const address = ref("");
    const category = ref("");
    const total_price = ref("");
    const status = ref("");
    const payment_method = ref("");
    const errors = ref([]);

    // Fetch detail order pada mounted
    onMounted(async () => {
        try {
            const response = await api.get(`/api/order/${route.params.id}`);
            const data = response.data.data;

            // Set nilai state dari response
            name.value = data.name;
            email.value = data.email;
            phone.value = data.phone;
            address.value = data.address;
            category.value = data.category;
            total_price.value = data.total_price;
            status.value = data.status;
            payment_method.value = data.payment_method;
        } catch (error) {
            errors.value = error.response?.data || { message: "Failed to fetch order details." };
        }
    });

    // Method untuk update order
    const updatePost = async () => {
        try {
            // Inisialisasi FormData
            let formData = new FormData();

            // Assign nilai state ke FormData
            formData.append("name", name.value);
            formData.append("email", email.value);
            formData.append("phone", phone.value);
            formData.append("address", address.value);
            formData.append("category", category.value);
            formData.append("total_price", total_price.value);
            formData.append("status", status.value);
            formData.append("payment_method", payment_method.value);
            formData.append("_method", "PATCH");

            // Update data dengan API
            await api.post(`/api/order/${route.params.id}`, formData);

            // Redirect ke halaman order
            router.push({ path: "/orders" });
        } catch (error) {
            errors.value = error.response?.data || { message: "Failed to update order." };
        }
    };
</script>

<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <form @submit.prevent="updatePost()">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" class="form-control" v-model="name" placeholder="Enter Name">
                                <div v-if="errors.name" class="alert alert-danger mt-2">
                                    <span>{{ errors.name[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control" v-model="email" placeholder="Enter Email">
                                <div v-if="errors.email" class="alert alert-danger mt-2">
                                    <span>{{ errors.email[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Phone</label>
                                <input type="text" class="form-control" v-model="phone" placeholder="Enter Phone">
                                <div v-if="errors.phone" class="alert alert-danger mt-2">
                                    <span>{{ errors.phone[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Address</label>
                                <textarea class="form-control" v-model="address" rows="3" placeholder="Enter Address"></textarea>
                                <div v-if="errors.address" class="alert alert-danger mt-2">
                                    <span>{{ errors.address[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Category</label>
                                <input type="text" class="form-control" v-model="category" placeholder="Enter Category">
                                <div v-if="errors.category" class="alert alert-danger mt-2">
                                    <span>{{ errors.category[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Total Price</label>
                                <input type="text" class="form-control" v-model="total_price" placeholder="Enter Total Price">
                                <div v-if="errors.total_price" class="alert alert-danger mt-2">
                                    <span>{{ errors.total_price[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <input type="text" class="form-control" v-model="status" placeholder="Enter Status">
                                <div v-if="errors.status" class="alert alert-danger mt-2">
                                    <span>{{ errors.status[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Payment Method</label>
                                <input type="text" class="form-control" v-model="payment_method" placeholder="Enter Payment Method">
                                <div v-if="errors.payment_method" class="alert alert-danger mt-2">
                                    <span>{{ errors.payment_method[0] }}</span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-md btn-primary rounded-sm shadow border-0">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
