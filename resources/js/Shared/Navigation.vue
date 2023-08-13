<template>

    <div class="bg-gray-100 dark:bg-gray-900 md:flex-shrink-0 md:w-56 px-6 py-4 flex items-center justify-between md:justify-center">
        <Link :href="route('dashboard')" class="mt-1">
            <Logo></Logo>
        </Link>
    </div>

</template>

<script>

import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3';
import Logo from '@Shared/Logo'

export default defineComponent({
    name: 'Banner',

    components: {
        Link,
        Logo
    },
})

</script>
