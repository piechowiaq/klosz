<template>
    <layout>
        <div class="md:flex md:flex-grow md:overflow-hidden">
            <user-navigation :company="company"/>
            <div class="px-4 py-8 md:flex-1 md:p-12 md:overflow-y-auto">
                <h1 class="mb-8 text-3xl font-bold">Dashboard</h1>
                <p class="mb-8 leading-normal">Czesc there! Welcome to Ping CRM, a demo app designed to help illustrate
                    how <a class="text-indigo-500 hover:text-orange-600 underline" href="https://inertiajs.com">Inertia.js</a>
                    works.</p>
            </div>
        </div>
    </layout>
</template>

<script>

import Layout from '@/Layouts/AppLayout'
import UserNavigation from "@/Shared/UserNavigation";

export default {
    components: {
        Layout,
        UserNavigation,

    },

    props: {
        company: Object,
    }

}
</script>
