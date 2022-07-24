<template>
    <layout>

        <div class="md:flex md:flex-grow md:overflow-hidden">

            <user-navigation :company="company"/>

            <div class="px-4 py-8 md:flex-1 md:p-12 md:overflow-y-auto">
                <flash-messages/>
                <div>
                    <h1 class="mb-8 font-bold text-3xl">Przeglądy</h1>
                    <div class="mb-6 flex justify-between items-center">
                        <div class="flex">
                            <div class="flex w-full bg-white shadow rounded">

                                <div>
                                    <button @click="isOpen = !isOpen"
                                            class="flex h-full w-full bg-white shadow rounded py-4 px-4 ">
                                        <span>Filter</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                             class="w-5 h-5 group-hover:fill-indigo-600 fill-gray-700 focus:fill-indigo-600">
                                            <path
                                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                        </svg>
                                    </button>
                                    <button v-if="isOpen" @click="isOpen = false" tabindex="-1"
                                            class="fixed inset-0 w-full h-full bg-black opacity-20 cursor-default"></button>
                                    <div v-if="isOpen"
                                         class="absolute mt-2 px-4 py-6 w-screen bg-white text-sm rounded shadow-xl"
                                         style="max-width: 300px">
                                        <label class="block text-gray-700">Expired:</label>
                                        <select v-model="form.expired"
                                                class="form-select text-sm mt-1 w-full px-6 py-2">
                                            <option :value="null"/>
                                            <option value="only">Only Expired</option>
                                        </select>
                                    </div>
                                </div>
                                <input v-model="form.search" type="text" name="search" placeholder="Search…"
                                       class="w-full px-6 py-3 rounded-r focus:ring">
                            </div>
                            <button type="button"
                                    class="flex ml-3 text-sm text-gray-500 hover:text-gray-700 focus:text-indigo-500"
                                    @click="reset()">Reset
                            </button>
                        </div>


                    </div>
                    <div class="bg-white shadow overflow-x-auto">
                        <table class="w-full whitespace-nowrap">
                            <tr class="text-left font-bold">
                                <th class="px-6 pt-6 pb-4 w-2/3">Nazwa przeglądu</th>
                                <th class="px-6 pt-6 pb-4"></th>
                                <th colspan="2" class="px-6 pt-6 pb-4">Wygasa za</th>
                                <th class="px-6 pt-6 pb-4">Pobierz</th>
                                <th class="px-6 pt-6 pb-4"></th>
                            </tr>
                            <tr v-for="registry of registries.data" :key="registry.id"
                                class="hover:bg-gray-100 focus-within:bg-gray-100">
                                <td class="border-t">
                                    <Link value="Edit" :href="route('user.registries.show', [company, registry])"
                                          class="px-6 py-3 flex items-center focus:text-indigo-500">{{
                                            registry.name
                                        }}
                                    </Link>
                                </td>
                                <td class="border-t w-px">
                                    <div v-if="expired(registry.expiry_days)">
                                        <icon name="expired" class="block m-auto text-red-500 h-6 w-6"/>
                                    </div>
                                </td>
                                <td class="border-t" >
                                    <Link value="Edit" :href="route('user.registries.show', [company, registry])"
                                          class="px-6 py-3 flex items-center focus:text-indigo-500">
                                        {{registry.expiry_days }} dni
                                    </Link>
                                </td>
                                <td class="border-t">
                                    <Link value="Edit" :href="route('user.registries.show', [company, registry])"
                                          class="pr-6 py-3 w-auto flex items-center text-sm text-gray-300 focus:text-indigo-500">
                                        {{ registry.latest_date }}
                                    </Link>
                                </td>
                                <td class="border-t">
                                    <Link value="Edit" v-if="! expired(registry.expiry_days)"
                                          :href="route('user.dashboard', [company, registry])"
                                          class=" hover:bg-indigo-300 px-6 py-3 flex items-center focus:text-indigo-500">

                                        <icon name="download" class="block m-auto h-6 w-6 "/>

                                    </Link>
                                    <icon v-else name="download" class="text-gray-300 block m-auto h-6 w-6 "/>

                                </td>
                                <td class="border-t">
                                    <Link class="flex items-center px-4"
                                          :href="route('user.registries.show', [company, registry])" tabindex="-1">
                                        <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400"/>
                                    </Link>
                                </td>
                            </tr>


                            <tr v-if="registries.length === 0">
                                <td class="px-6 py-4 border-t" colspan="4">No registries found.</td>
                            </tr>
                        </table>
                    </div>
                    <div class="mt-6">
                        <div class="flex flex-wrap -mb-1">
                            <Pagination :links="registries.links"></Pagination>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </layout>

</template>

<script>

import {defineComponent, computed} from 'vue'
import {Head, Link, usePage} from '@inertiajs/inertia-vue3';
import Layout from "@/Layouts/AppLayout.vue"

import {debounce, mapValues} from "lodash"


import Icon from "@/Shared/Icon.vue"
import Pagination from '@/Shared/Pagination.vue'

import UserNavigation from "@/Shared/UserNavigation";
import Banner from '@/Shared/Banner.vue'
import Dropdown from "@/Shared/Dropdown";
import FlashMessages from "@/Shared/FlashMessages";

export default defineComponent({
    name: 'User/Pages/Registries/Index',
    components: {
        Layout,
        Link,
        Pagination,
        Icon,
        UserNavigation,
        Banner,
        Dropdown,
        FlashMessages
    },
    setup() {
        const user = computed(() => usePage().props.value.auth.user)
        return {user}
    },
    props: {
        company: Object,
        registries: Object,
        filters: Object,
        reports: Array,

    },
    data() {
        return {
            isOpen: false,
            form: {
                search: this.filters.search,
                expired: this.filters.expired,

            },
        }
    },
    watch: {
        form: {
            deep: true,
            handler: debounce(function () {
                this.$inertia.get(this.route('user.registries.index', this.company), this.form, {
                    preserveState: true,
                    replace: true
                })
            }, 150),
        },
    },

    methods: {
        destroy(registry) {
            this.$inertia.delete(this.route('registries.destroy', registry))
        },
        reset() {
            this.form = mapValues(this.form, () => null)
        },
        expired(registry) {




            return registry <= 0;


        },
        // reportExpiresInDays(registry) {
        //     const result = this.reports.find(({id}) => id === registry);
        //
        //
        //     return result['expiry_days'];
        // },
        // reportExpiryDate(registry) {
        //     const result = this.reports.find(({id}) => id === registry);
        //
        //
        //     return result['latest_date'];
        // },

    },

})
</script>
