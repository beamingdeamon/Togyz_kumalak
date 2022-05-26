<template>
  <div class="login">
      <label class="login__close" @click="$emit('close')">x</label>
      <div class="input_wrappers">
        <h2 class="first_text">Введите свою почту: </h2>
        <input class="login__input" placeholder="test@mail.ru" v-model="data.email"/>
        <h2>Введите пароль: </h2>
        <input class="login__input" type="password" v-model="data.password" placeholder="Пароль" />
        <button class="login__button" @click="login">Войти</button>
      </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data() {
    return {
      data: { email: '', password: ''}
    }
  },
  methods: {
    async login() {
      try {
        await axios.post('/api/login', this.data)
        .then(res => {
          if(res.status === 200) {
            localStorage.setItem('token', res.data.access_token)
            alert('Вы успещно авторизироваись!')
            this.$emit('close');
            return;
          }
          if(res.status === 203) {
            alert(res.data.message)
            return;
          }
        })
      }
      catch(error) {
        alert(error.data.message)
      }
    }  
  }
}

</script>

<style>
h2{
  color: white;
}
.login {
    display: flex;
    flex-flow: column;
    gap: 20px;

    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);

    width: 450px !important;
    height: 350px !important;

    background-color: rgb(0, 0, 0) !important;

    border-radius: 10px;
}
.input_wrappers{
  margin-left: 4vw;
  margin-top: 7vh;
  height: 80%;
  display: flex;
  flex-direction: column;
}
.login__input {
  margin-left: 1vw;
  height: 25px;
  width: 65%;
  border-radius: 5px;
  border-color: white;
}

.login__button {
    width: 177px;
    height: 30px;
    background-color: rgb(88, 8, 8) !important;
    border-color: transparent;
    border-radius: 5px;
    color: white;
    font-size: 17px;
    cursor: pointer;
    margin-top: 7vh;
    margin-left: 49%;
}

.login__close {
  position: absolute;
  top: 10px;
  color: white;
  right: 20px;
  font-size: 25px;
  font-weight: 900;
  font-family: cursive;
  cursor: pointer;
  caret-color: transparent;
}
</style>
