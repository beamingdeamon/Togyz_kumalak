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

<script>
import axios from 'axios'
export default {
    data() {
        return {
            gameCode: '',
            gameId: '',
        }
    },
    methods: {
        async createGame() {
            const apiClient = axios.create({
                baseURL: '/api',
                headers: {'Authorization': 'Bearer ' + localStorage.getItem('token')}
            })
            apiClient.post('/game/create')
            .then(res => {
                this.gameCode = res.data.game_code
                this.gameId = res.data.id
            })
        },
        joinToGame() {
            this.$router.push({ name: 'board', params: {id: this.gameId}})
        },
        async joinToGameByCode() {
            if(this.gameCode) {
                const apiClient = axios.create({
                    baseURL: '/api',
                    headers: {'Authorization': 'Bearer ' + localStorage.getItem('token')}
                })
                apiClient.post('/game/connect/' + this.gameCode)
                .then(res => {
                    this.gameId = res.data[1].id
                    this.joinToGame()
                })
            }
            else {
                alert('Введите код')
            }
        }
    }
}
</script>

<style scoped>
.create_game_button{
  width: 300px;
  height: 90px;
  background-color: cornflowerblue;
  border-color: transparent;
  border-radius: 5px;
  color: white;
  font-size: 30px;
  cursor: pointer;
}
.options__button {
  width: 300px;
  height: 90px;
  background-color: cornflowerblue;
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
    color: black;
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