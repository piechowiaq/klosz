<template>
    <layout :company="company">
        <div class="md:flex md:flex-grow md:overflow-hidden">
            <user-navigation :company="company" :companies="companies"/>
            <div class="px-4 py-8 md:flex-1 md:p-12 md:overflow-y-auto">
                <h1 class="mb-8 text-3xl font-bold">Dashboard</h1>
                <div class="bg-white overflow-hidden flex justify-between ">
                    <div class="w-1/2 rounded-md border shadow mr-2">
                        <div class="flex">
                            <div class="p-8 flex  w-1/2">
                                <DoughnutChart :chart-data="chartDataRegistries" class="w-full"/>
                            </div>
                            <div class="p-8 flex  w-1/2">
                                <div class="w-full h-full bg-gray-100 flex items-center grid justify-items-center">
                                    <p class="text-5xl font-bold">{{ this.percentage() }} %</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center  px-8 py-4 bg-gray-50 border-t border-gray-100">
                            <div class="">Status Rejestrów</div>
                        </div>
                    </div>
                    <div class="w-1/2 rounded-md border shadow ml-2">
                        <div class="flex">
                            <div class="p-8 flex  w-1/2">
                                <DoughnutChart :chart-data="chartData" class="w-full"/>
                            </div>
                            <div class="p-8 flex  w-1/2">
                                <div class="w-full h-full bg-gray-50 flex items-center grid justify-items-center">
                                    <p class="text-5xl font-bold">100 %</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center   px-8 py-4 bg-gray-50 border-t border-gray-100">
                            <div class="">Status Rejestrów</div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </layout>
</template>

<script>

import Layout from '@/Layouts/AppLayout.vue'
import UserNavigation from "@/Shared/UserNavigation.vue";
import DoughnutChart from "@/Shared/DoughnutChart.vue";

export default {
    components: {
        Layout,
        UserNavigation,
        DoughnutChart

    },

    props: {
        company: Object,
        companies: Array,
        registries: Object,
        countOfUpToDateRegistries: Number,
    },
    data() {
        return {
            chartData: {
                labels: ['Aktualne', 'Nieaktualne'],
                datasets: [
                    {
                        label: 'Reports',
                        backgroundColor: ['#D3D3D3', '#A9A9A9',],
                        data: [5,7],
                        borderWidth: 0
                    }
                ],
            },
            chartDataRegistries: {
                labels: ['Aktualne', 'Nieaktualne'],
                datasets: [
                    {
                        label: 'Registries',
                        backgroundColor: ['#9ae6b4', '#FEB2B2',],
                        data: [this.countOfUpToDateRegistries, this.registries.total - this.countOfUpToDateRegistries ],
                        borderWidth: 0
                    }
                ],
            },
            chartOptions: {
                cutout: 75,
            },
            width: 120,
            height: 100,
        }

    },
    methods: {
        percentage(){
            return Math.floor((this.countOfUpToDateRegistries/this.registries.total)*100)
        }
    }

}
</script>
