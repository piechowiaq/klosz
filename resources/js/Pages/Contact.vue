<template>
    <Head title="Contact us" />
    <div class="flex items-center justify-center p-6 min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="w-full max-w-md">
            <Logo class="block m-auto" height="150" />
            <form class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden" @submit.prevent="send">
                <div class="px-10 pt-12">
                    <h1 class="text-center text-3xl font-bold">Contact us!</h1>
                    <div class="mt-6 mx-auto w-24 border-b-2" />
                    <text-input v-model="form.name"  class="mt-10" label="Name" type="text" autofocus/>
                    <text-input v-model="form.email"  class="mt-10" label="Email" type="email" autofocus autocapitalize="off" />
                    <text-area v-model="form.body"  class="mt-6" label="Message" type="text" />
                </div>
                <div>
                    <p class="p-2 text-xs text-center">We will do our best to get back to you within 24h!</p>
                </div>
                <div class="flex px-10 py-4 bg-gray-100 border-t border-gray-100">
                    <loading-button :loading="form.processing" class="btn-cyan ml-auto" type="submit">Send</loading-button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { Head } from '@inertiajs/inertia-vue3'
import Logo from '@/Shared/Logo'
import TextInput from '@/Shared/TextInput'
import TextArea from '@/Shared/TextArea'
import LoadingButton from '@/Shared/LoadingButton'
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const form = reactive({
    name: '',
    email: '',
    body: '',
})

function send() {
    router.post('/contact', form)
}

</script>
