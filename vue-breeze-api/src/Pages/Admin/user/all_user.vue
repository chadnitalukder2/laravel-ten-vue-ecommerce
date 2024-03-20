<script setup>
import { useNotification } from "@kyvg/vue3-notification";
const { notify } = useNotification();

import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
const router = useRouter();
//---------------------------------------------------
const user = ref([]);
//---------------------------------------------------
onMounted(async () => {
  getUser();
});
//---------------------------------------------------
const getUser = async () => {
  let response = await axios.get("/api/get_user");
  user.value = response.data.user;
  // console.log("response", response.data.user);
};
//---------------------------------------------------
const deleteUser = (id) => {
  axios.get(`/api/delete_user/${id}`).then(() => {
    notify({
      title: "User Deleted",
      type: "success",
    });
    getUser();
  });
};

//---------------------------------------------------

//---------------------------------------------------
</script>

<template>
  <div class="container">
    <div class="table-box">
      <h1>All User</h1>
      <table id="customers">
        <tr>
          <th># ID</th>
          <th>User Name</th>
          <th>User Email</th>
          <th>Action</th>
        </tr>
        <tbody v-for="item in user" :key="item.id">
          <tr>
            <td style="color: blue">
              <router-link :to="{ name: 'edit-user', params: { id: item.id } }"
                ># {{ item.id }}
              </router-link>
            </td>
            <td>{{ item.name }}</td>
            <td>{{ item.email }}</td>
            <td
              @click="deleteUser(item.id)"
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
table {
  border-radius: 6px;
  overflow: hidden;
}

.container {
  margin: auto;
  width: 100%;
}
.table-box {
  padding: 50px;
  border-radius: 8px;
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
