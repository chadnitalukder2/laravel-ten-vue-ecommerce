<script setup>
import { useNotification } from "@kyvg/vue3-notification";
const { notify } = useNotification();
import Modal from "../../../components/global/Modal.vue";

import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
const router = useRouter();
//---------------------------------------------------
const orderItems = ref([]);
const modalVisibleId = ref(null);
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
  axios.get(`/api/delete_order_item/${id}`).then(() => {
    notify({
      title: "Order Item Deleted",
      type: "success",
    });
    getOrderItems();
  });
};

//---------------------------------------------------
const openModal = (id) => {
  modalVisibleId.value = id;
};

const closeModal = () => {
  modalVisibleId.value = null;
};
//---------------------------------------------------
</script>

<template>
  <div class="container">
    <div class="table-box">
      <h1>Order Items</h1>
      <table id="customers">
        <tr>
          <th># ID</th>
          <th>User Id</th>
          <th>Name</th>
          <th>Email</th>
          <th>Address</th>
          <th>Phone</th>
          <th>Total Amount</th>
          <th>Order Status</th>
          <th>Payment Status</th>
          <th>Action</th>
        </tr>
        <tbody v-for="item in orderItems" :key="item.id">
          <tr>
            <td style="color: blue"># {{ item.id }}</td>
            <td>{{ item.user_id }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.email }}</td>
            <td>{{ item.address }}</td>
            <td>{{ item.phone }}</td>
            <td>{{ item.total_amount }}</td>
            <td>{{ item.order_status }}</td>
            <td>{{ item.payment_status }}</td>
            <td>
              <button @click="deleteOrder(item.id)" style="color: red">
                Delete
              </button>
              <button style="color: #22bdbd; margin-left: 10px">
                <router-link
                  style="color: #22bdbd"
                  :to="{ name: 'view_order_details', params: { id: item.id } }"
                  >View</router-link
                >
              </button>
              <button
                @click="openModal(item.id)"
                style="color: #414195; margin-top: 7px"
              >
                Edit
              </button>
            </td>

            <Modal :show="modalVisibleId === item.id" @close="closeModal">
              <h2 style="text-align: center; font-size: 22px; color: #444;">Upadte </h2>
              <form >
             
                <div class="container">
                  <div>
                    <label for="uname"><b>Order Status</b></label>
                    <select v-model="item.order_status ">
                      <option disabled>orders tatus </option>
                      <option >Pending</option>
                      <option >Processing</option>
                      <option >Received</option>
                      <option >Delevary</option>
                    </select>
                  </div>

                  <div>
                    <label for="uname"><b>Payment Status</b></label>
                    <select v-model="item.payment_status">
                      <option disabled>payment status </option>
                      <option >Paid</option>
                      <option >Refund</option>
                    </select>
                  </div>
                  <br />
                  <button type="submit">Add Product</button>
                </div>
              </form>
            </Modal>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<style lang="scss" scoped>

h1 {
  text-align: center;
  font-size: 25px;
  color: #444;
}
form {
  border: 1px solid #f1f1f1;
  margin: 0 auto;
  width: 60%;
  margin-top: 15px;
  border-radius: 8px;
  padding: 20px;
  button{
    padding: 10px 15px;
    font-size: 14px;
    border-radius: 6px;
    border: 1px solid #f1f1f1;
    background: #189877;
    color: white;
  }
}

select {
  width: 100%;
  padding: 12px 20px;
  margin: 12px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  border-radius: 8px;
}

h1 {
  background: rgb(237 236 236 / 68%);
  border-radius: 6px;
  padding: 10px 20px;
  font-size: 24px;
  color: #444;
}

td {
  button {
    cursor: pointer;
    border: 1px solid #ddd;
    background: transparent;
    a {
      text-decoration: none;
    }
  }
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
    padding-bottom: 25px;
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
