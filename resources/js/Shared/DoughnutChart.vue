<template>
    <Doughnut :chart-data="chartData"  />
</template>

<script>
import { Doughnut } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip,  BarElement, CategoryScale, LinearScale, ArcElement } from 'chart.js'

ChartJS.register(Title, Tooltip,  BarElement, CategoryScale, LinearScale, ArcElement)

export default {
    name: 'DoughnutChart',
    components: {  Doughnut },
    props: {
        chartData: {
            type: Object,
            required: true
        },
        chartOptions: {
            type: Object,

            default: () => {}
        }
    }
}
</script>
