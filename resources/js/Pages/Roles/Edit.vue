<template>
    <layout>
        <div class="md:flex-1 px-4 py-8 md:p-12 md:overflow-y-auto">
            <div>
                <h1 class="mb-8 font-bold text-3xl">
                    <Link :href="route('roles.index')" class="text-indigo-400 hover:text-indigo-600">{{ form.name }}</Link>
                    <span class="text-indigo-400 font-medium"> /</span> Create
                </h1>
                <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                    <form @submit.prevent="store">
                        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Name a role" />
                            <select-input v-model="form.permission_ids" multiple :error="form.errors.permission_ids" class="pb-8 pr-6 w-full lg:w-1/2" label="Companies">
                                <option v-for="(permission, id) in permissions" :key="permission.id" :value="permission.id" >{{ permission.name }}</option>
                            </select-input>
                        </div>
                        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
                            <button value="Delete" @click.once="destroy(role)" tabindex="-1" type="button" class="text-red-600 hover:underline">Delete Contact</button>
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
import { useRemember, useForm } from '@inertiajs/inertia-vue3'
import {Link} from "@inertiajs/inertia-vue3";
import LoadingButton from "../../Shared/LoadingButton";
import Layout from "../Layout";
import TextInput from "../../Shared/TextInput";
import SelectInput from "../../Shared/SelectInput";

export default defineComponent({
    name: 'Roles/Edit',
    components: {
        Layout,
        Link,
        LoadingButton,
        TextInput,
        SelectInput
    },
    props:{
        role: Object,
        permissions: Object,
        permission_ids: Array,
        errors: Object
    },

        setup({ role, permission_ids }) {
            const form = useForm(useRemember(reactive({
                name: role.name,
                permission_ids: permission_ids
            })))

            return { form}

        },
    methods:{
        update() {
            this.form.put(this.route('roles.update', this.role.id))
        },
        destroy(role) {
            this.$inertia.delete(this.route('roles.destroy', role))
        },
    },
});

</script>



