<template>
    <div>
        <div class="options">
            <div class="options__block">
                <label class="options__game-code-text" v-if="gameCode">Код игры: <span class="options__game-code">{{ gameCode}}</span></label>
                <button class="create_game_button"  style="margin-left:10px" @click="createGame">Создать игру</button>
                <button class="options__button" v-if="gameCode" style="margin-left:10px" @click="joinToGame">Перейти на доску</button>
            </div>
            <div style="margin-top:40px;">
                <input class="options__input" type="text" placeholder="код игры" v-model="gameCode"/>
                <button class="options__button options__button_higher" style="margin-left:10px" @click="joinToGameByCode">Присоедениться по коду</button>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import axios from 'axios'
import { ref } from "vue";
import { useRouter, useRoute } from 'vue-router'

const router = useRouter();
const route = useRoute()

const gameCode = ref('')
const gameId = ref('')

const createGame = async () => {
    const apiClient = axios.create({
        baseURL: 'http://HTTP://157.230.103.255/api/api',
        headers: {'Authorization': 'Bearer ' + localStorage.getItem('token')}
    })
    apiClient.post('/game/create')
    .then(res => {
        gameCode.value = res.data.game_code
        gameId.value = res.data.id
    })
}

const joinToGame = async () => {
    router.push({
        name: 'board',
        params: {
            id: gameId.value
        }
    })
}

const joinToGameByCode = async () => {
    if(gameCode.value) {
        const apiClient = axios.create({
            baseURL: 'http://HTTP://157.230.103.255/api/api',
            headers: {'Authorization': 'Bearer ' + localStorage.getItem('token')}
        })
        apiClient.post('/game/connect/' + gameCode.value)
        .then(res => {
            joinToGame()
        })
    }
    else {
        alert('Введите код')
    }
}

</script>

<style scoped>
.create_game_button{
  width: 300px;
  height: 90px;
  background-color: black;
  border-color: transparent;
  border-radius: 5px;
  color: white;
  font-size: 30px;
  cursor: pointer;
}
.options__button {
  width: 300px;
  height: 90px;
  background-color: black;
  border-color: transparent;
  border-radius: 5px;
  color: white;
  font-size: 17px;
  cursor: pointer;
}
.options__input {
    width: 200px;
    height: 40px;
    font-size: 20px;
    border-radius: 10px;
}

.options__button_higher {
    height: 50px;
}

.options__game-code-text {
    display: block;
    width: 400px;
    font-size: 30px;
    color: white;
    position: absolute;
    top: -40%;
    left: 35%;
}
.options__game-code {
    color: green;
    font-weight: 900;
}

.options__block {
    display: flex;
}
</style>