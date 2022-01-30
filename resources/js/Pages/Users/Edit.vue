<template>
    <layout>
        <div class="md:flex-1 px-4 py-8 md:p-12 md:overflow-y-auto">
            <div>
                <h1 class="mb-8 font-bold text-3xl">
                    <Link :href="route('users.index')" class="text-indigo-400 hover:text-indigo-600">Users</Link>
                    <span class="text-indigo-400 font-medium"> /</span> Create
                </h1>
                <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                    <form @submit.prevent="update">
                        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="First Name" />
                            <text-input v-model="form.last_name" :error="form.errors.last_name" class="pr-6 pb-8 w-full lg:w-1/2" label="Last Name" />
                            <text-input v-model="form.email" :error="form.errors.email" class="pr-6 pb-8 w-full lg:w-1/2" label="Email" />
                            <text-input v-model="form.phone" :error="form.errors.phone" class="pr-6 pb-8 w-full lg:w-1/2" label="Phone" />

                            <div class="pr-6 pb-8 w-full lg:w-1/2">
                                <label for="role" class="form-label">Assign Role:</label>
                                <select id="role" class="form-select w-full flex" v-model="form.role_id">
                                    <option v-for="(role, id) in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                                </select>
                                <div v-if="form.errors.role_id" class="text-indigo-500">{{ form.errors.role_id }}</div>
                            </div>
                            <div class="pr-6 pb-8 w-full lg:w-1/2">
                                <label for="company" class="form-label">Assign Company:</label>
                                <select id="company" v-model="form.company_ids" multiple class="form-select w-full flex">
                                    <option v-for="(company, id) in companies" :key="company.id" :value="company.id">{{ company.name }}</option>
                                </select>
                                <div v-if="form.errors.company_ids" class="text-indigo-500">{{ form.errors.company_ids }}</div>
                            </div>
                            <text-input v-model="form.password" :error="form.errors.password" class="pr-6 pb-8 w-full lg:w-1/2" label="Password" />
                            <text-input v-model="form.password_confirmation" :error="form.errors.password_confirmation" class="pr-6 pb-8 w-full lg:w-1/2" label="Password Confirmation" />
                        </div>
                        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
                            <button value="Delete" @click.once="destroy(user)" tabindex="-1" type="button" class="text-red-600 hover:underline">Delete Contact</button>
                            <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit" >Edit User</loading-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </layout>
</template>

<script>
import {defineComponent, reactive} from 'vue'
import Layout from "../Layout";
import { useRemember, useForm } from '@inertiajs/inertia-vue3'
import {Link} from "@inertiajs/inertia-vue3";
import LoadingButton from "../../Shared/LoadingButton";
import TextInput from "../../Shared/TextInput";

export default defineComponent({
    name: 'Users/Edit',
    components: {
        Layout,
        Link,
        LoadingButton,
        TextInput
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
        const form = useForm(useRemember(reactive({
            name: user.name,
            last_name: user.last_name,
            email: user.email,
            phone: user.phone,
            password: user.password,
            role_id: role_id,
            company_ids: company_ids,
        })))


        return { form }

    },
    methods:{
        update() {
            this.form.put(this.route('users.update', this.user.id))
        },
        destroy(user) {
            this.$inertia.delete(this.route('users.destroy', user))
        },
    },

});

</script>



