<template>
    <div>
        <Component
            :is="link.url ? 'Link' : 'span'"
            v-for="link in links"
            :href="link.url"
            v-html="link.label"
            class="px-1"
            :class="{ 'text-gray-200': ! link.url, 'font-bold' : link.active }"
        ></Component>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import {Link} from "@inertiajs/inertia-vue3";

export default defineComponent ({
    components: {
        Link,
    },
    props: {
        links: Array
    }
});
</script>
