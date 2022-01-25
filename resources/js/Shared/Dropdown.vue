<template>

    <button type="button" class="mt-1">
        <div class="flex items-center cursor-pointer select-none group">
            <div class="text-gray-700 group-hover:text-indigo-600 focus:text-indigo-600 mr-1 whitespace-nowrap">
                <span>John</span>
                <span class="hidden md:inline">Doe</span>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="w-5 h-5 group-hover:fill-indigo-600 fill-gray-700 focus:fill-indigo-600">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
            </svg>
        </div>
    </button>

</template>

<script>

import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
    name: 'Dropdown',

    components: {
        Link,
    },
})

</script>
