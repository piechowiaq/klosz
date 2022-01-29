<template>
    <layout>
        <div class="md:flex-1 px-4 py-8 md:p-12 md:overflow-y-auto">
            <div>
                <h1 class="mb-8 font-bold text-3xl">
                    <Link :href="route('companies.index')" class="text-indigo-400 hover:text-indigo-600">Companies</Link>
                    <span class="text-indigo-400 font-medium"> /</span> Create
                </h1>
                <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                    <form @submit.prevent="update">
                        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <div class="pr-6 pb-8 w-full lg:w-1/2">
                                <label for="name" class="form-label">Name:</label>
                                <input id="name" type="text" class="form-input w-full flex" v-model="form.name" required autofocus>
                                <div v-if="errors.name" class="text-indigo-500">{{ errors.name }}</div><!---->
                            </div>
                            <div class="pr-6 pb-8 w-full lg:w-1/2">
                                <label for="last_name" class="form-label" >City:</label>
                                <input id="last_name" type="text" class="form-input w-full flex" v-model="form.city"> <!---->
                                <div v-if="errors.last_name" class="text-indigo-500">{{ errors.last_name }}</div><!---->
                            </div>

                            <div class="pr-6 pb-8 w-full lg:w-1/2">
                                <label for="email" class="form-label">Email:</label>
                                <input id="email" type="email" class="form-input w-full flex" v-model="form.email" required>
                                <div v-if="errors.email" class="text-indigo-500">{{ errors.email }}</div> <!---->
                            </div>
                            <div class="pr-6 pb-8 w-full lg:w-1/2">
                                <label for="phone" class="form-label">Phone:</label>
                                <input id="phone" type="tel" class="form-input w-full flex" v-model="form.phone">
                                <div v-if="errors.phone" class="text-indigo-500">{{ errors.phone }}</div><!---->
                            </div>

                        </div>
                        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
                            <button value="Delete" @click.once="destroy(company)" tabindex="-1" type="button" class="text-red-600 hover:underline">Delete Company</button>
                            <button class="flex items-center btn-indigo ml-auto" type="submit" :class="{ 'opacity-25': processing }" :disabled="processing">Edit Company</button>
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
import { Inertia } from '@inertiajs/inertia'
import { useRemember } from '@inertiajs/inertia-vue3'
import {Link} from "@inertiajs/inertia-vue3";

export default defineComponent({
    name: 'Users/Edit',
    components: {
        Layout,
        Link,
    },
    props:{
        company: Object,
        errors: Object
    },

    setup({ company }) {
        const form = useRemember(reactive({
            name: company.name,
            city: company.city,
            email: company.email,
            phone: company.phone,

        }))

        function update() {
            Inertia.put(this.route('companies.update', this.company.id), form)
        }

        return { form, update }

    },
    methods:{
        destroy(company) {
            this.$inertia.delete(this.route('companies.destroy', company))
        },
    },

});

</script>



