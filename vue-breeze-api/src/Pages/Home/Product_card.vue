<script setup>
import {
    defineProps
} from "vue";

const props = defineProps(["product"]);
import rating from '../product_details/rating.vue';

import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
const router = useRouter();
import { useRoute } from 'vue-router'
const route = useRoute()

const ratings = ref([]);

onMounted(async () => {
    averageRating();
});

const averageRating = async () => {
    const id = props.product.id;
    // console.log('routhiuhuunje', id);
    let response = await axios.get(`/api/average_rating/${id}`);
    product.value = response.data.product
    console.log('responseydyhfb 55', product.value.Target);
}

</script>

<template>
   
    <div class="product-card">
        <div class="badge">Hot</div>
        <div class="product-tumb">
            <router-link :to="{ name: 'product-details', params: { id: props.product.id }}" >
            <img :src=" props.product.product_img" alt="">
            </router-link>
        </div>
        <div class="product-details">
            <span class="product-catagory">{{ props.product.brand.brand_name  }}, {{ props.product.category.category_name }}</span>
            <h4><router-link :to="{ name: 'product-details', params: { id: props.product.id }}" >{{ props.product.product_name }} </router-link></h4>
            <p><router-link :to="{ name: 'product-details', params: { id: props.product.id }}" style="text-decoration: none;">{{ props.product.short_description }}{!! Str::limit($item->blog_description, 200) !!} </router-link> </p>
            <div class="product-bottom-details">
                <!-- <p>
                    <rating :rating="props.product?.average_rating"></rating>
                </p> -->
                <div class="product-price"> ${{ props.product.product_price }}</div>
            </div>
        </div>
    </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css?family=Roboto:400,500,700');

* {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}


body {
    font-family: 'Poppins', sans-serif;
}

a {
    text-decoration: none;
}

.product-card {
    width: calc(25% - 25px);
    position: relative;
    border-radius: 8px;
}

.badge {
    position: absolute;
    left: 0;
    top: 20px;
    text-transform: uppercase;
    font-size: 13px;
    font-weight: 700;
    background: red;
    color: #fff;
    padding: 3px 10px;
}

.product-tumb {
    display: flex;
    justify-content: center;
    height: 320px;
    width: 100%;
    overflow: hidden;
    border-radius: 5px;
    background: #f0f0f0;
}

.product-tumb img {
    width: 100%;
    height: 100%;
}

.product-details {
    padding: 30px 0px;

}

.product-catagory {
    display: block;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    color: #ccc;
    margin-bottom: 18px;
}

.product-details h4 a {
    display: block;
    margin-bottom: 18px;
    font-size: 15px;
    font-weight: 600;
    color: #0d2235;
    text-decoration: none;
    transition: 0.3s;
    font-family: 'Poppins', sans-serif;
}
.product-details p a{
    font-weight: 500;
    display: block;
    margin-bottom: 20px;
    color: #7c7878cc;
    text-decoration: none;
    transition: 0.3s;
}

.product-details h4 a:hover {
    color: #009688;
}

.product-details p {
    font-size: 15px;
    line-height: 22px;
    margin-bottom: 18px;
    color: #999;
}

.product-bottom-details {
    overflow: hidden;
    border-top: 1px solid #eee;
    padding-top: 20px;
}

.product-bottom-details div {
    float: left;
    width: 50%;
}

.product-price {
    font-size: 15px;
    color: #232630;
    font-weight: 800;
    font-family: Poppins, sans-serif;
}

.product-price small {
    font-size: 80%;
    font-weight: 400;
    text-decoration: line-through;
    display: inline-block;
    margin-right: 5px;
}

.product-links {
    text-align: right;
}

.product-links a {
    display: inline-block;
    margin-left: 5px;
    color: #e1e1e1;
    transition: 0.3s;
    font-size: 17px;
}

.product-links a:hover {
    color: #fbb72c;
}
</style>