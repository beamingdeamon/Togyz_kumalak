<template>
  <div class="login">
      <label class="login__close" @click="$emit('close')">x</label>
      <input class="login__input" placeholder="user name" v-model="data.name"/>
      <input class="login__input" placeholder="email" v-model="data.email"/>
      <input class="login__input" type="password" v-model="data.password" placeholder="пароль" />
      <button class="login__button" @click="register">Зарегистрироваться</button>
  </div>
</template>

<script lang="ts" setup>
import axios from "axios";
import { ref, defineEmits } from "vue";

const emit = defineEmits(['close'])

const data = ref({name: '', email: '', password: ''})
const register = async () => {
    try {
        await axios.post('http://localhost:8000/api/register', data.value)
        .then(res => {
            if(res.status === 200) {
                alert('Вы успешно зарегистрировалсь!')
                emit('close')
            }
        })
    }
    catch(error) {
        alert(error.data.message)
    }
}
</script>

<style>
.login {
    display: flex;
    flex-flow: column;
    align-items: center;
    justify-content: center;
    gap: 20px;

    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);

    width: 300px;
    height: 250px;

    background-color: bisque;

    border-radius: 20px;
}

.login__input {
  height: 25px;
  border-radius: 5px;
  border-color: white;
}

.login__button {
    width: 177px;
    height: 30px;
    background-color: cornflowerblue;
    border-color: transparent;
    border-radius: 5px;
    color: white;
    font-size: 17px;
    cursor: pointer;
}

.login__close {
  position: absolute;
  top: 10px;
  right: 20px;
  font-size: 25px;
  font-weight: 900;
  font-family: cursive;
  cursor: pointer;
  caret-color: transparent;
}
</style>
