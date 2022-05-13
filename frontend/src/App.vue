<template>
  <div>
    <section v-if="!token" class="header"> 
      <button class="header__button" @click="showLogin">Логин</button>
      <button class="header__button" @click="showSignUp">Регистрация</button>
    </section>
    <div class="wrapper">
      <gameMenu class="center" v-if="token" />
      <login v-if="isLoginShowed" @close="hideLogin"/>
      <SignUp v-if="isSignUpShowed" @close="hideSignUp"/>
    </div>
  </div>
</template>

<script lang="ts" setup>
import login from './components/login.vue'
import SignUp from './components/SignUp.vue'
import gameMenu from './components/gameMenu.vue'
import { ref } from "vue";

let token = ref(localStorage.getItem('token'))

let isLoginShowed = ref(false) 

let isSignUpShowed = ref(false) 

const showLogin = () => {
  isLoginShowed.value = true;
  isSignUpShowed.value = false;
}
const hideLogin = () => {
  isLoginShowed.value = false;
}

const showSignUp= () => {
  isSignUpShowed.value = true;
  isLoginShowed.value = false;
}
const hideSignUp = () => {
  isSignUpShowed.value = false;
}
</script>

<style>
body{
  margin: 0;
  padding: 0;
}
.header {
  display: flex;
  align-items: center;
  width: 100vw;
  height: 8vh;
  justify-content: center;
  background-color: rgb(10, 12, 14);
  position: fixed;
  backdrop-filter: blur(20px);
}
.header__button {
  width: 177px;
  height: 30px;
  background-color: rgb(10, 12, 14);
  border-color: transparent;
  border-radius: 5px;
  color: white;
  font-size: 17px;
  cursor: pointer;
}
.wrapper{
  height: 100vh;
  width: 100vw;
  background-color: rgb(56, 56, 56);
}
.center {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>
