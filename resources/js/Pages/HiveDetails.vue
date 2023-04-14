<template>
    <Head title="Détails" />

    <BreezeAuthenticatedLayout>
        <div class="container mx-auto p-4">
        <div>
                <div class="flex justify-between flex-wrap my-5 items-center">
                    <back-button></back-button>
                    <h2 class="text-3xl font-bold mr-6 mb-5 grow ">Détails : {{ hive_name }}</h2>
                </div>
            </div>

        <div class="py-2 lg:py-4 px-4 mx-auto h-full ">
                        <!--if record is greater than 0 -->
            <LineChart

            v-if="record_nb_varroa.length > 0"
            v-bind="lineChartProps" 
            class="h-80 mb-5"/>
            <div class="flex flex-wrap gap-4 justify-center">
                <h3 
                v-if="interventions.length > 0"
                class="font-bold text-2xl text-zinc-900
                text-center">
                Historique des contrôles</h3>
                <h3 v-if="record_nb_varroa.length <=  0"
                class="font-bold text-2xl text-zinc-900/25
                text-center">
                Aucun contrôle effectué sur cette ruche</h3>
                <InterventionCard v-for="intervention in interventions" :intervention="intervention"></InterventionCard>
            </div>
        </div>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
            </div>
        </div>
    </div>   
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import {Head} from '@inertiajs/inertia-vue3';
import BreezeButton from '@/Components/PrimaryButton.vue'
import {Link} from "@inertiajs/inertia-vue3";
import BackButton from "@/Components/BackButton.vue";
import InterventionCard from '@/Components/Hive/InterventionCard.vue';
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";


import { LineChart, useLineChart } from 'vue-chart-3';
import { Chart, registerables } from "chart.js";

Chart.register(...registerables);

export default {
    components: {
        InterventionCard,
        BreezeAuthenticatedLayout,
        Head,
        BreezeButton,
        Link,
        BackButton,
        //UserDisabled,
        BreezeValidationErrors,
        LineChart
    },
    props: ['interventions', 'record_nb_varroa', 'hive_id', 'hive_name'],
    setup(props) {
        //get the date of each interventions but only keep dd/mm/yyyy
        const labels = props.record_nb_varroa.map((record) => {
            return record.date.split('T')[0]
        })
        const data = {
            labels: labels,
            datasets: [
                {
                    label: 'Évolution du nombre de varroas',
                    data: props.record_nb_varroa.map((record) => {
                        return record.nb_varroa
                    }),
                    backgroundColor: 'rgba(251, 191, 36, 0.2)',
                    borderColor: 'rgba(251, 191, 36, 1)',
                    borderWidth: 1,
                    pointRadius: 3,
                },
            ],
        };

        const {lineChartProps , lineChartRef}= useLineChart ({
            chartData: data,
            chartOptions: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });

    
        return {
            lineChartProps,
            lineChartRef,
        };

    },
    mounted() {
        console.log(this.lineChartProps)
        console.log(this.record_nb_varroa)
        ///sort interventions by date
        //console.log(this.interventions)
        
        //console.log(this.hive_name)
        //console.log segment of url
    }
}
</script>