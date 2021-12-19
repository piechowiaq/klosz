<template>
    <app-layout title="Dashboard">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Update Role
                </h2>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div>
                        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                            <form @submit.prevent="update" class="max-w-md mx-auto">
                                <div>
                                    <jet-label for="name" value="Name a role" />
                                    <jet-input id="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" v-model="form.name" />
                                </div>

                                <div id="v-model-multiple-checkboxes" >
                                    <h3 class="block font-medium text-sm text-gray-700">Assign permissions</h3>
                                    <ul>
                                        <li v-for="(permission, id) in permissions" :key="permission.id">
                                            <jet-input type="checkbox"  :id="permission.id" />
                                            <jet-label class="ml-2 inline" :for="permission.id">{{permission.name}}</jet-label>
                                        </li>
                                    </ul>
                                </div>
                                <jet-button type="submit" value="Create" :disabled="form.processing">Create</jet-button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </app-layout>
</template>

<script>
import {defineComponent, reactive} from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetInput from '@/Jetstream/Input.vue'


export default defineComponent({
    name: 'Roles/Edit',
    components: {
        AppLayout,
        JetButton,
        JetLabel,
        JetInput,
    },
    props:{
        role: Object,
        permissions: Array,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.role.name,
                permissions: this.permissions
            }),
        }
    },
    methods: {
        update() {
            this.form.put(this.route('roles.destroy', this.role))
        },
    },


});

</script>



