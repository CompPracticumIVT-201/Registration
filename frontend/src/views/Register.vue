<script>
   import {reactive, computed} from 'vue'
   import {useVuelidate} from '@vuelidate/core'
   import { required, maxLength, minLength, email, sameAs, helpers } from '@vuelidate/validators'
   //import moment from "moment";
   import axios from 'axios'


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

      const login_reg = helpers.regex(/^[a-zA-Z\d_]*$/)
      const latin = helpers.regex(/^.*(?=[a-zA-Z]).*$/)
      const has_int = helpers.regex(/^.*(?=.*\d).*$/)
      const has_spec = helpers.regex(/^.*(?=.*[!@#$%^&*"?<>/'\(\)_-]).*$/)

      const checkLoginFree = (login) => {
        axios
          .get('/user/login/' + login)
          .then(response => { return response.data.is_free })
      }

      const asyncValidator = helpers.withAsync(checkLoginFree, () => state.login) 

      const rules = computed(() => {
        return {
          login: {
            required : helpers.withMessage('Введите логин!', required),
            reg : helpers.withMessage('Логин содержит недопустимые символы!', login_reg),
            maxLength: helpers.withMessage('Длина логина должна быть не более 10 символов', maxLength(10)),
            minLength: helpers.withMessage('Длина логина должна быть не менее 3 символов', minLength(3)),
            // login_exist : helpers.withAsync(asyncValidator, () => state.login)
          },
          email: {
            required : helpers.withMessage('Введите почту!', required),
            email : helpers.withMessage('Введите корректную почту!', email),
            // email_exist : helpers.withMessage('Логин уже занят!', asyncEmailValidator),
          },
          password: {
            required : helpers.withMessage('Введите пароль!', required),
            latin : helpers.withMessage('Пароль должен быть набран латиницей!', latin),
            minLength : helpers.withMessage('Пароль должен содержать минимум 8 символов!', minLength(8)),
            has_int : helpers.withMessage('Пароль должен содержать хотя бы 1 цифру!', has_int),
            has_spec : helpers.withMessage('Пароль должен содержать хотя бы 1 спец символ!', has_spec),
          },
          copy_password: {
            required : helpers.withMessage('Подтвердите пароль!', required),
            sameAsPassword : helpers.withMessage('Пароли должны совпадать!', sameAs(state.password)),
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
            if( e.response.status == 422 ) {
              // errors_serv$ = e.response.data.errors;
              console.log(e.response.data);
            }
          })
      },
      async getAuthors() {
        axios
          .get('/authors')
          .then(response => {return response.data})
      },
      async getCategories() {
        axios
          .get('/categories')
          .then(response => { return response.data })
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
          <div> 
            {{ v$.login.$errors[0].$message }} 
          </div>
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
          <div> 
            {{ v$.email.$errors[0].$message }} 
          </div>
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
          <div>
            {{ v$.password.$errors[0].$message }}
          </div>
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
          <div> 
            {{ v$.copy_password.$errors[0].$message }} 
          </div>
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
      <button class="buttonLogIn" type="submit" :disabled="v$.$invalid || !state.checkbox">
        Уже есть аккаунт? Войти
      </button>
    </form>
  </template>
  


  
   
  
  
  <style scoped>

  
.field {
    margin-bottom: 25px;
    position: relative;
    height: 55.08px;

  }
  
  .field > label {
    position: absolute;
    height: 19px;
    left: 30px;
    top: -23px;

    font-family: sans-serif;
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 19px;

    color: #000000;  
  }
  .form-group > input {
    position: absolute;
    height: 32px;
    width: 343px;
    top: 0px;
    left: 14px;

    background: #F3F2F8;
    border: 2px solid #AF895B;
    border-radius: 15px;
    box-sizing: border-box;
  }


  .form-group input[type=text]{
    padding-left: 15px;
}
.form-group input[type=password]{
    padding-left: 15px;
}








  .checkbox{
    position:absolute;
    left: 25px;
    top: -6px;

    -webkit-appearance: none; /* Remove default appearance */
    -moz-appearance: none;
    appearance: none;

    width: 18px;
    height: 18px;
    border: 1px solid #AF895B;
    border-radius: 4px;
    outline: none;
    transition: background-color 0.3s ease-in-out;

    cursor: pointer;
  }

  .checkbox:checked::before {
    content: '\2714'; /* check mark symbol Unicode */
    display: block;
    text-align: center;
    font-size: 14px;
    line-height: 16px;
    color: #365B76;
  }

  .checkbox:checked{
    background-color: #F3F2F8;  /* Change background color when checked */

  }


  .checkbox_field > label{
    position: absolute;
    width: 315px;
    height: 12px;

    top: 1px;
    left: 45px;

    font-family: sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 10.5px;
    line-height: 12px;

    color: #365B76;
  }
  


  .form-group > input::placeholder{
    position: absolute;
    width: 135px;
    left: 4.37%;
    right: 58.31%;
    top: 32.14%;
    bottom: 21.43%;

    font-family: sans-serif;
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

    left: 30px;
    top: 39px;
    height: 12px;
    
    font-family: sans-serif;
    font-size: 12px;
    font-weight: 400;
    line-height: 12px;
    letter-spacing: 0em;
    text-align: left;

  }
  .buttonReg{
    position: absolute;
    top: 345px;
    left: 45px;
    width: 271px;
    height: 40px;
    border: none;
    background: #365B76;
    border-radius: 45px;

    font-family: sans-serif;;
    font-style: normal;
    font-weight: 600;
    font-size: 16px;
    line-height: 19px;
    color: #F3F2F8;
  }
  .buttonReg:hover {
    border: 1px solid #365B76;
    background-color: #3e6886;
    padding: 5px 10px;
    cursor: pointer;
  }
  .buttonReg:disabled,
  .buttonReg[disabled]{
  border: 2px solid #365B76;
  background-color: #cccccc;
  color: #666666;
  }


  .buttonLogIn{
    position: absolute;
    top: 410px;
    left: 45px;
    width: 271px;
    height: 40px;
    border: none;
    background: #AF895B;
    border-radius: 45px;
    
    font-family: sans-serif;
    font-style: normal;
    font-weight: 600;
    font-size: 16px;
    line-height: 19px;
    color: #F3F2F8;
  }
  .buttonLogIn:hover {
    border: 2px solid #AF895B;
    background-color: #bd9462;
    padding: 5px 10px;
    cursor: pointer;
  }
  </style>