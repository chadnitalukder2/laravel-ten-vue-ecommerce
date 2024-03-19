<script setup>

import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
const router = useRouter();
import { useRoute } from 'vue-router'
const route = useRoute()
//-------------------------------------------------
const orderItems = ref([]);
//--------------------------------------------------
onMounted(async () => {
    getOrderItemByOrderId();
});
//--------------------------------------
const getOrderItemByOrderId = async () =>{
    const id = route.params.id;
    // console.log('routhiuhuunje', id);
    let response = await axios.get(`/api/getOrderItemByOrderId/${id}`);
    orderItems.value = response.data.orderItem
    console.log('responseydyhfb', orderItems.value);
}

</script>


<template>
    <div>
          <div class="orderItem">
            <table id="customers">
              <tr>
                <th># ID</th>
                <th> Image</th>
                <th> Name</th>
                <th> Color</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Price </th>
                <th>Action</th>
              </tr> 
              <tbody v-for="item in orderItems" :key="item.id">
                <tr >
                  <td style="color: blue;"># {{ item.id }} </td>
                  <td>
                    <img :src="item.product.product_img" style="width: 70px; height: 50px;">
                  </td>
                  <td>{{ item.product.product_name  }}</td>
                  <td>{{ item.color  }}</td>
                  <td>{{ item.size  }}</td>
                  <td>{{ item.quantity  }}</td>
                  <td>{{ item.product.product_price  }}</td>
                  <td >
                      <button @click="deleteOrder(item.id)" style="color: red; ">Delete</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
    </div>
  </template>
  
  <style  lang="scss" scoped>
  td{
    button{
      cursor: pointer;
      border: 1px solid #ddd;
      background: transparent;
      a{
        text-decoration: none;
      }
    }
  }
  .orderItem {
    width: 100%;
    padding-left: 1.5rem;
    padding-top: 50px;
  }
  #customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }
  
  #customers td,
  #customers th {
    border: 1px solid #ddd;
    padding: 6px 8px;
    text-align: center;
  }
  
  #customers tr:nth-child(even) {
    background-color: #f2f2f2;
  }
  
  
  #customers th {
    padding: 15px;
    text-align: center;
    background-color: #D1EAE4;
    color: #444;
  }
  </style>
  