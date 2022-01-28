<template>
    <layout>
        <div class="md:flex-1 px-4 py-8 md:p-12 md:overflow-y-auto">
            <div>
                <h1 class="mb-8 font-bold text-3xl">
                    <Link :href="route('users.index')" class="text-indigo-400 hover:text-indigo-600">Users</Link>
                    <span class="text-indigo-400 font-medium"> /</span> Create
                </h1>
                <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                    <form @submit.prevent="update">
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
                                <input id="email" type="email" class="form-input w-full flex" v-model="form.email" required> <!---->
                            </div>
                            <div class="pr-6 pb-8 w-full lg:w-1/2">
                                <label for="phone" class="form-label">Phone:</label>
                                <input id="phone" type="number" class="form-input w-full flex" v-model="form.phone"> <!---->
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
                                <input id="password" type="password" class="form-input w-full flex" v-model="form.password"> <!----></div>
                            <div class="pr-6 pb-8 w-full lg:w-1/2">
                                <label for="password_confirmation" class="form-label">Confirm Password:</label>
                                <input id="password_confirmation" type="password" class="form-input w-full flex" v-model="form.password_confirmation" required> <!---->
                            </div>
                        </div>
                        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
                            <button value="Delete" @click.once="destroy(user)" tabindex="-1" type="button" class="text-red-600 hover:underline">Delete Contact</button>
                            <button class="flex items-center btn-indigo ml-auto" type="submit" :class="{ 'opacity-25': processing }" :disabled="processing">Edit User</button>
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
import JetButton from '@/Jetstream/Button.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetInput from '@/Jetstream/Input.vue'
import { Inertia } from '@inertiajs/inertia'
import { useRemember } from '@inertiajs/inertia-vue3'
import {Link} from "@inertiajs/inertia-vue3";

export default defineComponent({
    name: 'Users/Edit',
    components: {
        Layout,
        JetButton,
        JetLabel,
        JetInput,
        Link,
    },
    props:{
        roles: Array,
        user: Object,
        role_id: Number,
        errors: Object
    },

    setup({ user, role_id}) {
        const form = useRemember(reactive({
            name: user.name,
            email: user.email,
            phone: user.phone,
            password: user.password,
            role_id: role_id,
        }))

        function update() {
            Inertia.put(this.route('users.update', this.user.id), form)
        }

        return { form, update }

    },
    methods:{
        destroy(user) {
            this.$inertia.delete(this.route('users.destroy', user))
        },
    },

});

</script>



