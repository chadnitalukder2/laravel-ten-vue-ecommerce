<script setup>
import { useNotification } from "@kyvg/vue3-notification";
const { notify }  = useNotification();


import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
const router = useRouter();
//---------------------------------------------------
const orderItems = ref([]);
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
// const deleteUser = (id) => {
//     axios.get(`/api/delete_user/${id}`).then( () => {
//       notify({
//         title: "User Deleted",
//         type: "success",
//       });
//       getUser();
//     })
// }

//---------------------------------------------------

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
                    <button @click="deleteUser(item.id)" style="color: red; ">Delete</button>
                    <button style="color: #22bdbd; margin-left: 10px; ">View</button>
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
