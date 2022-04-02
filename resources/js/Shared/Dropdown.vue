<template>
    <div class="relative">
        <button @click="isOpen = !isOpen" class="relative z-10 block focus:outline-none">
            John Doe
        </button>
        <button v-if="isOpen" @click="isOpen = false" tabindex="-1" class="fixed inset-0 w-full h-full bg-black opacity-20 cursor-default"></button>
        <div v-if="isOpen" class="absolute right-0 mt-2 py-2 w-40 bg-white rounded  text-sm shadow-xl">
            <Link :href="route('companies.index')" class="block px-6 py-2 hover:bg-indigo-500 hover:text-white">My Profile</Link>
            <Link :href="route('companies.index')" class="block px-6 py-2 hover:bg-indigo-500 hover:text-white">Managed Users</Link>
            <Link :href="route('companies.index')" class="block px-6 py-2 hover:bg-indigo-500 hover:text-white">Log Out</Link>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
    name: 'Dropdown',

    components: {
        Link,
    },

    data(){
        return {
            isOpen: false
        }
    },
})

</script>
