<script setup>
import { RouterLink, RouterView } from 'vue-router'
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
          <button class = "buttonHome" type= "submit"></button>
          
          <div class= "book_img">
            <img src= "./assets/pngegg_1.png" alt= "Иконка" width= "554px" height= "455px">
          </div>

          <div class= "lamp_img">
            <img src= "./assets/Lampa.png" alt= "Иконка" width= "250px" height= "395.52px">
          </div>
        </div>
        <div class = "form_part">
          <p> Регистрация</p>
          <router-view/>
        </div>
      </div> 
    </div>
  </div>



  <!--<RouterView />-->
</template>



<style scoped>
.body{
  position: absolute;
  width: 100%;
  height: 100%;
  left: 0px;
  top: 0px;
  overflow: hidden;
  background: #2D2D2D;
  backdrop-filter: blur(2px);
}
.bgElepseRightTop{
  position: absolute;
  width: 683px;
  height: 621px;

  left: calc(90% - 810px/2);
  top: calc(90% - 630px*2);

  background: #C0D9E0;
  filter: blur(100px);
}

.bgElepseLeftBottom{
  position: absolute;
  width: 640px;
  height: 596px;
  left: -155px;
  top: 810px;
  background: #C0D9E0;
  filter: blur(100px);
}

.bgElepseLeftTop{
  position: absolute;
  width: 293px;
  height: 267px;
  left: 100px;
  top: 76px;

  background: #F3DDC5;
  filter: blur(100px);
}

.bgElepseRightBottom{
  position: absolute;
  width: 352px;
  height: 278px;
  
  left: calc(100% - 810px/2);
  top: calc(100% - 630px/2);
  background: #F3DDC5;
  filter: blur(100px);
}

#app {
  font-family: sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 6px;
}
.register_form{
  position: absolute;
  width: 810px;
  height: 630px;
  left: calc(50% - 810px/2);
  top: calc(50% - 630px/2);

  background: #F3F2F8;
  box-shadow: 0px 0px 62px 46px rgba(0, 0, 0, 0.15);
  border-radius: 40px;
}
.book_part{
  position: absolute;
  visibility: hidden;
  width: 354px;
  height: 626px;
  left: 0px;
  top: 0px;

  background: #2C473E;
  border-radius: 40px 0px 0px 40px;
}
.form_part{
  position: absolute;
  width: 456px;
  height: 626px;
  left: 354px;
  top: 0px;
  
}
.buttonHome{
  position: absolute;
  width: 35px;
  height: 35px;
  top: 25px;
  left: 25px;
  
  background-color: #F3F2F8;
  visibility:visible;
  background-image: url("./assets/domik.png");
  background-repeat : no-repeat;
  background-position: center;
  border: none;
}

.buttonHome:hover{
  box-shadow: inset 0 0 100px 100px rgba(255, 255, 255, 0.1);
  padding: 5px 10px;
  cursor: pointer;
}




.book_img img{
  position: absolute;
  visibility: visible;
  left: 0px;
  top:175px;
  border-radius: 40px;
}
.lamp_img img{
  visibility: visible;
  position: absolute;
  width: 291px;
  height: 330px;
  left: 166px;
  top: 0px;
}
.form_part p{
  position: absolute;
  width: 196px;
  height: 36px;
  left: 155px;
  margin-top: 0px;
  top: 40px;

  font-style: normal;
  font-weight: 700;
  font-size: 30px;
  line-height: 36px;

  font-family: Arial, sans-serif;
  font-size: 30px;
  font-weight: 700;
  line-height: 36px;
  letter-spacing: 0em;
  text-align: left;
  color: #353232;
}
.form_part form{
  position: absolute;
  width: 343px;
  height: 55.08px;
  left: 73px;
  top: 136px;
}

</style>






