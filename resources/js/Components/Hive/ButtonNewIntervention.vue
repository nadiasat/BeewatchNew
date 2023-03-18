<template>
    <div @click="showModalInterventions = true" class="btn-new-intervention bg-amber-400 hover:bg-amber-200 mb-2 rounded-md flex items-center justify-center h-3 self-stretch px-10 py-5 cursor-pointer" :class="[!hive.is_active ? 'bg-[#AFAC99] hover:bg-[#E0DDCE]' : '']">
        <p class="btn-new-intervention-text font-medium text-black text-center text-sm">
          Nouvelle intervention
        </p>
    </div>

    <ModalInterventions v-show="showModalInterventions" @close="showModalInterventions = false" :hive="hive">
        <div class="container">
        </div>
    </ModalInterventions>
</template>

<script>
import ModalInterventions from "@/Components/ModalInterventions.vue";
import BreezeLabel from "@/Components/InputLabel.vue";
import BreezeInput from "@/Components/TextInput.vue";

export default {
    name: "ButtonNewIntervention",
    props: ['hive'],

    data() {
        return {
            showModalInterventions: false,
        }
    },
    components: {
        ModalInterventions,
        BreezeLabel,
        BreezeInput,
    },
    mounted() {
        console.log(this.hive);
    }
}
</script>