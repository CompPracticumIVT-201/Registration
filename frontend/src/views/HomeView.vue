<script>
import axios from 'axios';
export default {
  methods: {
    async someAction() {
      // alert('Форма отправлена');

      const response = axios.get('/authors');
      alert((await response).status);
      console.log(response);
    },
  },
};
</script>

<template>
  <form @submit.prevent="someAction()">
    <button class="button" type="submit">
      Зарегистрироваться
    </button>
  </form>

</template>
