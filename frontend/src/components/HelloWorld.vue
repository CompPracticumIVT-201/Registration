<template>
  <form @submit.prevent="someAction()">
    <div class="field">
      <label for="passport_data">
        Серия и номер паспорта
      </label>
      <input id="passport_data" type="text" v-model="passportData">
      <div class="error" v-if="$v.passportData.$invalid">
        Серия и номер паспорта должны быть в формате 1234 567890
      </div>
    </div>

    <div class="field">
      <label for="passport_date">
        Дата выдачи паспорта
      </label>
      <input 
        id="passport_date" 
        type="text" 
        v-model="passportDate" 
        @blur="$v.passportDate.$touch()"
      >
      <div class="error" v-if="$v.passportDate.$error">
        Дата выдачи паспорта должна быть в формате ДД.ММ.ГГГГ
      </div>
    </div>

    <div class="field">
      <label for="name">Имя</label>
      <input 
        id="name" 
        type="text" 
        v-model="name" 
        @blur="$v.name.$touch()"
      >
      <div class="error" v-if="$v.name.$error">
        <template v-if="!$v.name.maxLength">
          Длина имени не должна превышать {{ $v.name.$params.maxLength.max }} символов
        </template>
        <template v-else-if="!$v.name.alpha">
         Имя должно содержать только буквы
        </template>
        <template v-else>
         Имя обязательно для заполнения
        </template>
      </div>
    </div>

    <button type="submit" :disabled="$v.$invalid">
      Отправить форму
    </button>
  </form>
</template>

<script>
import { required, maxLength } from "vuelidate/lib/validators";
import moment from "moment";

export default {
  name: 'Register',
  data() {
    return {
      passportData: null,
      name: null,
      passportDate: null,
    };
  },

  validations: {
    passportData: {
      required,
      validFormat: val => /^\d{4} \d{6}$/.test(val),
    },
    passportDate: {
      required,
      validDate: val => moment(val, "DD.MM.YYYY", true).isValid(),
    },
    name: {
      required,
      maxLength: maxLength(10),
      alpha: val => /^[а-яё]*$/i.test(val),
    },
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