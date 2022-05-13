<template>
    <div>
        <div class="options" v-if="!joinedToGame">
            <div class="options__block">
                <label class="options__game-code-text" v-if="gameCode">Код игры: <span class="options__game-code">{{ gameCode}}</span></label>
                <button class="options__button"  style="margin-left:10px" @click="createGame">Создать игру</button>
                <button class="options__button" v-if="gameCode" style="margin-left:10px" @click="joinToGame">Перейти на доску</button>
            </div>
            <div style="margin-top:40px;">
                <input class="options__input" type="text" placeholder="код игры" v-model="gameCode"/>
                <button class="options__button options__button_higher" style="margin-left:10px" @click="joinToGameByCode">Присоедениться по коду</button>
            </div>
        </div>
        <board v-if="joinedToGame" />
    </div>
</template>

<script lang="ts" setup>
import board from "./board.vue"
import axios from 'axios'
import { ref } from "vue";

const joinedToGame = ref(false)
const gameCode = ref('')

const createGame = async () => {
    const apiClient = axios.create({
        baseURL: 'http://localhost:8000/api',
        headers: {'Authorization': 'Bearer ' + localStorage.getItem('token')}
    })
    apiClient.post('/game/create')
    .then(res => {
        gameCode.value = res.data.game_code
    })
}

const joinToGame = async () => {
    joinedToGame.value = true
}

const joinToGameByCode = async () => {
    if(gameCode.value) {
        const apiClient = axios.create({
            baseURL: 'http://localhost:8000/api',
            headers: {'Authorization': 'Bearer ' + localStorage.getItem('token')}
        })
        apiClient.post('/game/connect/' + gameCode.value)
        .then(res => {
            joinedToGame.value = true;
        })
    }
    else {
        alert('Введите код')
    }
}

</script>

<style scoped>
.options__button {
  width: 177px;
  height: 30px;
  background-color: cornflowerblue;
  border-color: transparent;
  border-radius: 5px;
  color: white;
  font-size: 17px;
  cursor: pointer;
}
.options__input {
    width: 192px;
}

.options__button_higher {
    height: 50px;
}

.options__game-code-text {
    display: block;
    width: 200px;
    font-size: 20px;
}
.options__game-code {
    color: green;
    font-weight: 900;
}

.options__block {
    display: flex;
}
</style>