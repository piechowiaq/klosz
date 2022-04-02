<template>
    <layout title="Users">

            <div>
                <h1 class="mb-8 font-bold text-3xl">Roles</h1>
                <div class="mb-6 flex justify-between items-center">
                    <div class="flex items-center w-full max-w-md mr-4">
                        <div class="flex w-full bg-white shadow rounded">
                            <button type="button" class="px-4 md:px-6 rounded-l border-r hover:bg-gray-100 focus:border-white focus:ring focus:z-10">
                                <div class="flex items-baseline">
                                    <span class="text-gray-700 hidden md:inline">Filter</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 961.243 599.998" class="w-2 h-2 fill-gray-700 md:ml-2">
                                        <path d="M239.998 239.999L0 0h961.243L721.246 240c-131.999 132-240.28 240-240.624 239.999-.345-.001-108.625-108.001-240.624-240z">

                                        </path>
                                    </svg>
                                </div>
                            </button>
                            <input autocomplete="off" type="text" name="search" placeholder="Search…" class="w-full px-6 py-3 rounded-r focus:ring">
                        </div> <button type="button" class="ml-3 text-sm text-gray-500 hover:text-gray-700 focus:text-indigo-500">Reset</button>
                    </div>
                    <Link :href="route('roles.create')" >
                        Create Role
                    </Link>
                </div>
                <div class="bg-white rounded-md shadow overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <tr class="text-left font-bold">
                            <th class="px-6 pt-6 pb-4">Name</th>
                        </tr>
                        <tr v-for="role of roles.data"  :key="role.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                            <td class="border-t">
                                <Link value="Edit" :href="route('roles.edit', role )" class="px-6 py-4 flex items-center focus:text-indigo-500">{{ role.name }}</Link>
                            </td>
                            <td class="w-px border-t">
                                <Link class="flex items-center px-4" :href="route('roles.edit', role)" tabindex="-1">
                                    <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
                                </Link>
                            </td>
                        </tr>
                        <tr v-if="roles.length === 0">
                            <td class="px-6 py-4 border-t" colspan="4">No roles found.</td>
                        </tr>
                    </table>
                </div>
                <div class="mt-6">
                    <div class="flex flex-wrap -mb-1">
                        <Pagination :links="roles.links"></Pagination>
                    </div>
                </div>
            </div>

    </layout>
</template>

<script>
import { defineComponent , ref } from 'vue'
import Layout from "../Layout";
import Icon from "@/Shared/Icon.vue"
import {Link} from "@inertiajs/inertia-vue3";
import Pagination from '@/Shared/Pagination.vue'



export default defineComponent({
    name: 'Roles/Index',

    components: {
        Layout,
        Icon,
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

    },
})
</script>
