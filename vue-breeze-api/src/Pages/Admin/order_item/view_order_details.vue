<script setup>

import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
const router = useRouter();
import { useRoute } from 'vue-router'
const route = useRoute()
//---------------------------
onMounted(async () => {
    getOrderItemByOrderId();
});
//--------------------------------------
const getOrderItemByOrderId = async () =>{
    const id = route.params.id;
    // console.log('routhiuhuunje', id);
    let response = await axios.get(`/api/getOrderItemByOrderId/${id}`);
    // form.value = response.data.product
    console.log('responseydyhfb', response.data);
}

</script>


<template>
    <div>
        <h1>View order details</h1>
    </div>
</template>

<style lang="scss" scoped>

</style>