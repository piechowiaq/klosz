<template>
    <layout>
        <div class="md:flex-1 px-4 py-8 md:p-12 md:overflow-y-auto">
            <div>
                <h1 class="mb-8 font-bold text-3xl">
                    <Link :href="route('companies.index')" class="text-indigo-400 hover:text-indigo-600">Companies</Link>
                    <span class="text-indigo-400 font-medium"> /</span> Create
                </h1>
                <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                    <form @submit.prevent="store">
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
                        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
                            <button class="flex items-center btn-indigo" type="submit" :class="{ 'opacity-25': processing }" :disabled="processing">Create Company</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </layout>
</template>

<script>
import {defineComponent, reactive, ref} from 'vue'
import Layout from "../Layout";
import { Inertia } from '@inertiajs/inertia'
import { useRemember } from '@inertiajs/inertia-vue3'
import {Link} from "@inertiajs/inertia-vue3";


export default defineComponent({
    name: 'Companies/Create',
    components: {
        Link,
        Layout,
    },
    props:{
        roles: Array,
        errors: Object
    },
    data(){
        return {processing: false};
    },
    setup () {
        const form = useRemember(
            reactive({
            name: null,
            city: null,
            email: null,
            phone: null,

            },))

        function store() {
            Inertia.post(this.route('companies.store'), form,{
                onStart: () => { this.processing = true },
                onFinish: () => { this.processing = false }
            })
        }
        return { form , store}
   },
});

</script>



