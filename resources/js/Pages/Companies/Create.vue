<template>
    <layout>

        <div>
            <h1 class="mb-8 font-bold text-3xl">
                <Link :href="route('companies.index')" class="text-indigo-400 hover:text-indigo-600">Companies</Link>
                <span class="text-indigo-400 font-medium"> /</span> Create
            </h1>
            <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                <form @submit.prevent="store">
                    <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                        <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2"
                                    label="Company Name"/>
                        <text-input v-model="form.city" :error="form.errors.city" class="pb-8 pr-6 w-full lg:w-1/2"
                                    label="City"/>
                        <text-input v-model="form.email" :error="form.errors.email" class="pb-8 pr-6 w-full lg:w-1/2"
                                    label="Company E-mail"/>
                        <text-input v-model="form.phone" :error="form.errors.phone" class="pb-8 pr-6 w-full lg:w-1/2"
                                    label="Company Phone"/>
                    </div>
                    <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
                        <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create Company
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
import Layout from "@/Pages/Layout";
import TextInput from "@/Shared/TextInput";
import LoadingButton from "@/Shared/LoadingButton";

export default defineComponent({
    name: 'Companies/Create',
    components: {
        Link,
        Layout,
        TextInput,
        LoadingButton
    },
    props: {
        roles: Array,
    },
    setup() {
        const form = useForm(useRemember(
            reactive({
                name: null,
                city: null,
                email: null,
                phone: null,
            })))

        return {form}
    },
    methods: {
        store() {
            this.form.post(this.route('companies.store'))
        },
    },
});

</script>



