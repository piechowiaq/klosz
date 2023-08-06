<template>
    <layout>

        <div>
            <h1 class="mb-8 font-bold text-3xl">
                <Link :href="route('permissions.index')" class="text-indigo-400 hover:text-indigo-600">{{
                        form.name
                    }}
                </Link>
                <span class="text-indigo-400 font-medium"> /</span> Create
            </h1>
            <trashed-message v-if="permission.deleted_at" class="mb-6" @restore="restore(permission)"> This permission has been
                deleted.
            </trashed-message>
            <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                <form @submit.prevent="update">
                    <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                        <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full"
                                    label="Permission Name"/>
                    </div>
                    <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
                        <button v-if="!permission.deleted_at" value="Delete" @click.once="destroy(permission)" tabindex="-1" type="button"
                                class="text-red-600 hover:underline">Delete Permission
                        </button>
                        <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Edit
                            Permission
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
import TrashedMessage from "@/Shared/TrashedMessage.vue";


export default defineComponent({
    name: 'Admin/Permissions/Edit',
    components: {
        LoadingButton,
        Layout,
        Link,
        TextInput,
        TrashedMessage
    },
    props: {
        permission: Object,
    },
    setup({permission}) {
        const form = useForm(useRemember(reactive({
            name: permission.name,
        })))

        return {form}

    },
    methods: {
        update() {
            this.form.put(this.route('permissions.update', this.permission.id))
        },
        destroy(permission) {
            this.$inertia.delete(this.route('permissions.destroy', permission))
        },
        restore(permission) {
            this.$inertia.put(this.route('permissions.restore', permission))
        },
    },
});

</script>



