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
                        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                            <form @submit.prevent="update" class="max-w-md mx-auto">
                                <div>
                                    <jet-label for="name" value="Name a role" />
                                    <jet-input id="name" type="text" class="mt-1 block w-full"  autofocus autocomplete="name" v-model="form.name" />
                                </div>
                                <div v-if="errors.name" class="mb-2 text-orange-500">{{ errors.name }}</div>
                                <div id="v-model-multiple-select" >
                                    <h3 class="block font-medium text-sm text-gray-700">Assign permissions</h3>
                                    <select v-model="form.permission_ids" multiple class="block w-full overflow-hidden mb-2 mt-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm" :size="permissions.length" >
                                        <option v-for="(permission, id) in permissions" :key="permission.id" :value="permission.id">
                                            {{ permission.name }}
                                        </option>
                                    </select>
                                </div>
                                <div v-if="errors.permission_ids" class="mb-2 text-orange-500">{{ errors.permission_ids }}</div>
                                <jet-button type="submit" value="Update" :disabled="form.processing">Update</jet-button>
                            </form>
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
import { useRemember } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'


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
        permissions: Object,
        permission_ids: Array,
        errors: Object
    },

        setup({ role, permission_ids }) {
            const form = useRemember(reactive({
                name: role.name,
                permission_ids: permission_ids
            }))
            function update() {
                Inertia.put(this.route('roles.update', this.role.id), form)
            }

            return { form, update }

        },
});

</script>



