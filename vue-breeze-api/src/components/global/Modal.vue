
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