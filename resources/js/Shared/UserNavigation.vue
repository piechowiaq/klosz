<template>
    <div class="hidden md:block bg-sky-800 flex-shrink-0 w-56 p-12 overflow-y-auto">
        <div class="mb-4">
            <Link :href="route('user.dashboard',this.company)" class="flex items-center group py-3">
                <icon name="dashboard" class="w-4 h-4 mr-2 fill-zinc-400 group-hover:fill-white" />
                <div class="text-zinc-300 group-hover:text-white">Dashboard</div>
            </Link>
        </div>
        <div class="mb-4">
            <Link :href="route('user.registries.index',this.company)" class="flex items-center group py-3">
                <icon name="registries" class="w-4 h-4 mr-2 fill-zinc-400 group-hover:fill-white" />
                <div class="text-zinc-300 group-hover:text-white">Registry</div>
            </Link>
        </div>

    </div>
</template>

<script>

import {Link} from '@inertiajs/inertia-vue3';
import {defineComponent} from 'vue';
import Icon from "@/Shared/Icon.vue"

export default defineComponent( {
    name: "UserNavigation",
    components: {
                Link,
                Icon
    },
    props: {
        company: Object,
    }
})
</script>

<style scoped>

</style>
