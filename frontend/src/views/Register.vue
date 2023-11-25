<script>
   import {reactive, computed} from 'vue'
   import {useVuelidate} from '@vuelidate/core'
   import { required, maxLength, minLength, email, sameAs } from '@vuelidate/validators'
   //import moment from "moment";


   export default {
    //login: 'Register',
      setup(){
        const state = reactive({
          email: '',
          login: '',
          password: '',
          copy_password: '',
          checkbox: '',
        })

        const login = (value) =>  /^[a-zA-Z0-9_]*$/i.test(value)
        const pass = (value) =>  /^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*"?]).*$/i.test(value)

        const rules = computed(() => {
          return {
            login: {
              required,
              maxLength: maxLength(10),
              minLength: minLength(3),
              beta,
            },
            email: {
              required,
              maxLength,
              minLength,
              email,
            },
            password: {
              required,
              maxLength: maxLength(16),
              minLength: minLength(6),
              beta,
            },
            copy_password: {
              required,
              sameAsPassword: sameAs(state.password)
            },
          }
        })
        

      const v$ = useVuelidate(rules, state);

      return { state, v$};

    },
    
   
    methods: {
     someAction() {
      alert('Форма отправлена');
     },
    },
   };
   
    
   
   </script>


<template>

    <form @submit.prevent="someAction()">
      <div class="field form-group">
        <label for="login">Логин</label>
        <input placeholder="Придумайте логин" class="form-control"
          id="login" 
          type="text" 
          v-model.trim="state.login" 
          @blur="v$.login.$touch()"
        />
        <div class="error" v-if="v$.login.$error">
          <template v-if="!v$.login.maxLength">
            Длина логина не должна превышать {{ v$.login.$params.maxLength.max }} символов
          </template>
          <template v-else-if="!v$.login.minLength">
            Длина логина должна быть не менее {{ v$.login.$params.minLength.min }} символов
          </template>
          <template v-else-if="!v$.login.beta">
           Логин должен содержать только латиницу, может содержать цифры и символы "_","-"
          </template>
          <template v-else-if="!v$.login.required">
           Логин обязателен для заполнения
          </template>

          <template v-else>
            Неопознанная ошибка
          </template>
        </div>
      </div>
  
      <div class="field form-group">
        <label for="email">E-mail</label>
        <input placeholder="Введите почту" class="form-control"
          id="email" 
          type="text" 
          v-model.trim="state.email" 
          @blur="v$.email.$touch()"
        />
        <div class="error" v-if="v$.email.$error">
          <template v-if="!v$.email.email">
            Почта должна быть валидна
          </template>
          <template v-else-if="!v$.email.required">
           Заполните поле почты
          </template>

          <template v-else>
            Неопознанная ошибка
          </template>
        </div>
      </div>

      <div class="field form-group">
        <label for="password">Пароль</label>
        <input placeholder="Придумайте свой пароль" class="form-control"
          id="password" 
          type="password" 
          v-model.trim="state.password" 
          @blur="v$.password.$touch()"
        />
        <div class="error" v-if="v$.password.$error">
          <template v-if="!v$.password.required">
            Заполните поле пароля
          </template>
          <template v-else>
           Пароль не соответствует требованиям
          </template>
        </div>
      </div>

      <div class="field form-group" style ="margin-bottom: 10px;">
        <label for="copy_password">Подтвердите пароль</label>
        <input placeholder="Подтвердите свой пароль" class="form-control"
          id="copy_password" 
          type="password" 
          v-model.trim="state.copy_password" 
          @blur="v$.copy_password.$touch()"
        />
        <div class="error" v-if="v$.copy_password.$error">
        <template v-if="!v$.copy_password.required">
           Подтвердите пароль
          </template>
          <template v-else-if="!v$.copy_password.sameAsPassword">
            Пароли не совпадают
          </template>
          <template v-else>
           Неопознанная ошибка
          </template>
        </div>
      </div>

      <div class="field checkbox_field">
        <label for="checkbox">Я согласен(а) с условиями обработки персональных данных</label>
        <input class="checkbox"
          id="checkbox" 
          type ="checkbox" 
          v-model ="state.checkbox" 
          name ="checkbox"
        />
        
      </div>

      <button class="button" type="submit" :disabled="v$.$invalid || !state.checkbox  ">
        Зарегистрироваться
      </button>
    </form>
  </template>
  


  
   
  
  
  <style scoped>

  
  .field {
    margin-bottom: 23px;
    position: relative;
    height: 55.08px;

  }
  
  .field > label {
    position: absolute;
    height: 19px;
    left: 14px;
    top: 0px;

    font-family: 'Inter';
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 19px;

    color: #000000;  
  }
  .form-group > input {
    position: absolute;
    height: 27.08px;
    width: 343px;
    top:20px;
    left: 14px;

    background: #F3F2F8;
    border: 1px solid #AF895B;
    border-radius: 12px;
    box-sizing: border-box;
  }


  .form-group input[type=text]{
    padding-left: 15px;
}
.form-group input[type=password]{
    padding-left: 15px;
}

  .checkbox{
    position: absolute;
    top:10px;
    left: 14px;

    width: 15px;
    height: 15px;

  

    background: #EDEDED;
    border: 0.5px solid #DBDBDB;
    border-radius: 2px;

  }


  .checkbox_field > label{
    position: absolute;
    width: 300px;
    height: 12px;

    top: 7px;
    left: 20px;

    font-family: 'Inter';
    font-style: normal;
    font-weight: 400;
    font-size: 10px;
    line-height: 12px;

    color: #365B76;
  }
  .checkbox_field > input{
    top: 0px;
  }


  .form-group > input::placeholder{
    position: absolute;
    width: 128px;
    height: 14.9px;
    top: 6.31px;
    left: 15px;

    font-family: Inter;
    font-size: 11px;
    font-weight: 300;
    line-height: 13px;
    letter-spacing: 0em;
    text-align: left;

    color:#B5B5B5;

  }
  .error {
    position: absolute;
    color: #FC3030;

    left: 15px;
    top: 50px;

    height: 12px;
    font-family: Inter;
    font-size: 14px;
    font-weight: 400;
    line-height: 12px;
    letter-spacing: 0em;
    text-align: left;

  }
  .button{
    position: absolute;
    top: 397px;
    left: 37px;
    width: 271px;
    height: 40px;

    background: #365B76;
    border-radius: 45px;

    font-family: 'Inter';
    font-style: normal;
    font-weight: 600;
    font-size: 16px;
    line-height: 19px;
    color: #FFFFFF;

  }
  </style>