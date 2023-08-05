<template>

    <layout :company="company">
            <div class="md:flex md:flex-grow md:overflow-hidden">
                <user-navigation :company="company" :companies="companies"/>


                <div class="px-4 py-8 md:flex-1 md:p-12 md:overflow-y-auto" >

                    <div>
                        <div class="mb-6 flex justify-between items-center">
                            <h1 class="mb-8 font-bold text-3xl">{{registry.name}}</h1>
                            <Link :href="route('user.reports.create', [company, registry])">
                                Submit Report
                            </Link>
                        </div>


                        <div class="bg-white shadow overflow-x-auto px-6 pt-6 pb-4">
                            <div class="font-bold"> Description: </div> <br>

                            <div class=" text-sm mb-6">{{ registry.description }}</div>

                            <div class=" font-bold"> Valid for | in months: </div> <br>

                            <div class="text-sm">{{ registry.valid_for }}</div>
                        </div>

                        <div class="bg-white shadow overflow-x-auto mt-4">
                            <table class="w-full whitespace-nowrap">
                                <tr class="text-left font-bold">
                                    <th class="px-6 pt-6 pb-4">Reports</th>

                                </tr>
                                <tr v-for="report of reports" :key="report.id"
                                    class="hover:bg-gray-100 focus-within:bg-gray-100">
                                    <td class="border-t">
                                        <div class="px-6 py-4 flex items-center focus:text-indigo-500">{{ report.report_date }}
                                        </div>
                                    </td>
                                </tr>
                                <tr v-if="reports.length === 0">
                                    <td class="px-6 py-4 border-t" colspan="4">No reports found.</td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
    </layout>




</template>

<script>

import { defineComponent, computed } from 'vue'
import {Head, Link, usePage} from '@inertiajs/inertia-vue3';

import {debounce, mapValues} from "lodash"


import Icon from "@/Shared/Icon.vue"
import Pagination from '@/Shared/Pagination.vue'
import Search from "@/Shared/Search";

import Banner from '@/Shared/Banner.vue'
import Dropdown from "@/Shared/Dropdown";
import FlashMessages from "@/Shared/FlashMessages";
import Layout from "@/Layouts/AppLayout";
import UserNavigation from "@/Shared/UserNavigation";

export default defineComponent({
    name: 'User/Pages/Registries/Show',
    components: {
        UserNavigation,
        Layout,

        Link,
        Pagination,
        Icon,
        Search,
        Banner,
        Dropdown,
        FlashMessages
    },
    setup() {
        const user = computed(() => usePage().props.value.auth.user)
        return { user }
    },
    props: {
        company: Object,
        registry: Object,
        reports: Array,
        companies: Array

    },


})
</script>
