<template>
    <layout>

        <div>
            <h1 class="mb-8 font-bold text-3xl">
                <Link :href="route('registries.index')" class="text-indigo-400 hover:text-indigo-600">Companies</Link>
                <span class="text-indigo-400 font-medium"> /</span> Edit
            </h1>
            <trashed-message v-if="registry.deleted_at" class="mb-6" @restore="restore(registry)"> This registry has been
                deleted.
            </trashed-message>
            <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                <form @submit.prevent="update">
                    <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                        <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2"
                                    label="Company Name"/>
                        <text-input v-model="form.description" :error="form.errors.description" class="pb-8 pr-6 w-full lg:w-1/2"
                                    label="Description"/>
                        <text-input v-model="form.valid_for" :error="form.errors.valid_for" class="pb-8 pr-6 w-full lg:w-1/2"
                                    label="Valid for | months"/>
                    </div>
                    <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
                        <button v-if="!registry.deleted_at" value="Delete" @click.once="destroy(registry)" tabindex="-1"
                                type="button" class="text-red-600 hover:underline">Delete Registry
                        </button>
                        <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Edit
                            Registry
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
import TrashedMessage from "@/Shared/TrashedMessage";

export default defineComponent({
    name: 'Admin/Registries/Edit',
    components: {
        Layout,
        Link,
        TextInput,
        LoadingButton,
        TrashedMessage
    },
    props: {
        registry: Object,
        errors: Object
    },

    setup({registry}) {
        const form = useForm(useRemember(
            reactive({
                name: registry.name,
                description: registry.description,
                valid_for: registry.valid_for,
            })))

        return {form}

    },
    methods: {
        update() {
            this.form.put(this.route('registries.update', this.registry.id))
        },
        destroy(registry) {
            this.$inertia.delete(this.route('registries.destroy', registry))
        },
        restore(registry) {
            this.$inertia.put(this.route('registries.restore', registry))
        },
    },

});

</script>



