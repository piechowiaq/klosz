<template>
    <layout>

            <div>
                <h1 class="mb-8 font-bold text-3xl">
                    <Link :href="route('roles.index')" class="text-indigo-400 hover:text-indigo-600">{{ form.name }}</Link>
                    <span class="text-indigo-400 font-medium"> /</span> Edit
                </h1>
                <trashed-message v-if="role.deleted_at" class="mb-6" @restore="restore(role)"> This role has been deleted. </trashed-message>
                <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                    <form @submit.prevent="update">
                        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Name a role" />
                            <select-input v-model="form.permission_ids" multiple :error="form.errors.permission_ids" class="pb-8 pr-6 w-full lg:w-1/2" label="Permissions">
                                <option v-for="(permission, id) in permissions" :key="permission.id" :value="permission.id" >{{ permission.name }}</option>
                            </select-input>
                        </div>


                        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
                            <button v-if=" role.name !== 'Super Admin' || role.name !== 'Super Admin' && !role.deleted_at" value="Delete" @click.once="destroy(role)" tabindex="-1" type="button" class="text-red-600 hover:underline">Delete Contact</button>
                            <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit" >Edit User</loading-button>
                        </div>
                    </form>
                </div>
            </div>

    </layout>

</template>

<script>
import {defineComponent, reactive} from 'vue'
import { useRemember, useForm } from '@inertiajs/inertia-vue3'
import {Link} from "@inertiajs/inertia-vue3";
import LoadingButton from "../../../Shared/LoadingButton.vue";
import Layout from "../../Layout.vue";
import TextInput from "../../../Shared/TextInput.vue";
import SelectInput from "../../../Shared/SelectInput.vue";
import TrashedMessage from "../../../Shared/TrashedMessage.vue";

export default defineComponent({
    name: 'Admin/Roles/Edit',
    components: {
        Layout,
        Link,
        LoadingButton,
        TextInput,
        SelectInput,
        TrashedMessage
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

        return {form}
    },
    methods:{
        update() {
            this.form.put(this.route('roles.update', this.role.id))
        },
        destroy(role) {
            this.$inertia.delete(this.route('roles.destroy', role))
        },
        restore(role) {
            this.$inertia.put(this.route('roles.restore', role))
        },
    },
});

</script>



