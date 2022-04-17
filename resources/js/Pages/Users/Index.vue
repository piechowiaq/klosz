<template>
    <layout title="Users">
            <div>
                <h1 class="mb-8 font-bold text-3xl">Users</h1>
                    <div class="mb-6 flex justify-between items-center">

                        <div class="flex items-center w-full max-w-md mr-4">
                            <div class="flex w-full bg-white shadow rounded">

                                    <div class="relative">
                                        <button @click="isOpen = !isOpen"  class="flex h-full w-full bg-white shadow rounded py-4 px-4 border-r hover:bg-gray-100 focus:border-white focus:ring focus:z-50  z-50 block focus:outline-none">
                                            <span>Filter</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="w-5 h-5 group-hover:fill-indigo-600 fill-gray-700 focus:fill-indigo-600"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                        </button>
                                        <button v-if="isOpen" @click="isOpen = false" tabindex="-1" class="fixed inset-0 w-full h-full bg-black opacity-20 cursor-default"></button>
                                        <div v-if="isOpen" class="absolute mt-2 px-4 py-6 w-screen bg-white text-sm rounded shadow-xl" style="max-width: 300px">
                                            <label class="block text-gray-700">Trashed:</label>
                                            <select v-model="form.trashed" class="form-select text-sm mt-1 w-full">
                                                <option :value="null" />
                                                <option value="with">With Trashed</option>
                                                <option value="only">Only Trashed</option>
                                            </select>
                                        </div>
                                    </div>
                                <input v-model="form.search"  type="text" name="search" placeholder="Search…" class="w-full px-6 py-3 rounded-r focus:ring">
                            </div>
                            <button type="button" class="ml-3 text-sm text-gray-500 hover:text-gray-700 focus:text-indigo-500"  @click="reset">Reset</button>
                        </div>

                        <Link :href="route('users.create')" >
                           Create User
                        </Link>
                    </div>
                    <div class="bg-white rounded-md shadow overflow-x-auto">
                        <table class="w-full whitespace-nowrap">
                            <tr class="text-left font-bold">
                                <th class="px-6 pt-6 pb-4">Name</th>
                                <th class="px-6 pt-6 pb-4">Last Name</th>
                                <th class="px-6 pt-6 pb-4">E-Mail</th>
                                <th colspan="2" class="px-6 pt-6 pb-4">Phone</th>
                            </tr>
                            <tr v-for="user of users.data"  :key="user.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                <td class="border-t">
                                    <Link value="Edit" :href="route('users.edit', user)" class="px-6 py-4 flex items-center focus:text-indigo-500">{{ user.name }}</Link>
                                </td>
                                <td class="border-t">
                                    <Link value="Edit" :href="route('users.edit', user)" class="px-6 py-4 flex items-center focus:text-indigo-500"> {{ user.last_name }} </Link>
                                </td>
                                <td class="border-t">
                                    <Link value="Edit" :href="route('users.edit', user)" class="px-6 py-4 flex items-center focus:text-indigo-500">{{ user.email }}</Link>
                                </td>

                                <td class="border-t">
                                    <Link value="Edit" :href="route('users.edit', user)" class="px-6 py-4 flex items-center focus:text-indigo-500">{{ user.phone }}</Link>
                                </td>
                                <td class="w-px border-t">
                                    <Link class="flex items-center px-4" :href="route('users.edit', user)" tabindex="-1">
                                        <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
                                    </Link>
                                </td>
                            </tr>
                            <tr v-if="users.length === 0">
                                <td class="px-6 py-4 border-t" colspan="4">No users found.</td>
                            </tr>
                        </table>
                    </div>
                    <div class="mt-6">
                        <div class="flex flex-wrap -mb-1">
                            <Pagination :links="users.links"></Pagination>
                        </div>
                    </div>
                </div>
       </layout>
</template>

<script>
import { defineComponent, onUnmounted } from 'vue';
import Layout from "../Layout";
import Icon from "@/Shared/Icon.vue"
import {Link} from "@inertiajs/inertia-vue3";
import Pagination from '@/Shared/Pagination.vue'
import {debounce, mapValues, pickBy, throttle} from "lodash";


export default defineComponent({
    name: 'Users/Index',

    components: {
        Layout,
        Link,
        Pagination,
        Icon,
    },
    props: {
        users: Object,
        filters: Object
    },
    data() {
        return {
            isOpen: false,
            form: {
                search: this.filters.search,
                trashed: this.filters.trashed,
            },
        }
    },
    watch: {
        form: {
            deep: true,
            handler: debounce(function () {
                this.$inertia.get(this.route('users.index'), this.form, { preserveState: true , replace: true})
            }, 150),
        },
    },
    methods:{
        destroy(user) {
            this.$inertia.delete(this.route('users.destroy', user))
        },
        reset() {
            this.form = mapValues(this.form, () => null)
        },
    },
    mounted() {
        const onEscape = (e) => {
            if (!this.isOpen || e.key !== 'Escape') {
                return
            }
            this.isOpen = false
        }
        document.addEventListener('keydown', onEscape)
        onUnmounted(() => document.removeEventListener('keydown', onEscape))
    },
})
</script>
