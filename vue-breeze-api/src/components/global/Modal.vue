
<template>
    <div v-if="show" class="modal">
      <div :style="{ width: width}" class="modal-content">
        <slot></slot>
        <button @click="closeModal">Close</button>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      show: {
        type: Boolean,
        required: true
      },
      width: {
        type: String,
        default: '60%'
      }
    },
    methods: {
      closeModal() {
        this.$emit('close');
      }
    }
  };
  </script>
  <style scoped>
  button{
    padding: 10px 20px;
    font-size: 15px;
    border-radius: 6px;
    border: 1px solid #f1f1f1;
    background: rgb(231, 77, 77);
    margin-left: 72%;
    margin-top:20px ;
  }
  .modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  }
  </style>