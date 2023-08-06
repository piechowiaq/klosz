<template>
    <layout>

        <div>
            <h1 class="mb-8 font-bold text-3xl">
                <Link :href="route('registries.index')" class="text-indigo-400 hover:text-indigo-600">Registries</Link>
                <span class="text-indigo-400 font-medium"> /</span> Create
            </h1>
            <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                <form @submit.prevent="store">
                    <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                        <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2"
                                    label="Registry Name"/>
                        <text-input v-model="form.valid_for" :error="form.errors.valid_for" class="pb-8 pr-6 w-full lg:w-1/2"
                                    label="Valid for | months"/>
                        <text-area v-model="form.description" :error="form.errors.description" class="pb-8 pr-6 w-full "
                                    label="Description"/>
                    </div>
                    <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
                        <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create Registry
                        </loading-button>
                    </div>
                </form>
            </div>
        </div>

    </layout>
</template>

<script>
import {defineComponent, reactive} from 'vue'
import {useRemember, useForm, Link} from '@inertiajs/inertia-vue3'
import Layout from "@/Pages/Layout.vue";
import TextInput from "@/Shared/TextInput.vue";
import LoadingButton from "@/Shared/LoadingButton.vue";
import TextArea from "@/Shared/TextArea.vue";

export default defineComponent({
    name: 'Admin/Registries/Create',
    components: {
        Link,
        Layout,
        TextInput,
        LoadingButton,
        TextArea
    },

    setup() {
        const form = useForm(useRemember(
            reactive({
                name: null,
                description: null,
                valid_for: null,
            })))

        return {form}
    },
    methods: {
        store() {
            this.form.post(this.route('registries.store'))
        },
    },
});

</script>



