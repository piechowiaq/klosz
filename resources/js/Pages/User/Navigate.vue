<template>
    <Head title="Login" />
    <div class="flex items-center justify-center p-6 min-h-screen bg-sky-800">
        <div class="w-full max-w-md">
            <logo class="block mx-auto w-full max-w-xs fill-white" height="50" />
            <div class="px-10 py-12 mt-8 bg-white rounded-lg shadow-xl overflow-hidden">

                    <h1 class="text-center text-3xl font-bold">Please Choose</h1>
                    <div class="my-6 mx-auto w-24 border-b-2" />
                    <div v-for="company in userCompanies" :key="company.id" class="hover:bg-gray-100 focus-within:bg-gray-100 ">
                        <Link :href="route('user.dashboard', company )" class="px-6 py-4 flex focus:text-indigo-500">{{ company.name }}</Link>
                    </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import Logo from '@/Shared/Logo.vue'
import TextInput from '@/Shared/TextInput.vue'
import LoadingButton from '@/Shared/LoadingButton.vue'
import {Link} from "@inertiajs/inertia-vue3";

export default {
    name: 'User/Navigate',
    components: {
        Head,
        Link,
        LoadingButton,
        Logo,
        TextInput,
    },
    props:{
        userCompanies: Object
    }

}
</script>



