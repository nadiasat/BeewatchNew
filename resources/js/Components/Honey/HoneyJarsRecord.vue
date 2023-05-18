<template>
    <div class="flex flex-col lg:flex-row justify-between lg:flex-wrap my-5 px-1 lg:px-6 lg:items-center gap-4 lg:gap-0">
        <h4 class="w-full sm:w-96 font-bold text-xl shrink">Historique des sorties</h4>
        <RecordCreate :jars="jars" :users="users"></RecordCreate>
    </div>

    <hr>

    <div v-if="records == null || !records.length">
        <p class="py-8">Acune sortie de miel pour le moment</p>
    </div>
    <div v-else class="border rounded-xl overflow-x-auto mt-8">
        <table class="table-auto text-sm lg:text-base w-full">
            <thead>
                <tr class="bg-amber-400 divide-x divide-[#C69202]">
                    <th class="
                    p-2 pl-4 pt-2 pb-2
                    lg:p-4 lg:pl-8 lg:pt-4 lg:pb-4 
                    text-zinc-900 text-left">Date</th>
                    <th class="
                    p-2 pl-4 pt-2 pb-2
                    lg:p-4 lg:pl-8 lg:pt-4 lg:pb-4 
                    text-zinc-900 text-left">Personne</th>
                    <th class="
                    p-2 pl-4 pt-2 pb-2
                    lg:p-4 lg:pl-8 lg:pt-4 lg:pb-4 
                    text-zinc-900 text-left">Quantité</th>
                    <th class="
                    p-2 pl-4 pt-2 pb-2
                    lg:p-4 lg:pl-8 lg:pt-4 lg:pb-4
                    text-zinc-900 text-left">Type de pots</th>
                </tr>
            </thead>
             <tbody>
                <tr v-for="(record, index) in records" :class="index % 2 === 0 ? 'bg-white' : 'bg-amber-100/50'" class="divide-x divide-[#E0DDCE]">
                    <td class="
                    p-2 pl-4 
                    lg:p-4 lg:pl-8 
                    text-zinc-900">{{ record.created_at }}</td>
                    <td class="
                    p-2 pl-4 
                    lg:p-4 lg:pl-8 
                    text-zinc-900">{{ record.user_name }}</td>
                    <td class="
                    p-2 pl-4 
                    lg:p-4 lg:pl-8 
                    text-zinc-900">{{ record.nb_jar }}</td>
                    <td class="
                    p-2 pl-4 
                    lg:p-4 lg:pl-8 
                    text-zinc-900">{{ record.size }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

import { ref } from 'vue';
import RecordCreate from './RecordCreate.vue';

export default {
    name: "HoneyJarsRecord",
    props: ['records', 'jars', 'users'],
    setup(props) {
        //for each records in props format the date¨
        props.records.forEach(record => {
            
            //parse date to display mm-dd-yyyy hh:mm
            record.created_at = new Date(record.created_at).toLocaleString();
            // fromat date to display "le dd-mm-yyyy à hh:mm"
            record.created_at = record.created_at.slice(0, 10);
            
        });

    },
    components: {
    RecordCreate,
    RecordCreate
},
    methods: {
    },
    mounted() {
        //console.log(this.materials[1]);
        // set current materials equal to materials object of the selected inventory place (default is the first one)
    },
    //components: { UserDelete, UserEdit }
}
</script>

<style scoped>

</style>