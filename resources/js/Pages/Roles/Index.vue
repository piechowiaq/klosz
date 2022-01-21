<template>
    <app-layout title="Dashboard">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Roles
                </h2>
                <Link :href="route('roles.create')">
                    <h2 class="inline-flex items-center px-3 mr-6 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                        Create
                    </h2>
                </Link>
            </div>

        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200 text-gray-500 justify-between">
                            <div v-for="role of roles.data" :key="role.id" class="flex justify-between">
                                <div v-text="role.name" ></div>
                                <div class="flex justify-between">
                                <Link value="Edit" :href="route('roles.edit', role)" class="w-24 text-center items-center px-4 py-2 bg-blue-500 border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-400 active:bg-blue-600 focus:outline-none focus:border-blue-600 focus:ring focus:ring-blue-100 disabled:opacity-25 transition">Edit</Link>
                                <jet-button value="Delete" @click="destroy(role)">Delete</jet-button>
                                </div>
                            </div>
                        <Pagination :links="roles.links"></Pagination>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import JetButton from '@/Jetstream/Button.vue'
import {Link} from "@inertiajs/inertia-vue3";
import Pagination from '@/Shared/Pagination.vue'

export default defineComponent({
    name: 'Roles/Index',

    components: {
        AppLayout,
        JetButton,
        Link,
        Pagination
    },
    props:{
        roles: Object,
    },
    methods:{
        destroy(role) {
            this.$inertia.delete(this.route('roles.destroy', role))
        },
    }

})
</script>
