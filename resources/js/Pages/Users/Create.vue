<template>
    <app-layout title="Dashboard">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Create New User
               </h2>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div>
                        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                            <form @submit.prevent="store">
                                <div>
                                    <jet-label for="name" value="Name" />
                                    <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                                </div>
                                <div class="mt-4">
                                    <jet-label for="email" value="Email" />
                                    <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
                                </div>
                                <div class="mt-4">
                                    <jet-label for="password" value="Password" />
                                    <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
                                </div>
                                <div class="mt-4">
                                    <jet-label for="password_confirmation" value="Confirm Password" />
                                    <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
                                </div>
                                <div id="v-model-select" >
                                    <h3 class="block font-medium text-sm text-gray-700">Assign role</h3>
                                    <select v-model="form.role_id" class="block w-full overflow-hidden mb-2 mt-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm" :size="roles.length">
                                        <option v-for="(role, id) in roles" :key="role.id" :value="role.id">
                                            {{ role.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <jet-button class="ml-4" :class="{ 'opacity-25': processing }" :disabled="processing">
                                        Create
                                    </jet-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import {defineComponent, reactive, ref} from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetInput from '@/Jetstream/Input.vue'
import { Inertia } from '@inertiajs/inertia'
import { useRemember } from '@inertiajs/inertia-vue3'


export default defineComponent({
    name: 'Users/Create',
    components: {
        AppLayout,
        JetButton,
        JetLabel,
        JetInput,
    },
    props:{
        roles: Array,
        errors: Object
    },
    data(){
        let processing = ref(false);
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
                onStart: () => { processing.value = true },
                onFinish: () => { processing.value = false }
            })
        }

        return { form , store}
   },

});

</script>



