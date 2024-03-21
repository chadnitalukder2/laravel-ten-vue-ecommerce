<script setup>
import { useNotification } from "@kyvg/vue3-notification";
const { notify } = useNotification();

import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
const router = useRouter();
//---------------------------------------------------
const category = ref([]);
//---------------------------------------------------
onMounted(async () => {
  getCategory();
});
//---------------------------------------------------

//---------------------------------------------------
const getCategory = async () => {
  let response = await axios.get("/api/get_category");
  category.value = response.data.category;
  // console.log("response", category.value);
};
//---------------------------------------------------
const deleteCategory = (id) => {
  axios.get(`/api/delete_category/${id}`).then(() => {
    notify({
      title: "Category Item Deleted",
      type: "success",
    });
    getCategory();
  });
};
//---------------------------------------------------
const getToken = async () => {
  await axios.get("sanctum/csrf-cookie");
};

//---------------------------------------------------
</script>

<template>
  <div class="container">
    <div class="table-box">
      <div class="btn">
        <button>
          <router-link :to="{ name: 'add-category' }">
            Add Category
          </router-link>
        </button>
      </div>
      <h1>All Category</h1>
      <table id="customers">
        <tr>
          <th># ID</th>
          <th>Category Name</th>
          <th>Category Image</th>
          <th>Action</th>
        </tr>
        <tbody v-for="item in category" :key="item.id">
          <tr>
            <td># {{ item.id }}</td>
            <td>
              <img
                :src="item.category_img"
                style="width: 130px; height: 80px"
              />
            </td>
            <td>{{ item.category_name }}</td>
            <td
              @click="deleteCategory(item.id)"
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
  margin-top: 0px;
  font-size: 24px;
  color: #444;
}
table {
  border-radius: 6px;
  overflow: hidden;
}

.container {
  width: 100%;
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
