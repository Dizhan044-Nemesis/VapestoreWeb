<script setup>
    //import ref
    import { ref } from "vue";
 
    //import router
    import { useRouter } from 'vue-router';
 
    //import api
    import api from "../../api";
 
    //init router
    const router = useRouter();
 
    //define state
    const name = ref("");
    const email = ref("");
    const phone = ref("");
    const address = ref("");
    const category = ref("");
    const totalPrice = ref("");
    const status = ref("");
    const paymentMethod = ref("");
    const errors = ref([]);
 
    //method "storeOrder"
    const storeOrder = async () => {
        //init formData
        let formData = new FormData();
 
        //assign state value to formData
        formData.append("name", name.value);
        formData.append("email", email.value);
        formData.append("phone", phone.value);
        formData.append("address", address.value);
        formData.append("category", category.value);
        formData.append("total_price", totalPrice.value);
        formData.append("status", status.value);
        formData.append("payment_method", paymentMethod.value);
 
        //store data with API
        await api.post('/api/order', formData)
        .then(() => {
            //redirect
            router.push({ path: "/orders" });
        })
        .catch((error) => {
            //assign response error data to state "errors"
            errors.value = error.response.data;
        });
    };
</script>
 
<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <form @submit.prevent="storeOrder()">
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
                                <input type="text" class="form-control" v-model="totalPrice" placeholder="Enter Total Price">
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
                                <input type="text" class="form-control" v-model="paymentMethod" placeholder="Enter Payment Method">
                                <div v-if="errors.payment_method" class="alert alert-danger mt-2">
                                    <span>{{ errors.payment_method[0] }}</span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-md btn-primary rounded-sm shadow border-0">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
