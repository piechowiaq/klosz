<template>
        <layout title="Companies">
            <div class="md:flex-1 px-4 py-8 md:p-12 md:overflow-y-auto">
                <div>
                    <h1 class="mb-8 font-bold text-3xl">Companies</h1>
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
                                <input autocomplete="off" type="text" name="search" placeholder="Search…" class="relative w-full px-6 py-3 rounded-r focus:ring">
                            </div> <button type="button" class="ml-3 text-sm text-gray-500 hover:text-gray-700 focus:text-indigo-500">Reset</button>
                        </div>

                        <Link :href="route('companies.create')" >
                           Create Company
                        </Link>
                    </div>
                    <div class="bg-white rounded-md shadow overflow-x-auto">
                        <table class="w-full whitespace-nowrap">
                            <tr class="text-left font-bold">
                                <th class="px-6 pt-6 pb-4">Name</th>
                                <th class="px-6 pt-6 pb-4">City</th>
                                <th class="px-6 pt-6 pb-4">E-mail</th>
                                <th colspan="2" class="px-6 pt-6 pb-4">Phone</th>
                            </tr>
                            <tr v-for="company of companies.data"  :key="company.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                <td class="border-t">
                                    <Link value="Edit" :href="route('companies.edit', company)" class="px-6 py-4 flex items-center focus:text-indigo-500">{{ company.name }}</Link>
                                </td>
                                <td class="border-t">
                                    <Link value="Edit" :href="route('companies.edit', company)" class="px-6 py-4 flex items-center focus:text-indigo-500">{{ company.city }}</Link>
                                </td>
                                <td class="border-t">
                                    <Link value="Edit" :href="route('companies.edit', company)" class="px-6 py-4 flex items-center focus:text-indigo-500">{{ company.email }}</Link>
                                </td>
                                <td class="border-t">
                                    <Link value="Edit" :href="route('companies.edit', company)" class="px-6 py-4 flex items-center focus:text-indigo-500">{{ company.phone }}</Link>
                                </td>
                                <td class="w-px border-t">
                                    <Link class="flex items-center px-4" :href="route('companies.edit', company)" tabindex="-1">
                                        <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
                                    </Link>
                                </td>
                            </tr>
                            <tr v-if="companies.length === 0">
                                <td class="px-6 py-4 border-t" colspan="4">No users found.</td>
                            </tr>
                        </table>
                    </div>
                    <div class="mt-6">
                        <div class="flex flex-wrap -mb-1">
                            <Pagination :links="companies.links"></Pagination>
                        </div>
                    </div>
                </div>
            </div>


<!--        <div class="py-12">-->
<!--            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">-->
<!--                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">-->
<!--                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200 text-gray-500">-->
<!--                        <div v-for="user of users.data"  :key="user.id" class="flex justify-between">-->
<!--                            <div v-text="user.name"></div>-->
<!--                            <div class="flex justify-between">-->
<!--                                <Link value="Edit" :href="route('users.edit', user)" class="w-24 text-center items-center px-4 py-2 bg-blue-500 border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-400 active:bg-blue-600 focus:outline-none focus:border-blue-600 focus:ring focus:ring-blue-100 disabled:opacity-25 transition">Edit</Link>-->
<!--                                <jet-button value="Delete" @click.once="destroy(user)" >Delete</jet-button>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <Pagination :links="users.links"></Pagination>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

        </layout>
</template>

<script>
import { defineComponent } from 'vue'
import Layout from "../Layout";
import Icon from "@/Shared/Icon.vue"
import {Link} from "@inertiajs/inertia-vue3";
import JetButton from '@/Jetstream/Button.vue'
import Pagination from '@/Shared/Pagination.vue'

export default defineComponent({
    name: 'Companies/Index',
    components: {
        Layout,
        JetButton,
        Link,
        Pagination,
        Icon
    },
    props: {
        companies: Object
    },

})
</script>
