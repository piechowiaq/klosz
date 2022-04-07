<template>
    <layout>
            <div>

                <h1 class="mb-8 font-bold text-3xl">
                    <Link :href="route('users.index')" class="text-sky-800 hover:text-indigo-600">Users</Link>
                    <span class="text-sky-800 font-medium"> /</span>   {{ form.name }} {{ form.last_name }}
                </h1>
                <trashed-message v-if="user.deleted_at" class="mb-6" @restore="restore(user)"> This user has been deleted. </trashed-message>
                <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                    <form @submit.prevent="update">
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
                        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
                            <button v-if="!user.deleted_at" value="Delete" @click.once="destroy(user)" tabindex="-1" type="button" class="text-red-600 hover:underline">Delete Contact</button>
                            <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit" >Edit User</loading-button>
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
import {Head, Link} from "@inertiajs/inertia-vue3";
import LoadingButton from "../../Shared/LoadingButton";
import TextInput from "../../Shared/TextInput";
import SelectInput from "../../Shared/SelectInput";
import TrashedMessage from "../../Shared/TrashedMessage";

export default defineComponent({
    name: 'Users/Edit',
    components: {
        Layout,
        Link,
        Head,
        LoadingButton,
        TextInput,
        SelectInput,
        TrashedMessage
    },
    props:{
        roles: Array,
        user: Object,
        role_id: Number,
        errors: Object,
        companies: Array,
        company_ids: Array
    },

    setup({ user, role_id, company_ids}) {
        const form = useForm(useRemember(
            reactive({
            name: user.name,
            last_name: user.last_name,
            email: user.email,
            phone: user.phone,
            password: user.password,
            password_confirmation: user.password,
            role_id: role_id,
            company_ids: company_ids,
        },)))

        return { form }
    },
    methods:{
        update() {
            this.form.put(this.route('users.update', this.user.id))
        },
        destroy(user) {
            this.$inertia.delete(this.route('users.destroy', user))
        },
        restore(user) {
            this.$inertia.put(this.route('users.restore', user))
        },
    },

});

</script>



