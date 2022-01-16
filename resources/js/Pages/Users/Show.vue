<template>
    <app-layout title="Users">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Users
                </h2>
                <Link :href="route('users.create')">
                    <h2 class="inline-flex items-center px-3 mr-6 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                        Create
                    </h2>
                </Link>
            </div>

        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200 text-gray-500">
                            <div v-model="usere">
                                {{user.name}}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import {Link} from "@inertiajs/inertia-vue3";
import JetButton from '@/Jetstream/Button.vue'

export default defineComponent({
    name: 'Users/Show',
    components: {
        AppLayout,
        JetButton,
        Link
    },
    props: {
        user: Object
    },
})
</script>
