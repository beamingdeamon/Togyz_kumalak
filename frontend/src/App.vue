<template>
  <router-link></router-link>
</template>

<script lang="ts" setup>
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
