<template>
  <div>
    <section v-if="!token" class="header"> 
      <button class="header__button" @click="showLogin">Логин</button>
      <button class="header__button" @click="showSignUp">Регистрация</button>
    </section>
    <gameMenu class="center" v-if="token" />
    <login v-if="isLoginShowed" @close="hideLogin"/>
    <SignUp v-if="isSignUpShowed" @close="hideSignUp"/>
  </div>
</template>

<script lang="ts" setup>
import login from '../components/login.vue'
import SignUp from '../components/SignUp.vue'
import gameMenu from '../components/gameMenu.vue'
import { ref, onMounted } from "vue";

let token = ref(localStorage.getItem('token'))

const showToken = () => {
  console.log('token: ',localStorage.getItem('token'))
} 
onMounted(() => { 
  console.log('awdawdawdawd')
  showToken()
})

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

.center {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>
