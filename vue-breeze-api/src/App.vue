<script setup>
import Nav from './components/Nav.vue';

import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
const router = useRouter();

const user = ref([]);

onMounted(async () => {
  getUser();
});

const getUser = async () => {
  await axios.get("/api/user").then((ress) => {
    if (ress.status === 200) {
      next();
    } else {
      router.push('/login');
    }
  }).catch(error => {
    console.error('Error fetching user data hsgdyg:', error);
  });
}

</script>

<template>
  
<div>

  <Nav :user="user"></Nav>
  <main style=" width: 100%;">
      <notifications />
      <router-view></router-view>
  </main>
</div>

</template>

<style scoped>

</style>
