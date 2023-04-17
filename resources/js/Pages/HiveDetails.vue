<template>
    <Head title="Détails" />

    <BreezeAuthenticatedLayout>
        <div class="container mx-auto p-4">
        <div>
                <div class="flex flex-col lg:flex-row justify-between lg:flex-wrap my-5 px-1 lg:px-6 lg:items-center">
                    <div class="flex items-center">
                        <back-button :previousRoute="previousRoute"></back-button>
                        <h2 class="text-3xl font-bold mr-6 mb-5 grow ">Détails : {{ hive.name }}</h2>
                    </div>
                    <button v-if="$page.props.auth.user.permissions.includes('manage hives')"
                    @click="deleteHive()" class="flex justify-center items-center gap-4 mb-4 border-zinc-900 bg-white text-zinc-900 border-2 rounded-xl py-2 font-semibold w-full lg:w-72 mr-5 hover:bg-zinc-900 hover:text-white">
                        <svg width="21" height="22" viewBox="0 0 21 22" 
                        fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82609 1.47729H12.3043C13.7451 1.47729 14.913 2.64525 14.913 4.08599H10.5652H6.21739C6.21739 2.64525 7.38534 1.47729 8.82609 1.47729ZM19.999 7.81152L18.5991 19.711C18.4806 20.7182 17.627 21.4773 16.6128 21.4773H4.51763C3.50346 21.4773 2.64983 20.7182 2.53133 19.711L1.13139 7.81152C1.06145 7.21703 1.52595 6.69468 2.12454 6.69468H19.0059C19.6045 6.69468 20.069 7.21702 19.999 7.81152ZM6.77692 3.58599H14.3533C14.1288 2.66274 13.2966 1.97729 12.3042 1.97729H8.82598C7.83365 1.97729 7.00142 2.66274 6.77692 3.58599Z" fill="currentColor"/>
                        <path d="M14.913 4.08599V4.58599H15.413V4.08599H14.913ZM6.21739 4.08599H5.71739V4.58599H6.21739V4.08599ZM18.5991 19.711L19.0957 19.7694L19.0957 19.7694L18.5991 19.711ZM19.999 7.81152L19.5025 7.7531L19.5025 7.7531L19.999 7.81152ZM2.53133 19.711L2.03475 19.7694L2.03475 19.7694L2.53133 19.711ZM1.13139 7.81152L1.62797 7.7531L1.13139 7.81152ZM14.3533 3.58599V4.08599H14.9895L14.8391 3.46785L14.3533 3.58599ZM6.77692 3.58599L6.29107 3.46785L6.14077 4.08599H6.77692V3.58599ZM1 3.58599C0.723858 3.58599 0.5 3.80985 0.5 4.08599C0.5 4.36213 0.723858 4.58599 1 4.58599V3.58599ZM6.21739 4.58599C6.49353 4.58599 6.71739 4.36213 6.71739 4.08599C6.71739 3.80985 6.49353 3.58599 6.21739 3.58599V4.58599ZM14.913 3.58599C14.6369 3.58599 14.413 3.80985 14.413 4.08599C14.413 4.36213 14.6369 4.58599 14.913 4.58599V3.58599ZM20.1304 4.58599C20.4066 4.58599 20.6304 4.36213 20.6304 4.08599C20.6304 3.80985 20.4066 3.58599 20.1304 3.58599V4.58599ZM12.3043 0.977295H8.82609V1.97729H12.3043V0.977295ZM15.413 4.08599C15.413 2.3691 14.0212 0.977295 12.3043 0.977295V1.97729C13.4689 1.97729 14.413 2.92139 14.413 4.08599H15.413ZM10.5652 4.58599H14.913V3.58599H10.5652V4.58599ZM6.21739 4.58599H10.5652V3.58599H6.21739V4.58599ZM8.82609 0.977295C7.1092 0.977295 5.71739 2.36911 5.71739 4.08599H6.71739C6.71739 2.92139 7.66149 1.97729 8.82609 1.97729V0.977295ZM19.0957 19.7694L20.4956 7.86994L19.5025 7.7531L18.1025 19.6525L19.0957 19.7694ZM16.6128 21.9773C17.8805 21.9773 18.9476 21.0284 19.0957 19.7694L18.1025 19.6525C18.0137 20.408 17.3734 20.9773 16.6128 20.9773V21.9773ZM4.51763 21.9773H16.6128V20.9773H4.51763V21.9773ZM2.03475 19.7694C2.18287 21.0284 3.24992 21.9773 4.51763 21.9773V20.9773C3.757 20.9773 3.11678 20.408 3.0279 19.6525L2.03475 19.7694ZM0.634818 7.86994L2.03475 19.7694L3.0279 19.6525L1.62797 7.7531L0.634818 7.86994ZM2.12454 6.19468C1.22665 6.19468 0.529907 6.9782 0.634818 7.86994L1.62797 7.7531C1.593 7.45585 1.82525 7.19468 2.12454 7.19468V6.19468ZM19.0059 6.19468H2.12454V7.19468H19.0059V6.19468ZM20.4956 7.86994C20.6005 6.9782 19.9038 6.19468 19.0059 6.19468V7.19468C19.3052 7.19468 19.5374 7.45585 19.5025 7.7531L20.4956 7.86994ZM14.3533 3.08599H6.77692V4.08599H14.3533V3.08599ZM12.3042 2.47729C13.0606 2.47729 13.6962 2.99977 13.8675 3.70413L14.8391 3.46785C14.5614 2.32571 13.5325 1.47729 12.3042 1.47729V2.47729ZM8.82598 2.47729H12.3042V1.47729H8.82598V2.47729ZM7.26276 3.70413C7.43403 2.99977 8.06961 2.47729 8.82598 2.47729V1.47729C7.5977 1.47729 6.5688 2.32571 6.29107 3.46785L7.26276 3.70413ZM1 4.58599H6.21739V3.58599H1V4.58599ZM14.913 4.58599H20.1304V3.58599H14.913V4.58599Z" fill="currentColor"/>
                        </svg>
                        Supprimer la ruche

                    </button>
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
                <h3 v-if="interventions.length <=  0"
                class="font-bold text-2xl text-zinc-900/25
                text-center">
                Aucun contrôle effectué sur cette ruche</h3>
                <InterventionCard v-for="intervention in interventions" 
                :intervention="intervention"></InterventionCard>
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
import Swal from "sweetalert2";
import { useForm } from "@inertiajs/inertia-vue3";

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
    props: ['interventions', 'record_nb_varroa', 'hive', 'apiary', 'previousRoute'],
    setup(props) {
        const hiveForm = useForm({
            hive_id: props.hive_id,
        });
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
            hiveForm,
        };

    },
    methods: {
        deleteHive() {
            Swal.fire({
                title: "Voulez-vous vraiment supprimer cette ruche ?",
                text: "Cette action est irréversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d93131',
                confirmButtonText: "Confirmer",
                cancelButtonText: "Annuler"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.hiveForm.delete(route('hive.destroy', [this.hive, this.apiary]), {
                        onSuccess() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Ruche supprimé avec succès',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3500,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })
                        }
                    })
                }
            })
        }
    },
    mounted() {
        console.log(this.lineChartProps)
        console.log(this.apiary)
        ///sort interventions by date
        //console.log(this.interventions)
        
        //console.log(this.hive_name)
        //console.log segment of url
    }
}
</script>