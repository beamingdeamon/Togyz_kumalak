<template>
  <div class="register">
      <label class="login__close" @click="$emit('close')">x</label>
      <div class="reg_input_wrappers">
        <h2>Введите имя: </h2>
        <input class="login__input" placeholder="Имя" v-model="data.name"/>
        <h2>Введите почту: </h2>
        <input class="login__input" placeholder="test@mail.ru" v-model="data.email"/>
        <h2>Введите пароль: </h2>
        <input class="login__input" type="password" v-model="data.password" placeholder="Пароль" />
        <button class="reg__button" @click="register">Зарегистрироваться</button>
      </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      data: { email: '', password: ''}
    }
  },
  methods: {
    async register() {
      try {
        await axios.post('/api/register', this.data)
        .then(res => {
            if(res.status === 200) {
              console.log('test')
              alert('Вы успешно зарегистрировалсь!')
              location.reload()
              debugger
              this.$emit('close')
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
.register {
    display: flex;
    flex-flow: column;
    gap: 20px;

    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);

    width: 450px !important;
    height: 420px !important;

    background-color: rgb(0, 0, 0) !important;

    border-radius: 10px;
}
.reg_input_wrappers{
  margin-left: 4vw;
  margin-top: 7vh;
  height: 85%;
  display: flex;
  flex-direction: column;
}
.reg__button{
    
    width: 210px;
    height: 50px;
    background-color: rgb(88, 8, 8) !important;
    border-color: transparent;
    border-radius: 5px;
    color: white;
    font-size: 17px;
    cursor: pointer;
    margin-top: 5vh;
    margin-left: 42%;
}

</style>
