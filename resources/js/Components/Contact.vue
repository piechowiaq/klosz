<script setup>

import TextInput from "@/Shared/TextInput";
import TextArea from "@/Shared/TextArea";
import LoadingButton from '@/Shared/LoadingButton'
import { useForm } from '@inertiajs/inertia-vue3'


const form = useForm({
    name: null,
    email: null,
    body: null,
})

const send = () => {
    form.post('/contact')
}

</script>

<template>
    <div class=" lg:flex lg:justify-center grid grid-cols-1">
        <div class="p-6 lg:w-1/2 bg-white dark:bg-gray-800 shadow rounded-lg">
            <div class="flex justify-between">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 6l6.108 4.612l.002.002c.678.497 1.017.746 1.389.842a2 2 0 0 0 1.002 0c.372-.096.712-.345 1.392-.844c0 0 3.917-3.006 6.107-4.612M3 15.8V8.2c0-1.12 0-1.68.218-2.108c.192-.377.497-.682.874-.874C4.52 5 5.08 5 6.2 5h11.6c1.12 0 1.68 0 2.107.218c.377.192.683.497.875.874c.218.427.218.987.218 2.105v7.607c0 1.118 0 1.676-.218 2.104a2.002 2.002 0 0 1-.875.874c-.427.218-.986.218-2.104.218H6.197c-1.118 0-1.678 0-2.105-.218a2 2 0 0 1-.874-.874C3 17.48 3 16.92 3 15.8Z"/>
                    </svg>
                    <div class="ml-4 text-lg leading-7 font-semibold dark:text-white">Contact</div>
                </div>
                <button @click="$emit('setStatus', null)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="m-4 w-4 h-4 text-gray-500" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 6L6 18M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="mx-12">
                <form class="mt-2 text-gray-600 dark:text-gray-400 text-sm text-justify" @submit.prevent="send">
                    <TextInput v-model="form.name" :error="form.errors.name" label="Name" type="text"/>
                    <TextInput v-model="form.email" :error="form.errors.email" class="mt-2" label="Email" type="text" autocapitalize="off"/>
                    <TextArea v-model="form.body" :error="form.errors.body" class="mt-2" label="Message" type="text"/>
                    <p class="p-2 text-xs text-center">We will do our best to get back to you within
                        24h!</p>
                    <div class="flex px-10 py-4 bg-gray-100 border-t border-gray-100">
                        <LoadingButton :loading="form.processing" class="btn-cyan ml-auto" type="submit">Send</LoadingButton>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
