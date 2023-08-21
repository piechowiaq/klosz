<template>
    <layout>

        <div>
            <h1 class="mb-8 font-bold text-3xl">
                <Link :href="route('companies.index')" class="text-indigo-400 hover:text-indigo-600">Companies</Link>
                <span class="text-indigo-400 font-medium"> /</span> Create
            </h1>
            <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                <form @submit.prevent="store">
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
                                <tr >
                                    <th class="">Name:</th>
                                    <th class="">Duration in months:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="registry in orderedRegistries" :key="registry.id"
                                    class="">
                                    <td class="border-r lg:w-1/2">
                                        <input type="checkbox" v-model="form.registry_ids" :value="registry.id" :id="registry.id" class="mr-6 ">
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
                        <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create Company
                        </loading-button>
                    </div>
                </form>
            </div>
        </div>

    </layout>
</template>

<script>
import {defineComponent, reactive, ref} from 'vue'
import {useRemember, useForm, Link} from '@inertiajs/inertia-vue3'
import Layout from "@/Pages/Layout";
import TextInput from "@/Shared/TextInput";
import LoadingButton from "@/Shared/LoadingButton";
import SelectInput from "@/Shared/SelectInput";
import _ from "lodash";


export default defineComponent({
    name: 'Admin/Companies/Create',
    components: {
        Link,
        Layout,
        TextInput,
        LoadingButton,
        SelectInput

    },


    props: {
        registries: Array
    },
    computed: {
        orderedRegistries: function () {
            return _.orderBy(this.registries, 'name')
        }
    },

    setup() {
        const form = useForm(useRemember(
            reactive({
                name: null,
                city: null,
                email: null,
                phone: null,
                registry_ids: []
            })))

        return {form}
    },
    methods: {
        store() {
            this.form.post(this.route('companies.store'))
        },
        onToRight() {

            let select = this.$refs["form-registry_ids"].value
            if (select !== "") {
                this.form.registry_ids.push({id: select})
                let del = this.registries.indexOf({id: select})
                this.registries.splice(del, 1)


            }

        },
        onToLeft() {
            let select = this.$refs["registries"].value
            if (select !== "") {
                this.registries.push({id: select})
                let del = this.form.registry_ids.indexOf({id: select})
                this.form.registry_ids.splice(del, 1)

            }

        }

    },
});

</script>



