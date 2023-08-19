<script setup>

import TextInput from "@/Shared/TextInput";
import LoadingButton from "@/Shared/LoadingButton";
import { useForm } from '@inertiajs/inertia-vue3'
import Label from "@/Shared/Label";
import Checkbox from "@/Shared/Checkbox";

const form = useForm({
    email: null,
    password: null,
    body: null,
})


const login = () => {
   form.post('/login')
}

</script>

<template>
    <div class=" lg:flex lg:justify-center grid grid-cols-1">
        <div class="p-6 lg:w-1/2 bg-white dark:bg-gray-800 shadow rounded-lg">
            <div class="flex justify-between">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500"
                         viewBox="0 0 1024 1024">
                        <path fill="currentColor"
                              d="M521.7 82c-152.5-.4-286.7 78.5-363.4 197.7c-3.4 5.3.4 12.3 6.7 12.3h70.3c4.8 0 9.3-2.1 12.3-5.8c7-8.5 14.5-16.7 22.4-24.5c32.6-32.5 70.5-58.1 112.7-75.9c43.6-18.4 90-27.8 137.9-27.8c47.9 0 94.3 9.3 137.9 27.8c42.2 17.8 80.1 43.4 112.7 75.9c32.6 32.5 58.1 70.4 76 112.5C865.7 417.8 875 464.1 875 512c0 47.9-9.4 94.2-27.8 137.8c-17.8 42.1-43.4 80-76 112.5s-70.5 58.1-112.7 75.9A352.8 352.8 0 0 1 520.6 866c-47.9 0-94.3-9.4-137.9-27.8A353.84 353.84 0 0 1 270 762.3c-7.9-7.9-15.3-16.1-22.4-24.5c-3-3.7-7.6-5.8-12.3-5.8H165c-6.3 0-10.2 7-6.7 12.3C234.9 863.2 368.5 942 520.6 942c236.2 0 428-190.1 430.4-425.6C953.4 277.1 761.3 82.6 521.7 82zM395.02 624v-76h-314c-4.4 0-8-3.6-8-8v-56c0-4.4 3.6-8 8-8h314v-76c0-6.7 7.8-10.5 13-6.3l141.9 112a8 8 0 0 1 0 12.6l-141.9 112c-5.2 4.1-13 .4-13-6.3z"/>
                    </svg>
                    <div class="ml-4 text-lg leading-7 font-semibold dark:text-white">Login</div>
                </div>

                <button @click="$emit('setStatus', null)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="m-4 w-4 h-4 text-gray-500" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 6L6 18M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="mx-12">
                <form class="mt-2 text-gray-600 dark:text-gray-400 text-sm text-justify"
                      @submit.prevent="login">

                    <TextInput v-model="form.email" :error="form.errors.email" label="Email" type="email"/>
                    <div class="justify-between flex mt-2">
                        <label> Password </label>

                        <button @click="$emit('setStatus', 'forgottenPassword')" class="text-xs underline">Forgotten Password?</button>
                    </div>
                    <TextInput v-model="form.password" :error="form.errors.password" class="mt-2" type="password"/>
                    <Label class="py-2 text-xs flex items-center  select-none" for="remember">
                        <Checkbox id="remember" v-model="form.remember" class="mr-1" type="checkbox"/>
                        <span class="text-xs">Remember Me</span>
                    </Label>

                    <div class="flex px-10 py-4 bg-gray-100 border-t border-gray-100">
                        <LoadingButton :loading="form.processing" class="btn-cyan ml-auto" type="submit">Login</LoadingButton>
                    </div>
                </form>
            </div>
        </div>
    </div>

</template>



<style scoped>

</style>
