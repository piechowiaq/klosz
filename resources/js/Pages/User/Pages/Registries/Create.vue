<template>

   <layout :company="company">
            <div class="md:flex md:flex-grow md:overflow-hidden">
                <user-navigation :company="company" :companies="companies"/>

                <div class="px-4 py-8 md:flex-1 md:p-12 md:overflow-y-auto" >

                    <div>
                        <div class="mb-6 flex justify-between items-center">
                            <h1 class="mb-8 font-bold text-3xl">{{registry.name}}</h1>

                        </div>


                        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                            <form @submit.prevent="store">
                                <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                                    <text-input type="date" v-model="form.report_date" :error="form.errors.report_date" class="pb-8 pr-6 w-full lg:w-1/2" label="Date of the report" />
                                    <text-input v-model="form.notes" :error="form.errors.notes" class="pb-8 pr-6 w-full lg:w-1/2" label="Notes" />

                                </div>
                                <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                                    <loading-button :loading="form.processing" class="btn-indigo" type="submit">Submit Report</loading-button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>

            </div>
   </layout>




</template>

<script>

import { defineComponent, computed ,reactive } from 'vue'
import {Head, Link, usePage} from '@inertiajs/inertia-vue3';
import { useRemember, useForm  } from '@inertiajs/inertia-vue3'
import TextInput from "@/Shared/TextInput.vue";
import LoadingButton from "@/Shared/LoadingButton.vue";

import Icon from "@/Shared/Icon.vue"
import Pagination from '@/Shared/Pagination.vue'
import Search from "@/Shared/Search.vue";
import Banner from '@/Shared/Banner.vue'
import Dropdown from "@/Shared/Dropdown.vue";
import FlashMessages from "@/Shared/FlashMessages.vue";
import UserNavigation from "@/Shared/UserNavigation.vue";
import Layout from "@/Layouts/AppLayout.vue";

export default defineComponent({
    name: 'User/Pages/Registries/Create',
    components: {
        Layout,
        UserNavigation,

        Link,
        Pagination,
        Icon,
        Search,
        Banner,
        Dropdown,
        FlashMessages,
        TextInput,
        LoadingButton
    },
    props: {
        company: Object,
        registry: Object,
        companies: Object

    },


    setup({registry, company}) {
        const form = useForm(useRemember(
            reactive({
                notes: null,
                report_date: null,
                registry_id: registry.id,
                company_id: company.id,
            })))
        const user = computed(() => usePage().props.value.auth.user)
        return {form, user}
    },


    methods: {
        store() {
            this.form.post(this.route('user.reports.store', [this.company, this.registry]))
        },
    },


})
</script>
