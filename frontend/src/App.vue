<template>
  <div>
    <section v-if="token" class="header"> 
      <button class="header__button" @click="showLogin">Логин</button>
      <button class="header__button" @click="showSignUp">Регистрация</button>
    </section>
    <board v-else />
    <login v-if="isLoginShowed" @close="hideLogin"/>
    <SignUp v-if="isSignUpShowed" @close="hideSignUp"/>
  </div>
</template>

<script lang="ts" setup>
import login from './components/login.vue'
import SignUp from './components/SignUp.vue'
import board from './components/board.vue'
import { ref } from "vue";

let token = localStorage.getItem('token')
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
.header {
  display: flex;
  gap: 20px;

  position: fixed;
  top: 40px;
  right: 40px;
}
.header__button {
  width: 177px;
  height: 30px;
  background-color: cornflowerblue;
  border-color: transparent;
  border-radius: 5px;
  color: white;
  font-size: 17px;
  cursor: pointer;
}
</style>
