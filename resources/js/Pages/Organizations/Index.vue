<template>
    <layout title="Users">
        <div  class="md:flex-1 px-4 py-8 md:p-12 md:overflow-y-auto">
            <div>
                <h1 class="mb-8 font-bold text-3xl">Organizations</h1>
            </div>
        </div>

    </layout>
</template>

<script>
import { defineComponent } from 'vue'

import Layout from "../Layout";

export default defineComponent({
    name: 'Organizations/Index',
    components: {
        Layout,

    },

})
</script>
