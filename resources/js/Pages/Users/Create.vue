<template>


    <layout>
    <div class="md:flex-1 px-4 py-8 md:p-12 md:overflow-y-auto">

        <div>
            <h1 class="mb-8 font-bold text-3xl">
                <Link :href="route('users.index')" class="text-indigo-400 hover:text-indigo-600">Users</Link>
                <span class="text-indigo-400 font-medium"> /</span> Create
            </h1>
            <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                <form @submit.prevent="store">
                    <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                        <div class="pr-6 pb-8 w-full lg:w-1/2">
                            <label for="name" class="form-label">First name:</label>
                            <input id="name" type="text" class="form-input w-full flex" v-model="form.name" required autofocus> <!---->
                        </div>
                        <div class="pr-6 pb-8 w-full lg:w-1/2">
                            <label for="surname" class="form-label">Last name:</label>
                            <input id="surname" type="text" class="form-input w-full flex"> <!---->
                        </div>

                        <div class="pr-6 pb-8 w-full lg:w-1/2">
                            <label for="email" class="form-label">Email:</label>
                            <input id="email" type="text" class="form-input w-full flex" v-model="form.email" required> <!---->
                        </div>
                        <div class="pr-6 pb-8 w-full lg:w-1/2">
                            <label for="text-input-187" class="form-label">Phone:</label>
                            <input id="text-input-187" type="text" class="form-input w-full flex"> <!---->
                        </div>
                        <div class="pr-6 pb-8 w-full lg:w-1/2">
                            <label for="role" class="form-label">Assign Role:</label>
                            <select id="role" class="form-select w-full flex" v-model="form.role_id">
                                <option v-for="(role, id) in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                            </select>
                        </div>
                        <div class="pr-6 pb-8 w-full lg:w-1/2">
                            <label for="company" class="form-label">Company:</label>
                            <input id="company" type="text" class="form-input w-full flex"> <!---->
                        </div>
                        <div class="pr-6 pb-8 w-full lg:w-1/2">
                            <label for="password" class="form-label">Password:</label>
                            <input id="password" type="text" class="form-input w-full flex" v-model="form.password"> <!----></div>
                        <div class="pr-6 pb-8 w-full lg:w-1/2">
                            <label for="password_confirmation" class="form-label">Confirm Password:</label>
                            <input id="password_confirmation" type="text" class="form-input w-full flex" v-model="form.password_confirmation" required> <!---->
                        </div>
                    </div>
                    <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
                        <button class="flex items-center btn-indigo" type="submit" :class="{ 'opacity-25': processing }" :disabled="processing">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

























<!--    <app-layout title="Dashboard">-->
<!--        <template #header>-->
<!--            <div class="flex justify-between">-->
<!--                <h2 class="font-semibold text-xl text-gray-800 leading-tight">-->
<!--                    Create New User-->
<!--               </h2>-->
<!--            </div>-->
<!--        </template>-->
<!--        <div class="py-12">-->
<!--            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">-->
<!--                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">-->
<!--                    <div>-->
<!--                        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">-->
<!--                            <form @submit.prevent="store">-->
<!--                                <div>-->
<!--                                    <jet-label for="name" value="Name" />-->
<!--                                    <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />-->
<!--                                </div>-->
<!--                                <div class="mt-4">-->
<!--                                    <jet-label for="email" value="Email" />-->
<!--                                    <jet-input id="email" type="email" autocomplete="on" class="mt-1 block w-full" v-model="form.email" required />-->
<!--                                </div>-->
<!--                                <div class="mt-4">-->
<!--                                    <jet-label for="password" value="Password" />-->
<!--                                    <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />-->
<!--                                </div>-->
<!--                                <div class="mt-4">-->
<!--                                    <jet-label for="password_confirmation" value="Confirm Password" />-->
<!--                                    <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />-->
<!--                                </div>-->
<!--                                <div id="v-model-select" >-->
<!--                                    <h3 class="block font-medium text-sm text-gray-700">Assign role</h3>-->
<!--                                    <select v-model="form.role_id" class="block w-full overflow-hidden mb-2 mt-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm" :size="roles.length">-->
<!--                                        <option v-for="(role, id) in roles" :key="role.id" :value="role.id">-->
<!--                                            {{ role.name }}-->
<!--                                        </option>-->
<!--                                    </select>-->
<!--                                </div>-->
<!--                                <div class="flex items-center justify-end mt-4">-->
<!--                                    <jet-button class="ml-4" :class="{ 'opacity-25': processing }" :disabled="processing">-->
<!--                                        Create-->
<!--                                    </jet-button>-->
<!--                                </div>-->
<!--                            </form>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </app-layout>-->
    </layout>
</template>

<script>
import {defineComponent, reactive, ref} from 'vue'
import Layout from "../Layout";
import JetButton from '@/Jetstream/Button.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetInput from '@/Jetstream/Input.vue'
import { Inertia } from '@inertiajs/inertia'
import { useRemember } from '@inertiajs/inertia-vue3'
import {Link} from "@inertiajs/inertia-vue3";


export default defineComponent({
    name: 'Users/Create',
    components: {
        Link,
        Layout,
        JetButton,
        JetLabel,
        JetInput,
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
            email: null,
            password: null,
            password_confirmation: null,
            role_id: '',
            },))

        function store() {
            Inertia.post(this.route('users.store'), form,{
                onStart: () => { this.processing = true },
                onFinish: () => { this.processing = false }
            })
        }
        return { form , store}
   },
});

</script>



