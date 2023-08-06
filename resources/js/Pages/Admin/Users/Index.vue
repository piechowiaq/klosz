<template>
    <layout title="Users">
        <div>
            <h1 class="mb-8 font-bold text-3xl">Users</h1>
            <div class="mb-6 flex justify-between items-center">
                <search v-model="form.search" v-model:trashed="form.trashed" @reset="reset" class="flex items-center w-full max-w-md mr-4"/>
                <Link :href="route('users.create')" >Create User</Link>
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
import Layout from "../../Layout.vue";
import Icon from "@/Shared/Icon.vue"
import {Link} from "@inertiajs/inertia-vue3";
import Pagination from '@/Shared/Pagination.vue'
import {debounce, mapValues} from "lodash";
import Search from "@/Shared/Search.vue"


export default defineComponent({
    name: 'Admin/Users/Index',

    components: {
        Layout,
        Link,
        Pagination,
        Icon,
        Search
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
})
</script>
