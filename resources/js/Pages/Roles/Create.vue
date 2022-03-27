<template>

    <layout>

            <div>
                <h1 class="mb-8 font-bold text-3xl">
                    <Link :href="route('roles.index')" class="text-indigo-400 hover:text-indigo-600">Roles</Link>
                    <span class="text-indigo-400 font-medium"> /</span> Create
                </h1>
                <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                    <form @submit.prevent="store">
                        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Name a role" />
                            <select-input v-model="form.permission_ids" multiple :error="form.errors.permission_ids" class="pb-8 pr-6 w-full lg:w-1/2" label="Permissions">
                                <option v-for="(permission, id) in permissions" :key="permission.id" :value="permission.id" >{{ permission.name }}</option>
                            </select-input>
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


import {defineComponent, reactive} from 'vue'
import Layout from "../Layout";
import { useRemember, useForm  } from '@inertiajs/inertia-vue3'
import {Link} from "@inertiajs/inertia-vue3";
import TextInput from "../../Shared/TextInput";
import LoadingButton from "../../Shared/LoadingButton";
import SelectInput from "../../Shared/SelectInput";

export default defineComponent({
    name: 'Roles/Create',
    components: {
        Layout,
        LoadingButton,
        TextInput,
        Link,
        SelectInput
    },
    props:{
        permissions: Array,
        errors: Object
    },
    setup () {
        const form = useForm(useRemember(
            reactive({
            name: null,
            permission_ids: [],
            },)))

        return { form }
   },
    methods:{
       store() {
           this.form.post(this.route('roles.store'))
       }
    }
});

</script>



