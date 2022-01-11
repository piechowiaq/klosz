<template>
    <app-layout title="Dashboard">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Create New Permission
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div>
                        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                            <form @submit.prevent="form.post('/permissions')" class="max-w-md mx-auto">
                                <div>
                                    <jet-label for="name" value="Name a permission" />
                                    <jet-input id="name" type="text" class="mt-1 block w-full"  required autofocus autocomplete="name" v-model="form.name" />
                                </div>
                                <div v-if="errors.name" class="mb-2 text-orange-500">{{ errors.name }}</div>
                                <jet-button type="submit" value="Create">Create
                                </jet-button>
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
import { useForm } from '@inertiajs/inertia-vue3'

export default defineComponent({
    name: 'Permissions/Create',
    components: {
        AppLayout,
        JetButton,
        JetLabel,
        JetInput,
    },
    props:{
        errors: Object
    },
    setup () {
        const form = useForm({
            name: null,
        })
        return { form }
    },
});

</script>



