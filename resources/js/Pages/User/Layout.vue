<template>
    <div class="md:flex md:flex-col">
        <div class="md:h-screen md:flex md:flex-col">
            <div class="md:flex md:flex-shrink-0">

                <banner></banner>

                <div class="bg-white border-b w-full p-4 md:py-0 md:px-12 text-sm md:text-md flex justify-between items-center">
                    <div class="mt-1 mr-4">Klosz Group</div>

                    <dropdown class="mt-1" placement="bottom-end">
                        <template #default>

                            <span>{{ user.name }} {{user.last_name}}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="w-5 h-5 group-hover:fill-indigo-600 fill-gray-700 focus:fill-indigo-600"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>

                        </template>
                        <template #dropdown>
                            <div>
                                <Link :href="route('users.edit', `${user.id}`)" class="block px-6 py-2 hover:bg-indigo-500 hover:text-white">My Profile</Link>
                                <Link :href="route('users.index')" class="block px-6 py-2 hover:bg-indigo-500 hover:text-white">Managed Users</Link>
                                <Link :href="route('logout')" class="block px-6 py-2 w-full text-left hover:text-white hover:bg-indigo-500" method="post" as="button">Logout</Link>
                            </div>
                        </template>
                    </dropdown>

                </div>
            </div>

            <div class="md:flex md:flex-grow md:overflow-hidden">
                <div class="hidden md:block bg-sky-800 flex-shrink-0 w-56 p-12 overflow-y-auto">
                    <div class="mb-4">
                        <Link :href="route('user.dashboard',this.company)" class="flex items-center group py-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="w-4 h-4 mr-2 fill-zinc-400 group-hover:fill-white">
                                <path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm-5.6-4.29a9.95 9.95 0 0 1 11.2 0 8 8 0 1 0-11.2 0zm6.12-7.64l3.02-3.02 1.41 1.41-3.02 3.02a2 2 0 1 1-1.41-1.41z"></path>
                            </svg>
                            <div class="text-zinc-300 group-hover:text-white">Dashboard</div>
                        </Link>
                    </div>
                    <div class="mb-4">
                        <Link :href="route('user.registries.index',this.company)" class="flex items-center group py-3">
                            <svg class="w-4 h-4 mr-2 fill-zinc-400 group-hover:fill-white" viewBox="0 0 20 20">
                                <path d="M10,6.978c-1.666,0-3.022,1.356-3.022,3.022S8.334,13.022,10,13.022s3.022-1.356,3.022-3.022S11.666,6.978,10,6.978M10,12.267c-1.25,0-2.267-1.017-2.267-2.267c0-1.25,1.016-2.267,2.267-2.267c1.251,0,2.267,1.016,2.267,2.267C12.267,11.25,11.251,12.267,10,12.267 M18.391,9.733l-1.624-1.639C14.966,6.279,12.563,5.278,10,5.278S5.034,6.279,3.234,8.094L1.609,9.733c-0.146,0.147-0.146,0.386,0,0.533l1.625,1.639c1.8,1.815,4.203,2.816,6.766,2.816s4.966-1.001,6.767-2.816l1.624-1.639C18.536,10.119,18.536,9.881,18.391,9.733 M16.229,11.373c-1.656,1.672-3.868,2.594-6.229,2.594s-4.573-0.922-6.23-2.594L2.41,10l1.36-1.374C5.427,6.955,7.639,6.033,10,6.033s4.573,0.922,6.229,2.593L17.59,10L16.229,11.373z"></path>
                            </svg>
                            <div class="text-zinc-300 group-hover:text-white">Registry</div>
                        </Link>
                    </div>

                </div>


                <div class="px-4 py-8 md:flex-1 md:p-12 md:overflow-y-auto" >
                    <flash-messages />
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import { defineComponent, computed } from 'vue'
import {Head, Link, usePage} from '@inertiajs/inertia-vue3';
import Banner from '@/Shared/Banner.vue'
import Dropdown from "@/Shared/Dropdown";
import FlashMessages from "@/Shared/FlashMessages";


export default defineComponent({

    name: 'User/Layout',

    setup() {
        const user = computed(() => usePage().props.value.auth.user)
        return { user }
    },
    props:{
        company: Object
    },


    components: {
        Dropdown,
        Head,
        Link,
        Banner,
        FlashMessages
    },

})

</script>
