<template>
    <layout>

        <div>
            <h1 class="mb-8 font-bold text-3xl">
                <Link :href="route('companies.index')" class="text-indigo-400 hover:text-indigo-600">Companies</Link>
                <span class="text-indigo-400 font-medium"> /</span> Edit
            </h1>
            <trashed-message v-if="company.deleted_at" class="mb-6" @restore="restore(company)"> This company has been
                deleted.
            </trashed-message>
            <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                <form @submit.prevent="update">
                    <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                        <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2"
                                    label="Company Name"/>
                        <text-input v-model="form.city" :error="form.errors.city" class="pb-8 pr-6 w-full lg:w-1/2"
                                    label="City"/>
                        <text-input v-model="form.email" :error="form.errors.email" class="pb-8 pr-6 w-full lg:w-1/2"
                                    label="Company E-mail"/>
                        <text-input v-model="form.phone" :error="form.errors.phone" class="pb-8 pr-6 w-full lg:w-1/2"
                                    label="Company Phone"/>
                    </div>

                    <div class="p-8">
                        <p>Registries:</p>
                        <table class="table-auto w-full text-sm">
                            <thead class="border-b">
                            <tr>
                                <th class="">Name:</th>
                                <th class="">Duration in moths:</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="registry in orderedRegistries" :key="registry.id"
                                class="">
                                <td class="border-r lg:w-1/2">
                                    <input type="checkbox" v-model="form.registry_ids" :value="registry.id"
                                           :id="registry.id" class="mr-6 ">
                                    <label :for="registry.id">{{ registry.name }}</label>
                                </td>
                                <td class="text-center lg:w-1/2">
                                    <p>{{ registry.valid_for }}</p>
                                </td>
                            </tr>
                            <tr v-if="registries.length === 0">
                                <td class="" colspan="4">No registries found.</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
                        <button v-if="company.id !== 1 || company.id !== 1 && !company.deleted_at" value="Delete"
                                @click.once="destroy(company)" tabindex="-1"
                                type="button" class="text-red-600 hover:underline">Delete Company
                        </button>
                        <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Edit
                            Company
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
    name: 'Companies/Edit',
    components: {
        Layout,
        Link,
        TextInput,
        LoadingButton,
        TrashedMessage
    },
    props: {
        company: Object,
        errors: Object,
        registries: Object,
        registry_ids: Array
    },
    computed: {
        orderedRegistries: function () {
            return _.orderBy(this.registries, 'name')
        }
    },

    setup({company, registry_ids}) {
        const form = useForm(useRemember(
            reactive({
                name: company.name,
                city: company.city,
                email: company.email,
                phone: company.phone,
                registry_ids: registry_ids
            })))

        return {form}

    },
    methods: {
        update() {
            this.form.put(this.route('companies.update', this.company.id))
        },
        destroy(company) {
            this.$inertia.delete(this.route('companies.destroy', company))
        },
        restore(company) {
            this.$inertia.put(this.route('companies.restore', company))
        },
    },

});

</script>



