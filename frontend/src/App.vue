<template>
  <div id="app">
    
    <div class = "register_form">
        <div class ="book_part">
          <div class="home_page_but">
            <button class = "button" type="button">
              <img src="./assets/domik.png" alt="Иконка" width="30" height="30">
            </button>
          </div>
          <div class="book_img">
            <img src="./assets/pngegg_1.png" alt="Иконка" width="554px" height="455px">
          </div>
          <div class="lamp_img">
            <img src="./assets/Lampa.png" alt="Иконка" width="250px" height="395.52px">
          </div>
        </div>
        <div class = "form_part">
          <p> Регистрация</p>
          <router-view/>
        </div>
        

    </div>
  </div>
</template>

<script>
export default {
  name: 'App'
}
</script>

<style scoped>
body{
  position: absolute;
  width: 1440px;
  height: 1200px;
  left: 0px;
  top: 0px;

  background: #2C2C2C;
  backdrop-filter: blur(2px);
}
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;


  
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
.home_page_but button img{
  position: absolute;

  width: 30px;
  height: 30px;
  top: 25px;
  left: 25px;
  padding: 0.01px, 0px, 0.01px, 0px;
  visibility:visible;
}
.book_img img{
  position: absolute;
  visibility: visible;
  left: 0px;
  top:175px
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

font-family: 'Inter';
font-style: normal;
font-weight: 700;
font-size: 30px;
line-height: 36px;

font-family: "Inter";
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
