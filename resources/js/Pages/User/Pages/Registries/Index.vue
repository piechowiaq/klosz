<template>
    <layout :company="company">

        <div class="md:flex md:flex-grow md:overflow-hidden">

            <user-navigation :company="company"/>

            <div class="px-4 py-8 md:flex-1 md:p-12 md:overflow-y-auto">
                <flash-messages/>
                <div>
                    <h1 class="mb-8 font-bold text-3xl">Przeglądy</h1>
                    <div class="mb-6 flex justify-between items-center">
                        <div class="flex">
                            <div class="flex w-full bg-white shadow rounded">



                                <input v-model="form.search" type="text" name="search" placeholder="Search…"
                                       class="w-full px-6 py-3 focus:ring">
                            </div>
                            <button type="button"
                                    class="flex ml-3 items-center text-sm text-gray-500 hover:text-gray-700 focus:text-indigo-500"
                                    @click="reset()">Reset
                            </button>
                        </div>


                    </div>
                    <div class="bg-white shadow overflow-x-auto">
                        <table class="w-full whitespace-nowrap">
                            <tr class="text-left font-bold">
                                <th class="px-6 pt-6 pb-4 w-2/3 flex" @click="sort('name')">
                                    Nazwa przeglądu

                                    <icon name="sorting" class="block m-auto ml-2 text-gray-300"/>

                                </th>
                                <th class="px-6 pt-6 pb-4"></th>
                                <th colspan="2" class="px-6 pt-6 pb-4 flex" @click="sort('expiry_date')">
                                   Wygasa za

                                    <icon name="sorting" class="block m-auto ml-2 text-gray-300 "/>



                                </th>
                                <th class="px-6 pt-6 pb-4">Pobierz</th>
                                <th class="px-6 pt-6 pb-4"></th>
                            </tr>
                            <tr v-for="registry of registries.data" :key="registry.id"
                                class="hover:bg-gray-100 focus-within:bg-gray-100">

                                <td class="border-t">
                                    <Link value="Edit"
                                          :href="route('user.registries.show', [registry.company_id, registry.registry_id])"

                                          class="px-6 py-3 flex items-center focus:text-indigo-500">{{
                                            registry.name
                                        }}
                                    </Link>
                                </td>
                                <td class="border-t w-px">
                                    <div v-if="expired(daysLeftUntilExpiryDate(registry.expiry_date))">
                                        <icon name="expired" class="block m-auto text-red-500 h-6 w-6"/>
                                    </div>
                                </td>
                                <td class="border-t" >
                                    <Link value="Edit"
                                          :href="route('user.registries.show', [registry.company_id, registry.registry_id])"
                                          class="px-6 py-3 flex items-center focus:text-indigo-500">
                                        {{ daysLeftUntilExpiryDate(registry.expiry_date) }} dni
                                    </Link>
                                </td>
                                <td class="border-t">
                                    <Link value="Edit"
                                          :href="route('user.registries.show', [registry.company_id, registry.registry_id])"
                                          class="pr-6 py-3 w-auto flex items-center text-sm text-gray-300 focus:text-indigo-500">
                                        {{ registry.expiry_date }}
                                    </Link>
                                </td>
                                <td class="border-t">
                                    <Link value="Edit" v-if="! expired(daysLeftUntilExpiryDate(registry.expiry_date))"
                                          :href="route('user.registries.show', [registry.company_id, registry.registry_id])"
                                          class=" hover:bg-indigo-300 px-6 py-3 flex items-center focus:text-indigo-500">

                                        <icon name="download" class="block m-auto h-6 w-6 "/>

                                    </Link>
                                    <icon v-else name="download" class="text-gray-300 block m-auto h-6 w-6 "/>

                                </td>
                                <td class="border-t">
                                    <Link class="flex items-center px-4"
                                          :href="route('user.registries.show', [registry.company_id, registry.registry_id])" tabindex="-1">
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

import {computed, defineComponent} from 'vue'
import {Link, usePage} from '@inertiajs/inertia-vue3';
import Layout from "@/Layouts/AppLayout.vue"

import {mapValues, pickBy, throttle} from "lodash"


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
    },
    data() {
        return {
            form: {
                search: this.filters.search,
                field: this.filters.field,
                direction: this.filters.direction,
            },
        }
    },
    watch: {
        form: {
            deep: true,
            handler: throttle(function () {

                let form = pickBy(this.form);

                this.$inertia.get(this.route('user.registries.index', this.company), form, {
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
        sort(field) {
            this.form.field =field;
            this.form.direction = this.form.direction === 'asc' ? 'desc' : 'asc';
        },
        expired(registry){
            return registry <= 0
        },
        daysLeftUntilExpiryDate(expiry_date){

            const today = new Date();
            const expiryDate = new Date(!expiry_date ? today : expiry_date);
            const diffTime = expiryDate-today;
            return Math.ceil(diffTime / (1000 * 60 * 60 * 24))
        }

    },

})
</script>
