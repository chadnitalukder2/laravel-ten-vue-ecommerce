<template>
    <div>
              <div class="card_categories">
        
               <div class="card-categories-image">
                <a href="#">
                  <img class="image" :src=" props.category.category_img" alt="Blouses Shirts">
                </a> 
               </div>
              <div class="card_title">
                <h4> <a href="#">{{ props.category.category_name }}</a></h4>
                <p>75 Products</p>
              </div>
          
          </div>
          
        
    </div>
</template>

<script setup>
import {
    defineProps
} from "vue";

const props = defineProps(["category"]);
</script>

<style lang="scss" scoped>
.card_categories{
  width: 220px;
  border-radius: 6px;
  transition: all .3s;
  transform: translateZ(0);
  &:hover{
    transform: translateY(-10px);
    
  }
}
.card_title{
  text-align: center;
  h4{
    margin: 0px;
    padding: 24px 0px 1px 0px;
    a{
      text-decoration: none;
      color: #0d2235;
      font-weight: 700;
      font-size: 14px;
      font-family:Poppins, sans-serif;
      &:hover{
        color: #009688;
      }
    }
  }
  p{
   color: #505157;
   font-family:Poppins, sans-serif;
   font-size: 12px;
   padding-bottom:20px ;
  }
}
.card-categories {
    width: 12.5%;
    height: 148.5px;
    border-right: 1px solid #e2e2e2;
    border-bottom: 1px solid #e2e2e2;
    background-color: #fff;
}
a{
  font-size: 12px;
    color: #009688;
}
.card-categories-image {
    margin: 0 auto;
    width: 100%;
    height: 200px;
    border-radius: 6px;
    overflow: hidden;
    &:hover{
      box-shadow: 3px 3px 12px #0000001a;
    }
}
.card-categories-image .image {
    width: 100%;
    height: 100%;
    transition: all .5s;
    &:hover{
      background: transparent;
    transform: scale(1);
    opacity: 1;
    }
}
.card-categories-name {
    text-align: center;
    margin-top: 10px;
}


</style>