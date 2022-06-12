<template>
    <div>
        <div :class="isOpponent ? 'game_info__opponent' : 'game_info__user'" class="game_info" v-if="data">
            <div class="game_info-block">
                <label :class="move === 0 ? 'active-board' : ''" class="name">{{data.user.name}}</label>
                <label class="kazan">Казан {{data.user_column.kazan}}</label>
            </div>
            <div class="game_info-block" >
                <label :class="move === 1 ? 'active-board' : ''" class="name" v-if="data.opponent">{{data.opponent.name}}</label>
                <label class="kazan">Казан {{data.opponent_column.kazan}}</label>
            </div>
        </div>
        <div :class="isOpponent ? 'game_info__opponent' : 'game_info__user'" class="board">
            <div :class="data?.opponent?.email === userInfo?.email ? '' : 'not-clickable'" 
                v-for="(column, index) in opponentColumn" :key="index">
                <label class="section__number">{{column}}</label>
                <div class="section" @click="opponentMove(index)">
                    <div v-if="column == -1" class="tozdyk"></div>
                    <div v-else v-for="item in column" :key="item" class="kumalak"></div>
                </div>
                <div class="line"></div>
            </div>
            <div :class="data?.user?.email === userInfo?.email ? '' : 'not-clickable'" 
                  v-for="(column, index) in userColumn" :key="index">
                <label class="section__number">{{column}}</label>
                <div class="section" @click="userMove(index)">
                    <div v-if="column == -1" class="tozdyk"></div>
                    <div v-else v-for="item in column" :key="item" class="kumalak">
                    </div>
                </div>
                <div class="line"></div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            userInfo: null,
            data: null,
            move: 0,
            userColumn: [9, 9, 9, 9, 9, 9, 9, 9, 9],
            opponentColumn: [9, 9, 9, 9, 9, 9, 9, 9, 9],
            isOpponent: true,
        }
    },
    methods: {
        async getUserInfo() {
            const apiClient = axios.create({
                baseURL: '/api',
                headers: {'Authorization': 'Bearer ' + localStorage.getItem('token')}
            })
            apiClient.get('/user/userinfo' )
            .then(res => {
                this.userInfo = res.data
            })
        },
        getGame() {
            setInterval( async () => {
                const apiClient = axios.create({
                    baseURL: '/api',
                    headers: {'Authorization': 'Bearer ' + localStorage.getItem('token')}
                })
                await apiClient.get('/game/get/' +this.$route.params.id)
                .then(res => {
                        this.setGameData(res)
                        if(res.data.user.email === this.userInfo.email) {
                            this.isOpponent = false
                        }
                })
            }, 3000)
        },
        async userMove(index) {
            if(this.data && this.data.user && this.data.user.email) {
                if(this.userInfo && this.userInfo.email) {
                    if(this.data.user.email === this.userInfo.email) {
                        if(this.move === 0) {
                            const apiClient = axios.create({
                                baseURL: '/api',
                                headers: {'Authorization': 'Bearer ' + localStorage.getItem('token')}
                            })
                            apiClient.post('/game/usermove/' + this.$route.params.id, { 'column' : index + 1})
                            .then(res => {
                                if(res.status === 200) {
                                    this.setGameData(res);
                                }
                                else if(res.status === 300) {
                                    alert('Вы не можете ходить пустой колонкой!')
                                } 
                                else {
                                    alert("Ошибка системы возможно ход не засчитался!")
                                }
                            })
                        }
                    }
                }   
            }
            else {
                alert('Не ваш ход!')
            }
        },
        async opponentMove(index) {
            if(this.data && this.data.user && this.data.user.email) {
                if(this.userInfo && this.userInfo.email) {
                    if(this.data.opponent.email === this.userInfo.email) {
                        if(this.move === 1) {
                            const apiClient = axios.create({
                                baseURL: '/api',
                                headers: {'Authorization': 'Bearer ' + localStorage.getItem('token')}
                            })
                            apiClient.post('/game/opponentmove/' + this.$route.params.id,  { 'column' : 9 - index })
                            .then(res => {
                                if(res.status === 200) {
                                    this.setGameData(res);
                                }
                                else if(res.status === 300) {
                                    alert('Вы не можете ходить пустой колонкой!')
                                } 
                                else {
                                    alert("Ошибка системы возможно ход не засчитался!")
                                }
                            })
                        }
                    }
                }   
            }
            else {
                alert('Не ваш ход!')
            }
        },
        setGameData(res) {
            this.move = res.data.move;
            this.data = res.data

            let localUserColumn = [] 
            localUserColumn.push(res.data.user_column.first_column)
            localUserColumn.push(res.data.user_column.second_column)
            localUserColumn.push(res.data.user_column.three_column)
            localUserColumn.push(res.data.user_column.four_column)
            localUserColumn.push(res.data.user_column.five_column)
            localUserColumn.push(res.data.user_column.six_column)
            localUserColumn.push(res.data.user_column.seven_column)
            localUserColumn.push(res.data.user_column.eight_column)
            localUserColumn.push(res.data.user_column.nine_column)
            this.userColumn = localUserColumn;

            let localOppCol = []
            localOppCol.push(res.data.opponent_column.nine_column)
            localOppCol.push(res.data.opponent_column.eight_column)
            localOppCol.push(res.data.opponent_column.seven_column)
            localOppCol.push(res.data.opponent_column.six_column)
            localOppCol.push(res.data.opponent_column.five_column) 
            localOppCol.push(res.data.opponent_column.four_column)  
            localOppCol.push(res.data.opponent_column.three_column)
            localOppCol.push(res.data.opponent_column.second_column)
            localOppCol.push(res.data.opponent_column.first_column)
            this.opponentColumn = localOppCol
        },
        showLine() {
            for(let index=0; index<18;index++) {
                const section = document.getElementsByClassName('section')[index];
                const line = document.getElementsByClassName('line')[index];

                section.addEventListener('mouseover', () => {
                    line.style.visibility = 'inherit'
                })

                section.addEventListener('mouseleave', () => {
                    line.style.visibility = 'hidden'
                })
            }  
        }
    },
    mounted() {  
        this.getUserInfo()
        this.showLine()
        this.getGame()
    }
}
</script>

<style>
.board {
    display: grid;
    grid-template-columns: auto auto auto auto auto auto auto auto auto;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;

}

.section {
    display: grid;
    grid-template-columns: auto auto;

    width: 80px;
    height: 200px;
    background-color: aqua;
    margin: 5px;
    border: 3px solid black;
    border-radius: 5px;

    cursor: pointer;

    caret-color: transparent;
}

.kumalak {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: saddlebrown;
    margin: auto;
}

.tozdyk {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: white;
    margin: auto;
}

.line {
    visibility: hidden;
    height: 5px;
    background-color: black;
    width: 84px;
    margin: 0 auto;
    border-radius: 2px;
}

.active-board {
    zoom: 1.1;
    color: red;
    transition-timing-function: linear;
    transition: zoom 2s;
}

.game_info {
    caret-color: transparent;
    position: absolute;
    top: 40px;
    left: 50%;
    transform: translate(-50%, 0);
    color: white;
    display: flex;
    gap: 40px;
    font-size: 25px;
}

.game_info__opponent {
    flex-flow: row-reverse;
} 
.game_info__user {
    flex-flow: row;
}

.game_info-block {
    display: flex;
    flex-flow: column;
}

.section__number {
    color: white;
    font-size: 20px;
}

.not-clickable {
    pointer-events: none;
}
</style>
