<script setup>
import { useNotification } from "@kyvg/vue3-notification";
const { notify }  = useNotification();
import Modal from "../../../components/global/Modal.vue";


import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
const router = useRouter();
//---------------------------------------------------
const orderItems = ref([]);
const modalVisible = ref([]);
//---------------------------------------------------
onMounted(async () => {
  getOrderItems();
});
//---------------------------------------------------
const getOrderItems = async () => {
  let response = await axios.get("/api/get_all_Order");
  orderItems.value = response.data.orderItems;
  // console.log("response", response.data);
};
//---------------------------------------------------
const deleteOrder = (id) => {
    axios.get(`/api/delete_order_item/${id}`).then( () => {
      notify({
        title: "Order Item Deleted",
        type: "success",
      });
      getOrderItems();
    })
}

//---------------------------------------------------
const openModal = () => {
  modalVisible.value = true;
};

const closeModal = () => {
  modalVisible.value = false;
};
//---------------------------------------------------
</script>

<template>
  <div>
        <div class="orderItem">
          <table id="customers">
            <tr>
              <th># ID</th>
              <th>User Id</th>
              <th> Name</th>
              <th> Email</th>
              <th>Address</th>
              <th>Phone</th>
              <th>Total Amount </th>
              <th>Order Status</th>
              <th>Payment Status</th>
              <th>Action</th>
            </tr> 
            <tbody v-for="item in orderItems" :key="item.id">
              <tr >
                <td style="color: blue;"># {{ item.id }} </td>
                <td>{{ item.user_id }}</td>
                <td>{{ item.name  }}</td>
                <td>{{ item.email  }}</td>
                <td>{{ item.address  }}</td>
                <td>{{ item.phone  }}</td>
                <td>{{ item.total_amount  }}</td>
                <td>{{ item.order_status  }}</td>
                <td>{{ item.payment_status  }}</td>
                <td >

                    <button @click="deleteOrder(item.id)" style="color: red; ">Delete</button>
                    <button style="color: #22bdbd; margin-left: 10px; "><router-link style="color: #22bdbd;"  :to="{ name: 'view_order_details', params: { id: item.id }}" >View</router-link></button>
                    <button @click="openModal()" style="color: blue; ">Edit</button>
                  </td>

                  <Modal :show="modalVisible" @close="closeModal">
                      <h1>Modal</h1>
                      {{ item.id }}
                      {{ item.order_status }}
                      <p>This is a modal</p>
                      
                  </Modal>

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
