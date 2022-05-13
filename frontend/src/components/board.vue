<template>
    <div class="board">
        <div v-for="(section, index) in data" :key="index">
            <label v-if="index < 9">{{section}}</label>
            <div class="section">
                <div v-for="item in section" :key="item" class="kumalak">
                </div>
            </div>
            <div class="line"></div>
            <label v-if="index >= 9">{{section}}</label>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { ref } from "vue";

const data = ref([ 9, 9, 9, 9, 9, 9, 9, 9, 9,
                   9, 9, 9, 9, 9, 9, 9, 9, 9])
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

.section:hover {
    text-decoration: underline;
}

.kumalak {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: saddlebrown;
    margin: auto;
}

.line {
    height: 5px;
    background-color: black;
    width: 84px;
    margin: 0 auto;
    border-radius: 2px;
}

</style>
