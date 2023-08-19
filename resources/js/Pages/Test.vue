<script setup>

import {ref, watch} from 'vue';

const active = ref(null)

const change = (message) => {
    alert(message)

}


</script>

<template>

    <button @click="change('hello')" class="bg-indigo-500 p-2">Login</button>

    <div v-if="active === 'contact'">
        <p>Contact Form</p>
    </div>

    <div v-else-if="active === 'login'">
        <p>Login form</p>
    </div>

    <div v-else>
        <p>Hello Main Part</p>
    </div>

    <button  class="bg-indigo-500 p-2">Contact</button>
</template>

<style scoped>

</style>
