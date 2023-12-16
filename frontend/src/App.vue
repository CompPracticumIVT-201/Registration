<script setup>
import { RouterLink, RouterView } from 'vue-router'
import './assets/main.css'
</script>

<script>
export default {
  name: 'App',

  

  mounted(){
    // var title = this.$route.name
    document.title = "Регистрация"
  },
}
</script>
<template>

  <div id= "app">
    <div class= "body">
      <div class= "bgElepseRightTop"></div>
      <div class= "bgElepseLeftBottom"></div>
      <div class= "bgElepseLeftTop"></div>
      <div class= "bgElepseRightBottom"></div>

      <div class = "register_form">
        <div class ="book_part">
          <a href="" class="buttonHome"/>
          
          <div class= "book_img">
            <img src= "./assets/pngegg_1.png" alt= "Иконка" width= "554px" height= "455px">
          </div>

          <div class= "lamp_img">
            <img src= "./assets/Lampa.png" alt= "Иконка" width= "250px" height= "395.52px">
          </div>
        </div>
        <div class = "form_part">
          <p>Регистрация</p>
          <router-view/>
        </div>
      </div> 
    </div>
  </div>



  <!--<RouterView />-->
</template>

