<template>
    <layout>

            <div>
                <h1 class="mb-8 font-bold text-3xl">
                    <Link :href="route('companies.index')" class="text-indigo-400 hover:text-indigo-600">Companies</Link>
                    <span class="text-indigo-400 font-medium"> /</span> Edit
                </h1>
                <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                    <form @submit.prevent="update">
                        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Company Name" />
                            <text-input v-model="form.city" :error="form.errors.city" class="pb-8 pr-6 w-full lg:w-1/2" label="City" />
                            <text-input v-model="form.email" :error="form.errors.email" class="pb-8 pr-6 w-full lg:w-1/2" label="Company E-mail" />
                            <text-input v-model="form.phone" :error="form.errors.phone" class="pb-8 pr-6 w-full lg:w-1/2" label="Company Phone" />
                        </div>
                        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
                            <button value="Delete" @click.once="destroy(company)" tabindex="-1" type="button" class="text-red-600 hover:underline">Delete Company</button>
                            <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Edit Company</loading-button>
                        </div>

                    </form>
                </div>
            </div>

    </layout>
</template>

<script>
import {defineComponent, reactive} from 'vue'
import Layout from "../Layout";
import { useRemember, useForm } from '@inertiajs/inertia-vue3'
import {Link} from "@inertiajs/inertia-vue3";
import TextInput from "../../Shared/TextInput";
import LoadingButton from "../../Shared/LoadingButton";

export default defineComponent({
    name: 'Companies/Edit',
    components: {
        Layout,
        Link,
        TextInput,
        LoadingButton
    },
    props:{
        company: Object,
        errors: Object
    },

    setup({ company }) {
        const form = useForm(useRemember(
            reactive({
            name: company.name,
            city: company.city,
            email: company.email,
            phone: company.phone,

        })))

        return { form }

    },
    methods:{
        update() {
            this.form.put(this.route('companies.update', this.company.id))
        },
        destroy(company) {
            this.$inertia.delete(this.route('companies.destroy', company))
        },
    },

});

</script>



