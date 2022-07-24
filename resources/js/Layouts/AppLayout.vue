<template>

        <div class="md:flex md:flex-col">
            <div class="md:h-screen md:flex md:flex-col">
                <div class="md:flex md:flex-shrink-0">

                    <banner></banner>

                    <div
                        class="bg-white border-b w-full p-4 md:py-0 md:px-12 text-sm md:text-md flex justify-between items-center">
                        <div class="mt-1 mr-4">Klosz Group</div>

                        <dropdown class="mt-1" placement="bottom-end">
                            <template #default>

                                <span>{{ user.name }} {{ user.last_name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                     class="w-5 h-5 group-hover:fill-indigo-600 fill-gray-700 focus:fill-indigo-600">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>

                            </template>
                            <template #dropdown>
                                <div>
                                    <Link :href="route('users.edit', `${user.id}`)"
                                          class="block px-6 py-2 hover:bg-indigo-500 hover:text-white">My Profile
                                    </Link>
                                    <Link :href="route('users.index')"
                                          class="block px-6 py-2 hover:bg-indigo-500 hover:text-white">Managed Users
                                    </Link>
                                    <Link :href="route('logout')"
                                          class="block px-6 py-2 w-full text-left hover:text-white hover:bg-indigo-500"
                                          method="post" as="button">Logout
                                    </Link>
                                </div>
                            </template>
                        </dropdown>

                    </div>
                </div>




                <!-- Page Content -->

                <slot></slot>


    </div>
        </div>


</template>

<script>
import {Head, Link, usePage} from '@inertiajs/inertia-vue3';
import Banner from '@/Shared/Banner.vue'
import Dropdown from "@/Shared/Dropdown";
import {defineComponent, computed} from 'vue'


export default defineComponent ({
    name: "AppLayout",
    props: {
        title: String,
    },
    components: {
        Head,
        Link,
        Banner,
        Dropdown
    },
    setup() {
        const user = computed(() => usePage().props.value.auth.user)
        return {user}
    },
})
</script>

<style scoped>

</style>
