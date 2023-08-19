<script setup>

import TextInput from "@/Shared/TextInput";
import {Link} from "@inertiajs/vue3";

</script>

<template>
    <div  class=" lg:flex lg:justify-center grid grid-cols-1">
        <div class="p-6 lg:w-1/2 bg-white dark:bg-gray-800 shadow rounded-lg">
            <div class="flex justify-between">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg"  class="w-8 h-8 text-gray-500" viewBox="0 0 24 24"><path fill="currentColor" d="M13 21q-1.85 0-3.463-.688T6.7 18.425L8.125 17q.95.925 2.2 1.463T13 19q2.9 0 4.95-2.05T20 12q0-2.9-2.05-4.95T13 5q-2.9 0-4.95 2.05T6 12v.175l1.825-1.825l1.425 1.4L5 16L.75 11.75l1.425-1.4L4 12.2V12q0-1.875.713-3.513t1.925-2.85q1.212-1.212 2.85-1.924T13 3q1.875 0 3.513.713t2.85 1.924q1.212 1.213 1.925 2.85T22 12q0 3.75-2.625 6.375T13 21Zm-3-5v-5h1v-1q0-.825.588-1.413T13 8q.825 0 1.413.588T15 10v1h1v5h-6Zm2-5h2v-1q0-.425-.288-.713T13 9q-.425 0-.713.288T12 10v1Z"/></svg><div class="ml-4 text-lg leading-7 font-semibold dark:text-white">Password Reset</div>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="m-4 w-4 h-4 text-gray-500" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 6L6 18M6 6l12 12"/>
                    </svg>
                </div>
            </div>
            <div class="mx-12">
                <form class="mt-2 text-gray-600 dark:text-gray-400 text-sm text-justify"
                      @submit.prevent="login">



                    <TextInput class="mt-2" type="email" label="Email"/>
                    <TextInput class="mt-2" type="password" label="Password"/>
                    <TextInput class="mt-2" type="password" label="Confirm Password"/>



                    <div class="flex px-10 mt-2 py-4 bg-gray-100 border-t border-gray-100">
                        <Link as="button" class="btn-cyan ml-auto">Reset</Link>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>



<style scoped>

</style>
