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

<script>
import login from '../components/login.vue'
import SignUp from '../components/SignUp.vue'
import gameMenu from '../components/gameMenu.vue'

export default {
  components: {
    login,
    SignUp,
    gameMenu,
  },
  data() {
    return {
      token: localStorage.getItem('token'),
      isLoginShowed: false,
      isSignUpShowed: false,
    }
  },
  methods: {
    showLogin() {
      this.isLoginShowed = true;
      this.isSignUpShowed = false;
    },
    hideLogin() {
      this.isLoginShowed = false;
    },
    showSignUp() {
      this.isSignUpShowed = true;
      this.isLoginShowed = false;
    },
    hideSignUp() {
      this.isSignUpShowed = false;
    }
  }
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
