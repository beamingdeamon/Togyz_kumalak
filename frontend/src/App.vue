<template>
  <div>
    <main />
  </div>
</template>

<script lang="ts" setup>
import main from './pages/main.vue'
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
