<template>
    <layout>

            <div>
                <h1 class="mb-8 font-bold text-3xl">
                    <Link :href="route('users.index')" class="text-indigo-400 hover:text-indigo-600">Users</Link>
                    <span class="text-indigo-400 font-medium"> /</span> Create
                </h1>
                <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                    <form @submit.prevent="store">
                        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="First Name" />
                            <text-input v-model="form.last_name" :error="form.errors.last_name" class="pr-6 pb-8 w-full lg:w-1/2" label="Last Name" />
                            <text-input v-model="form.email" :error="form.errors.email" class="pr-6 pb-8 w-full lg:w-1/2" label="Email" />
                            <text-input v-model="form.phone" :error="form.errors.phone" class="pr-6 pb-8 w-full lg:w-1/2" label="Phone" />
                            <select-input v-model="form.role_id" :error="form.errors.role_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Role">
                                <option :value="null" />
                                <option v-for="(role, id) in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                            </select-input>
                            <select-input v-model="form.company_ids" multiple :error="form.errors.company_ids" class="pb-8 pr-6 w-full lg:w-1/2" label="Companies">
                                <option v-for="(company, id) in companies" :key="company.id" :value="company.id" >{{ company.name }}</option>
                            </select-input>
                            <text-input v-model="form.password" :error="form.errors.password" class="pr-6 pb-8 w-full lg:w-1/2" label="Password" />
                            <text-input v-model="form.password_confirmation" :error="form.errors.password_confirmation" class="pr-6 pb-8 w-full lg:w-1/2" label="Password Confirmation" />
                        </div>
                        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                            <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create User</loading-button>
                        </div>
                    </form>
                </div>
            </div>

    </layout>
</template>

<script>
import {defineComponent, reactive } from 'vue'
import Layout from "../../Layout";
import { useRemember, useForm } from '@inertiajs/inertia-vue3'
import {Link} from "@inertiajs/inertia-vue3";
import TextInput from "../../../Shared/TextInput";
import SelectInput from "../../../Shared/SelectInput";
import LoadingButton from "../../../Shared/LoadingButton";

export default defineComponent({
    name: 'Admin/Users/Create',
    components: {
        Link,
        Layout,
        LoadingButton,
        SelectInput,
        TextInput
    },
    props:{
        roles: Array,
        errors: Object,
        companies: Array,
    },

    setup () {
        const form = useForm(useRemember(
            reactive({
            name: null,
            last_name: null,
            email: null,
            phone: null,
            password: null,
            password_confirmation: null,
            role_id: '',
            company_ids: [],
            },)))

            return { form }
   },
    methods:{
        store() {
            this.form.post(this.route('users.store'))
        },
    },
});

</script>



