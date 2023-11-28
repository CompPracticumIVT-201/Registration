<script>
   import {reactive, computed} from 'vue'
   import {useVuelidate} from '@vuelidate/core'
   import { required, maxLength, minLength, email, sameAs } from '@vuelidate/validators'
   //import moment from "moment";
   import axios from 'axios'
   import '../assets/register.css'

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
            login,
          },
          email: {
            required,
            email,
          },
          password: {
            required,
            maxLength: maxLength(16),
            minLength: minLength(6),
            pass,
          },
          copy_password: {
            required,
            sameAsPassword: sameAs(state.password)
          },
        }
      })
      
      const v$ = useVuelidate(rules, state);

      return { state, v$ };
    },
    
   
    methods: {
      async register() {
        const user = {
          email: this.state.email,
          login: this.state.login,
          password: this.state.password,
          password_confirmation: this.state.copy_password,
        };
        
        axios
          .post('/register', user)
          .then(response => {
            console.log (response.data.status);
          })
          .catch((e) => {
            if( e.response.status == 422 )
              errors_serv$ = e.response.data.errors;
          })
      },
      async checkLoginExist() {},
      async checkEmailExist() {},
      async getAuthors() {
        axios
          .get('/authors')
          .then(response => {return response.data})
      },
      async getCategories() {
        axios
          .get('/categories')
          .then(response => {return response.data})
      },
    },
   };
   
   </script>

<template>
    

    <form @submit.prevent="register()">
      <div class="field form-group">
        <label for="login">Логин</label>
        <input placeholder="Придумайте логин" class="form-control"
          id="login" 
          type="text" 
          v-model.trim="state.login" 
          @blur="v$.login.$touch()"
        />
        <div class="error" v-if="v$.login.$error">
          <template v-if="v$.login.maxLength.$invalid">
            Длина логина не должна превышать {{ v$.login.maxLength.$params.max }} символов
          </template>
          <template v-else-if="v$.login.minLength.$invalid">
            Длина логина должна быть не менее {{ v$.login.minLength.$params.min }} символов
          </template>
          <template v-else-if="v$.login.login.$invalid">
           Логин должен содержать только латиницу, может содержать цифры и символ "_"
          </template>
          <template v-else-if="v$.login.required.$invalid">
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

          <template v-if="v$.email.email.$invalid">
            Почта некорректна, пример: example@test.com
          </template>
          <template v-else-if="v$.email.required.$invalid">
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
          <template v-if="v$.password.required.$invalid">
            Заполните поле пароля
          </template>
          <template v-else-if="v$.password.pass.$invalid">
           Пароль не соответствует требованиям
          </template>
        </div>
      </div>

      <div class="field form-group" style ="margin-bottom: 10px;">
        <label for="copy_password">Подтвердите пароль</label>
        <input placeholder="Подтвердите свой пароль" class= "form-control"
          id="copy_password" 
          type="password"
          
          v-model.trim="state.copy_password" 
          @blur="v$.copy_password.$touch()"
        />
        <div class="error" v-if="v$.copy_password.$error">
        <template v-if="v$.copy_password.required.$invalid">
           Подтвердите пароль
          </template>
          <template v-else-if="v$.copy_password.sameAsPassword.$invalid">
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

      <button class="buttonReg" type="submit" :disabled="v$.$invalid || !state.checkbox">
        Зарегистрироваться
      </button>
      <button class="buttonLogIn" :disabled="v$.$invalid || !state.checkbox">
        Уже есть аккаунт? Войти
      </button>
    </form>
  </template>
  