<template>
    <layout title="Permissions">

            <div>
                <h1 class="mb-8 font-bold text-3xl">Permissions</h1>
                <div class="mb-6 flex justify-between items-center">
                    <search v-model="form.search" @reset="reset" class="flex items-center w-full max-w-md mr-4">
                        <label class="block text-gray-700">Trashed:</label>
                        <select v-model="form.trashed" @input="$emit('update:trashed', $event.target.value)" class="form-select text-sm mt-1 w-full">
                            <option :value="null" />
                            <option value="with">With Trashed</option>
                            <option value="only">Only Trashed</option>
                        </select>
                    </search>

                    <Link :href="route('permissions.create')" >
                        Create Permission
                    </Link>
                </div>
                <div class="bg-white rounded-md shadow overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <tr class="text-left font-bold">
                            <th class="px-6 pt-6 pb-4">Name</th>
                        </tr>
                        <tr v-for="permission of permissions.data"  :key="permission.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                            <td class="border-t">
                                <Link value="Edit" :href="route('permissions.edit', permission )" class="px-6 py-4 flex items-center focus:text-indigo-500">{{ permission.name }}</Link>
                            </td>
                            <td class="w-px border-t">
                                <Link class="flex items-center px-4" :href="route('permissions.edit', permission)" tabindex="-1">
                                    <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
                                </Link>
                            </td>
                        </tr>
                        <tr v-if="permissions.length === 0">
                            <td class="px-6 py-4 border-t" colspan="4">No roles found.</td>
                        </tr>
                    </table>
                </div>
                <div class="mt-6">
                    <div class="flex flex-wrap -mb-1">
                        <Pagination :links="permissions.links"></Pagination>
                    </div>
                </div>
            </div>

    </layout>
</template>

<script>
import { defineComponent } from 'vue'
import Layout from "../Layout";
import Icon from "@/Shared/Icon.vue"
import {Link} from "@inertiajs/inertia-vue3"
import Pagination from '@/Shared/Pagination.vue'
import Search from "@/Shared/Search";
import {debounce, mapValues} from "lodash";

export default defineComponent({
    name: 'Permissions/Index',
    components: {
        Layout,
        Link,
        Icon,
        Pagination,
        Search,
    },
    props:{
        permissions: Object,
        filters: Object
    },
    data() {
        return {
            isOpen: false,
            form: {
                search: this.filters.search,
                trashed: this.filters.trashed,
            },
        }
    },
    watch: {
        form: {
            deep: true,
            handler: debounce(function () {
                this.$inertia.get(this.route('permissions.index'), this.form, { preserveState: true , replace: true})
            }, 150),
        },
    },

    methods:{
        destroy(permission) {
            this.$inertia.delete(this.route('permissions.destroy', permission))
        },

        reset() {
            this.form = mapValues(this.form, () => null)
        },
    }
})
</script>
