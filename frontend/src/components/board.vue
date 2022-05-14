<template>
    <div class="board">
        <div v-for="(column, index) in opponentColumn" :key="index">
            <label>{{column}}</label>
            <div class="section" @click="opponentMove(index)">
                <div v-if="column == -1" class="tozdyk"></div>
                <div v-else v-for="item in column" :key="item" class="kumalak"></div>
            </div>
            <div class="line"></div>
            <label>{{section}}</label>
        </div>
        <div v-for="(column, index) in userColumn" :key="index">
            <label>{{column}}</label>
            <div class="section" @click="userMove(index)">
                <div v-if="column == -1" class="tozdyk"></div>
                <div v-else v-for="item in column" :key="item" class="kumalak">
                </div>
            </div>
            <div class="line"></div>
            <label>{{section}}</label>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { onMounted, ref } from "vue";
import axios from 'axios'
import { useRouter, useRoute } from 'vue-router'

const router = useRouter();
const route = useRoute()

const getGame =async () => {
    const apiClient = axios.create({
        baseURL: 'http://localhost:8000/api',
        headers: {'Authorization': 'Bearer ' + localStorage.getItem('token')}
    })
    apiClient.get('/game/get/' + route.params.id)
    .then(res => {
        setGameData(res)
    })
}

const userMove =async (index: number) => {
    if(move.value === 0) {
        const apiClient = axios.create({
            baseURL: 'http://localhost:8000/api',
            headers: {'Authorization': 'Bearer ' + localStorage.getItem('token')}
        })
        apiClient.post('/game/usermove/' + route.params.id, { 'column' : index + 1})
        .then(res => {
            setGameData(res)
        })
    }
    else {
        alert('Не ваш ход!')
    }
}

const opponentMove =async (index: number) => {
    if(move.value === 1) {
        const apiClient = axios.create({
            baseURL: 'http://localhost:8000/api',
            headers: {'Authorization': 'Bearer ' + localStorage.getItem('token')}
        })
        apiClient.post('/game/opponentmove/' + route.params.id, { 'column' : 9 - index })
        .then(res => {
            setGameData(res)
        })
    }
    else {
        alert('Не ваш ход!')
    }
}

const setGameData = (res) => {
    move.value = res.data.move;

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
    userColumn.value = localUserColumn;

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
    opponentColumn.value = localOppCol
}

const showLine = () => {
    for(let index=0; index<18;index++) {
        const section = document.getElementsByClassName('section')[index] as HTMLElement | null;
        const line = document.getElementsByClassName('line')[index] as HTMLElement | null;

        section.addEventListener('mouseover', () => {
            line.style.visibility = 'inherit'
        })

        section.addEventListener('mouseleave', () => {
            line.style.visibility = 'hidden'
        })
    }    
};

onMounted(showLine)
onMounted(getGame)

const userColumn = ref([9, 9, 9, 9, 9, 9, 9, 9, 9])
const opponentColumn = ref([9, 9, 9, 9, 9, 9, 9, 9, 9])
const move = ref(0)

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


</style>
