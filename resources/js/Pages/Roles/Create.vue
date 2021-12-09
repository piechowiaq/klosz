<template>
    <app-layout title="Dashboard">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Create New Role
               </h2>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div>




                        <form class="max-w-md mx-auto mt-8">
                            <div class="mb-6">
                                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="name"> Name </label>

                                <input v-model="" class="border border-gray-400 p-2 w-full" type="text" name="name" id="name" required />
                                <div v-if="" v-text="" class="text-red-500 text-xs mt-1"></div>
                            </div>

                            <div class="mb-6">
                                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="email"> Email </label>

                                <input v-model="" class="border border-gray-400 p-2 w-full" type="email" name="email" id="email" required />

                                <div v-if="" v-text="" class="text-red-500 text-xs mt-1"></div>
                            </div>



                            <div class="mb-6">
                                <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500" >Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'

export default defineComponent({
    components: {
        AppLayout,
    },
});

</script>
