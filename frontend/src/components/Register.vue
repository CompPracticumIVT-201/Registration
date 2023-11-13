<template>

    
    <form @submit.prevent="someAction()">
      <div class="field form-group">
        <label for="login">Логин</label>
        <input placeholder="Придумайте логин" class="form-control"
          id="login" 
          type="text" 
          v-model.trim="login" 
          @blur="$v.login.$touch()"
        >
        <div class="error" v-if="$v.login.$error">
          <template v-if="!$v.login.maxLength">
            Длина логина не должна превышать {{ $v.login.$params.maxLength.max }} символов
          </template>
          <template v-else-if="!$v.login.minLength">
            Длина логина должна быть не менее {{ $v.login.$params.minLength.min }} символов
          </template>
          <template v-else-if="!$v.login.beta">
           Логин должен содержать только латиницу, может содержать цифры и символы "_","-"
          </template>
          <template v-else-if="!$v.login.required">
           Логин обязателен для заполнения
          </template>

          <template v-else>
           Хуй пойми какая ошибка
          </template>
        </div>
      </div>
  
      <div class="field form-group">
        <label for="email">E-mail</label>
        <input placeholder="Введите почту" class="form-control"
          id="email" 
          type="text" 
          v-model.trim="email" 
          @blur="$v.email.$touch()"
        >
        <div class="error" v-if="$v.email.$error">
          <template v-if="!$v.email.email">
            Почта должна быть валидна
          </template>
          <template v-else-if="!$v.email.required">
           Заполните поле почты
          </template>

          <template v-else>
           Хуй пойми какая ошибка
          </template>
        </div>
      </div>

      <div class="field form-group">
        <label for="password">Пароль</label>
        <input placeholder="Придумайте свой пароль" class="form-control"
          id="password" 
          type="password" 
          v-model.trim="password" 
          @blur="$v.password.$touch()"
        >
        <div class="error" v-if="$v.password.$error">
          <template v-if="!$v.password.required">
            Заполните поле пароля
          </template>
          <template v-else>
           Пароль не соответствует требованиям
          </template>
        </div>
      </div>

      <div class="field form-group">
        <label for="copy_password">Подтвердите пароль</label>
        <input placeholder="Подтвердите свой пароль" class="form-control"
          id="copy_password" 
          type="password" 
          v-model.trim="copy_password" 
          @blur="$v.copy_password.$touch()"
        >
        <div class="error" v-if="$v.copy_password.$error">
        <template v-if="!$v.copy_password.required">
           Подтвердите пароль
          </template>
          <template v-else-if="!$v.copy_password.sameAsPassword">
            Пароли не совпадают
          </template>
          <template v-else>
           Хуй пойми какая ошибка
          </template>
        </div>
      </div>

      <div class="field form-group">
        <label for="checkbox">Я согласен(а) с условиями обработки персональных данных</label>
        <input class="form-control"
          id="checkbox" 
          type ="checkbox" 
          v-model ="checkbox" 
          name ="checkbox"
        >
        
      </div>

      <button type="submit" :disabled="$v.$invalid || !checkbox  ">
        Зарегистрироваться
      </button>
    </form>
  </template>
  
  <script>
  import { required, maxLength,minLength,email,sameAs } from "vuelidate/lib/validators";
  import moment from "moment";
  
  export default {
    login: 'Register',
    data() {
      return {
        login: null,
        email: null,
        password: null,
        copy_password: null,
        checkbox: false,
      };
    },
  
    validations: {
      login: {
        required,
        maxLength: maxLength(10),
        minLength: minLength(3),
        beta: val => /^[a-zA-Z0-9_-]*$/i.test(val),
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
        beta: val => /^[a-zA-Z0-9#?!@$%^&*-+]*$/i.test(val),
      },
      copy_password: {
        required,
        sameAsPassword: sameAs('password')
      }
    },
  
    methods: {
      someAction() {
        alert('Форма отправлена');
      },
    },
  };
  </script>
  
  <style scoped>
  .field {
    margin-bottom: 24px;
  }
  
  .field > label {
    margin-right: 8px;
  }
  
  .error {
    color: red;
  }
  </style>