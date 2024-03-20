<script setup>
import { useNotification } from "@kyvg/vue3-notification";
const { notify } = useNotification();

import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
const router = useRouter();

const form = ref([]);
const products = ref([]);

onMounted(async () => {
  getProduct();
});

const getProduct = async () => {
  let response = await axios.get("/api/get_product");
  products.value = response.data.products;
  console.log("response", products.value);
};

const deleteProduct = (id) => {
  axios.get(`/api/delete_product/${id}`).then(() => {
    notify({
      title: "Product Item Deleted",
      type: "success",
    });
    getProduct();
  });
};
</script>

<template>
  <div class="container">
    <div class="table-box">
      <div class="btn">
        <button>
          <router-link :to="{ name: 'add-product' }"> Add Product </router-link>
        </button>
      </div>
      <h1>All Product</h1>
      <table id="customers">
        <tr>
          <th># ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Category Name</th>
          <th>Brand Name</th>
          <th>Image</th>
          <th>Action</th>
        </tr>
        <tbody v-for="item in products" :key="item.id">
          <tr>
            <td style="color: blue">
              <router-link
                :to="{ name: 'edit-product', params: { id: item.id } }"
                ># {{ item.id }}
              </router-link>
            </td>
            <td>{{ item.product_name }}</td>
            <td>{{ item.product_price }}</td>
            <td>{{ item.product_quantity }}</td>
            <td>{{ item.category.category_name }}</td>
            <td>{{ item.brand.brand_name }}</td>
            <td>
              <img :src="item.product_img" style="width: 110px; height: 80px" />
            </td>

            <td
              @click="deleteProduct(item.id)"
              style="color: red; cursor: pointer"
            >
              <span>Delete</span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<style lang="scss" scoped>
h1 {
  background: rgb(237 236 236 / 68%);
  border-radius: 6px;
  padding: 10px 20px;
  font-size: 24px;
  color: #444;
}
.container {
  width: 100%;
}
table {
  border-radius: 6px;
  overflow: hidden;
}

.table-box {
  padding: 50px;
  border-radius: 8px;

  .btn {
    text-align: right;
    padding-bottom: 10px;
    button {
      padding: 10px 20px;
      border: 1px solid #ddd;
      background: #189877;
      border-radius: 6px;
      cursor: pointer;
      a {
        text-decoration: none;
        font-size: 16px;
        font-weight: 500;
        color: #fff;
      }
    }
  }
}

#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td,
#customers th {
  border: 1px solid #f3ededad;
  padding: 15px 15px;
  text-align: left;
}

#customers tr:nth-child(even) {
  background-color: #f2f2f2;
}

#customers th {
  padding-top: 20px;
  padding-bottom: 20px;
  text-align: left;
  background-color: rgb(237 236 236 / 68%);
  color: #444;
}
</style>
