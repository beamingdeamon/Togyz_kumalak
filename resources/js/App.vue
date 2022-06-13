<template>
<div class="wrapper">
  <router-link to='/'></router-link>
  <router-view></router-view>
</div>
</template>

<script>
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
  background-color: #f0f2f0;
}
.center {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>
