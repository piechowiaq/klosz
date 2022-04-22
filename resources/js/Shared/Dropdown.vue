<template>
    <div class="relative">
        <button @click="isOpen = !isOpen" class="flex z-10 block focus:outline-none">
            <span>{{ user.name }} {{user.last_name}}</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="w-5 h-5 group-hover:fill-indigo-600 fill-gray-700 focus:fill-indigo-600"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
        </button>
        <button v-if="isOpen" @click="isOpen = false" tabindex="-1" class="fixed inset-0 w-full h-full bg-black opacity-20  cursor-default"></button>
        <div v-if="isOpen" class="absolute right-0 mt-2 py-2 w-40 bg-white rounded  text-sm shadow-xl">
            <Link :href="route('users.edit', `${user.id}`)" class="block px-6 py-2 hover:bg-indigo-500 hover:text-white">My Profile</Link>
            <Link :href="route('users.index')" class="block px-6 py-2 hover:bg-indigo-500 hover:text-white">Managed Users</Link>
            <Link :href="route('logout')" class="block px-6 py-2 w-full text-left hover:text-white hover:bg-indigo-500" method="post" as="button">Logout</Link>
        </div>
    </div>
</template>

<script>
import { defineComponent, onUnmounted, computed } from 'vue'
import { Link } from '@inertiajs/inertia-vue3';
import { usePage } from '@inertiajs/inertia-vue3'

export default defineComponent({
    name: 'Dropdown',

    setup() {
        const user = computed(() => usePage().props.value.auth.user)
        return { user }
    },
    components: {
        Link,
    },
    data(){
        return {
            isOpen: false
        }
    },
    props: {
        auth: Object,
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
