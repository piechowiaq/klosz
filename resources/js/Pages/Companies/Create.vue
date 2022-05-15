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
                    <div class="p-8 -mr-6 -mb-8 flex-wrap flex justify-between">
                        <select  multiple v-model="registries" :error="" label="Registries"
                                      class="pb-8 pr-6 basis-5/12" >

                            <option v-for="(registry, id) in registries" :key="registry.id" :value="registry">
                                {{ registry.name }}
                            </option>
                        </select>

                        <div class="pb-8 pr-6 basis-2/12 grid grid-cols-1 gap-1 place-content-center">
                            <button class="display: block w-full">&raquo;</button>
                            <button type="button" class="display: block w-full" @click="onToRight" >&rsaquo;</button>
                            <button type="button" class="display: block w-full" @click="onToLeft">&lsaquo;</button>
                            <button class="display: block w-full">&laquo;</button>
                        </div>

                        <select multiple v-model="form.registry_ids" :error="" label="Registries Active"
                                      class="pb-8 pr-6  basis-5/12" >
                            <option v-for="(registry, id) in form.registry_ids" :key="registry.id" :value="registry.id">
                                {{ registry.name }}
                            </option>
                        </select>
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
import {defineComponent, reactive} from 'vue'
import {useRemember, useForm, Link} from '@inertiajs/inertia-vue3'
import Layout from "@/Pages/Layout";
import TextInput from "@/Shared/TextInput";
import LoadingButton from "@/Shared/LoadingButton";
import SelectInput from "@/Shared/SelectInput";


export default defineComponent({
    name: 'Companies/Create',
    components: {
        Link,
        Layout,
        TextInput,
        LoadingButton,
        SelectInput

    },
    props: {
        registries: Array,
    },

    setup() {
        const form = useForm(useRemember(
            reactive({
                name: null,
                city: null,
                email: null,
                phone: null,
                registry_ids: null,
            })))

        return {form}
    },
    methods: {
        store() {
            this.form.post(this.route('companies.store'))
        },
        onToRight() {
            let select = this.registries
            if(select !== ""){
                this.form.registries.push(select)
                let del = this.registries.indexOf(select)
                this.registries.splice(del, 1)

            }

        },
        onToLeft() {
            let select = this.form.registries
            if(select !== ""){
                this.registries.push(select)
                let del = this.form.registries.indexOf(select)
                this.form.registries.splice(del, 1)

            }

        }

    },
});

</script>



