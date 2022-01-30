<template>

    <layout>
        <div class="md:flex-1 px-4 py-8 md:p-12 md:overflow-y-auto">
            <div>
                <h1 class="mb-8 font-bold text-3xl">
                    <Link :href="route('permissions.index')" class="text-indigo-400 hover:text-indigo-600">Permissions</Link>
                    <span class="text-indigo-400 font-medium"> /</span> Edit
                </h1>
                <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                    <form @submit.prevent="update">
                        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <div class="pr-6 pb-8 w-full">
                                <label for="name" class="form-label">Name:</label>
                                <input id="name" type="text" class="form-input w-full flex" v-model="form.name" required autofocus>
                                <div v-if="errors.name" class="text-indigo-500">{{ errors.name }}</div><!---->
                            </div>
                        </div>
                        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
                            <button value="Delete" @click.once="destroy(permission)" tabindex="-1" type="button" class="text-red-600 hover:underline">Delete Permission</button>
                            <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit" >Edit Permission</loading-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </layout>
</template>

<script>
import {defineComponent, reactive} from 'vue'
import { useRemember } from '@inertiajs/inertia-vue3'
import { useForm } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import Layout from "../Layout";
import {Link} from "@inertiajs/inertia-vue3";
import LoadingButton from "../../Shared/LoadingButton";


export default defineComponent({
    name: 'Permissions/Edit',
    components: {
        LoadingButton,
        Layout,
        Link
    },
    props:{
        permission: Object,
        errors: Object
    },
    setup({ permission }) {
        const form = useForm(useRemember(reactive({
            name: permission.name,
        })))

        return { form }

    },
    methods:{
        update() {
            this.form.put(this.route('permissions.update', this.permission.id))
        },
        destroy(permission) {
            this.$inertia.delete(this.route('permissions.destroy', permission))
        },
    },
});

</script>



